<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/admin
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_Admin
{

    const SERVICE_TARTEAUCITRON = 'service_tarteaucitron';
    const SERVICE_SIRDATA = 'service_sirdata';

    const SERVICE_MATOMO_NO_COOKIE = 'service_matomo_no_cookie';

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/aky-gdpr-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/aky-gdpr-admin.js', array( 'jquery' ), $this->version, false);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_menu_page('RGPD By Akyos', 'RGPD Akyos', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), 'dashicons-shield-alt', 99);

        /*
         * Add a submenu page for this plugin to the Settings menu.
         */
        add_submenu_page($this->plugin_name, 'Tracking Woocommerce', 'Tracking Woocommerce', 'manage_options', "$this->plugin_name-woo_tracking", array($this, 'display_plugin_woo_tracking_page'));
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );

        return array_merge($settings_link, $links);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
        include_once('partials/aky-gdpr-admin-display.php');
    }

    public function display_plugin_woo_tracking_page()
    {
        include_once('partials/aky-gdpr-admin-woo-tracking-display.php');
    }

    /**
     * Render the widget dashboard maintenance for this plugin.
     *
     * @since    1.0.0
     */
    public function display_widget_maintenance()
    {
        include_once('inc/aky-widget-maintenance.php');
    }

    public function validate($input)
    {
        // All checkboxes inputs
        $valid = array();

        //Cleanup
        $valid['rgpd_custom_rgpd_page'] = $input['rgpd_custom_rgpd_page'] ?? false;
        $valid['rgpd_custom_rgpd_link'] = $input['rgpd_custom_rgpd_link'];

        $valid['rgpd_title'] = $input['rgpd_title'];
        $valid['rgpd_mail'] = $input['rgpd_mail'];
        $valid['rgpd_address'] = $input['rgpd_address'];
        $valid['rgpd_contact'] = $input['rgpd_contact'];
        $valid['rgpd_gta'] = $input['rgpd_gta'];
        $valid['rgpd_pixelfb'] = $input['rgpd_pixelfb'];
        $valid['rgpd_youtube'] = $input['rgpd_youtube'] ?? false;
        $valid['rgpd_id_client'] = $input['rgpd_id_client'];
        $valid['rgpd_front_logo'] = $input['rgpd_front_logo'];
        $valid['rgpd_front_logo_display'] = $input['rgpd_front_logo_display'] ?? false;
        $valid['rgpd_front_display'] = $input['rgpd_front_display'] ?? false;

        $valid['rgpd_matomo_url'] = $input['rgpd_matomo_url'];
        $valid['rgpd_matomo_js_path'] = $input['rgpd_matomo_js_path'];
        $valid['rgpd_matomo_site_id'] = $input['rgpd_matomo_site_id'];
        $valid['rgpd_matomo_url_tag'] = $input['rgpd_matomo_url_tag'];

        $valid['rgpd_service_type'] = $input['rgpd_service_type'];
        $valid['sirdata_user'] = $input['sirdata_user'];
        $valid['sirdata_site'] = $input['sirdata_site'];

        if (empty($valid['rgpd_custom_rgpd_page'])) {
            include_once 'inc/aky-gdpr-pages.php';
        }

        return $valid;
    }

    public function validate_woo_tracking($input)
    {
        // All checkboxes inputs
        $valid = [];

        //Cleanup
        $valid['woo_tracking_enabled'] = $input['woo_tracking_enabled'];
        $valid['add_to_cart_btn_class'] = $input['add_to_cart_btn_class'];
        $valid['remove_from_cart_btn_class'] = $input['remove_from_cart_btn_class'];

        return $valid;
    }

    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
        register_setting("$this->plugin_name-woo_tracking", "$this->plugin_name-woo_tracking", array($this, 'validate_woo_tracking'));
    }
}
