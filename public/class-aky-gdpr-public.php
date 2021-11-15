<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/public
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Aky_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Aky_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'resources/dist/css/main.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Aky_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Aky_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name.'_tac', plugin_dir_url( __FILE__ ) . 'resources/vendor/tarteaucitronjs/tarteaucitron.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'resources/dist/js/main.js', array(), $this->version, false );

        add_action('wp_head', function () {
            $options = get_option('aky-gdpr');

            $service_type = $options['rgpd_service_type'];

            if ($service_type == Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON) {
            ?>
            <script type="text/javascript" class="aky-gdpr-script" defer onload>
                jQuery(document).ready( function() {
                    tarteaucitron.init({
                        "privacyUrl": "<?php echo (!empty($options['rgpd_custom_rgpd_link']) && (!empty($options['rgpd_custom_rgpd_page'])) ? $options['rgpd_custom_rgpd_link'] : '/politique-de-conservation-de-donnees' ); ?>", /* Privacy policy url */

                        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
                        "cookieName": "tartaucitron", /* Cookie name */

                        "orientation": "top", /* Banner position (top - bottom) */
                        "showAlertSmall": false, /* Show the small banner on bottom right */
                        "cookieslist": false, /* Show the cookie list */

                        "adblocker": false, /* Show a Warning if an adblocker is detected */
                        "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
                        "DenyAllCta" : true,
                        "highPrivacy": true, /* Disable auto consent */
                        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

                        "removeCredit": false, /* Remove credit link */
                        "moreInfoLink": true, /* Show more info link */
                        "useExternalCss": true, /* If false, the tarteaucitron.css file will be loaded */

                        //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

                        "readmoreLink": "/utilisation-des-cookies" /* Change the default readmore link */
                    });
                })
            </script>
            <?php
            } elseif ($service_type === Aky_Gdpr_Admin::SERVICE_SIRDATA) {
                $sirdata_user = $options['sirdata_user'];
                $sirdata_site = $options['sirdata_site'];

                $ua = $options['rgpd_ua'];
                $gtm = $options['rgpd_gta'];
            ?>
                <script type="text/javascript" src="//cache.consentframework.com/js/pa/<?= $sirdata_user ?>/c/<?= $sirdata_site ?>/stub" referrerpolicy="unsafe-url" charset="utf-8"></script>
                <script type="text/javascript" src="//choices.consentframework.com/js/pa/<?= $sirdata_user ?>/c/<?= $sirdata_site ?>/cmp" referrerpolicy="unsafe-url" charset="utf-8" async></script>

                <?php if ($ua): ?>
                    <!-- Global site tag (gtag.js) - Google Analytics -->
                    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ua ?>"></script>
                    <script>
                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());
                        gtag('config', '<?= $ua ?>');
                    </script>
                <?php endif; ?>

                <?php if ($gtm): ?>
                    <!-- Google Tag Manager -->
                    <script>
                        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                        })(window,document,'script','dataLayer','<?= $gtm ?>');
                    </script>
                    <!-- End Google Tag Manager -->
                <?php endif; ?>
            <?php
            }
        }, PHP_INT_MAX);

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
         include_once 'partials/aky-gdpr-public-display.php';
    }

}
