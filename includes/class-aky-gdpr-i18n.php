<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/includes
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
            'aky-gdpr',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );

    }

}
