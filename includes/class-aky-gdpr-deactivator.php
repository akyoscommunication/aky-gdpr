<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_Deactivator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        $pagedelete1 = get_page_by_path( 'politique-de-conservation-de-donnees' );
        $pagedelete2 = get_page_by_path( 'utilisation-des-cookies' );

        if($pagedelete1 && $pagedelete2) {
            wp_delete_post($pagedelete1->ID, true);
            wp_delete_post($pagedelete2->ID, true);
        }
    }

}
