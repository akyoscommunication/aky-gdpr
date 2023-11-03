<?php

class Aky_Gdpr_Updater {
    private $file;
    private $plugin;
    private $basename;
    private $active;
    private $username;
    private $repository;
    private $authorize_token;
    private $github_response;

    public function __construct( $file )
    {
        $this->file = $file;
        add_action( 'admin_init', array( $this, 'set_plugin_properties' ) );
    }

    public function set_plugin_properties()
    {
        $this->plugin	= get_plugin_data( $this->file );
        $this->basename = plugin_basename( $this->file );
        $this->active	= is_plugin_active( $this->basename );
    }

    public function set_username( $username )
    {
        $this->username = $username;
    }

    public function set_repository( $repository )
    {
        $this->repository = $repository;
    }

    public function authorize( $token )
    {
        $this->authorize_token = $token;
    }

    private function get_repository_info() {
        if (is_null($this->github_response)) {
            $request_uri = sprintf('https://api.github.com/repos/%s/%s/releases', $this->username, $this->repository);

            // Switch to HTTP Basic Authentication for GitHub API v3
            $curl = curl_init();

            $args = [
                CURLOPT_URL => $request_uri,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_USERAGENT => "aky-gdpr",
            ];

            if ($this->authorize_token) {
                $args[CURLOPT_HTTPHEADER] = [
                    "Authorization: Bearer {$this->authorize_token}",
                ];
            }

            curl_setopt_array($curl, $args);

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response, true);

            if (is_array($response)) {
                $response = current($response);
            }

            if ($this->authorize_token) {
                $response['zipball_url'] = add_query_arg('access_token', $this->authorize_token, $response['zipball_url']);
            }

            $this->github_response = $response;
        }
    }

    public function initialize()
    {
        add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'modify_transient' ), 10, 1 );
        add_filter( 'plugins_api', array( $this, 'plugin_popup' ), 10, 3);
        add_filter( 'upgrader_post_install', array( $this, 'after_install' ), 10, 3 );
    }

    public function modify_transient( $transient )
    {
        if( property_exists( $transient, 'checked') ) { // Check if transient has a checked property
            if( $checked = $transient->checked ) { // Did Wordpress check for updates?
                $this->get_repository_info(); // Get the repo info
                $out_of_date = version_compare( $this->github_response['tag_name'], $checked[ $this->basename ], 'gt' ); // Check if we're out of date
                if( $out_of_date ) {
                    $new_files = $this->github_response['zipball_url']; // Get the ZIP
                    $slug = current( explode('/', $this->basename ) ); // Create valid slug
                    $plugin = array( // setup our plugin info
                        'url' => $this->plugin["PluginURI"],
                        'slug' => $slug,
                        'package' => $new_files,
                        'new_version' => $this->github_response['tag_name']
                    );
                    $transient->response[$this->basename] = (object) $plugin; // Return it in response
                }
            }
        }
        return $transient; // Return filtered transient
    }

    public function plugin_popup( $result, $action, $args )
    {
        if( ! empty( $args->slug ) ) { // If there is a slug

            if( $args->slug == current( explode( '/' , $this->basename ) ) ) { // And it's our slug
                $this->get_repository_info(); // Get our repo info
                // Set it to an array
                $plugin = array(
                    'name'				=> $this->plugin["Name"],
                    'slug'				=> $this->basename,
                    'requires'					=> '3.3',
                    'tested'						=> '4.4.1',
                    'rating'						=> '100.0',
                    'num_ratings'				=> '10823',
                    'downloaded'				=> '14249',
                    'added'							=> '2016-01-05',
                    'version'			=> $this->github_response['tag_name'],
                    'author'			=> $this->plugin["AuthorName"],
                    'author_profile'	=> $this->plugin["AuthorURI"],
                    'last_updated'		=> $this->github_response['published_at'],
                    'homepage'			=> $this->plugin["PluginURI"],
                    'short_description' => $this->plugin["Description"],
                    'sections'			=> array(
                        'Description'	=> $this->plugin["Description"],
                        'Updates'		=> $this->github_response['body'],
                    ),
                    'download_link'		=> $this->github_response['zipball_url']
                );
                return (object) $plugin; // Return the data
            }
        }
        return $result; // Otherwise return default
    }

    public function after_install( $response, $hook_extra, $result )
    {
        global $wp_filesystem; // Get global FS object
        $install_directory = plugin_dir_path( $this->file ); // Our plugin directory
        $wp_filesystem->move( $result['destination'], $install_directory ); // Move files to the plugin dir
        $result['destination'] = $install_directory; // Set the destination for the rest of the stack
        if ( $this->active ) { // If it was active
            activate_plugin( $this->basename ); // Reactivate
        }
        return $result;
    }
}
