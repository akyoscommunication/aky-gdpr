<?php

/**
 * Fired during plugin activation
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if ( ! current_user_can( 'activate_plugins' ) ) return;

        global $wpdb;

        if (!get_page_by_title('Politique de conservation de données') && !get_page_by_title('Utilisation des cookies')) {
            include 'activations/aky-gdpr-pages.php';
        }
    }

}
