<?php
/**
 * The plugin Aky GDPR file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://akyos.com
 * @since             1.0.0
 * @package           Aky_Gdpr
 *
 * @wordpress-plugin
 * Plugin Name:       GDPR by Akyos
 * Plugin URI:        https://github.com/jpa-akyos/aky-gdpr
 * Description:       Plugin d'Akyos Communication ( RGPD, suivi ... )
 * Version:           2.1.3
 * Author:            Akyos Communication <developpement@akyos.com>
 * Author URI:        https://akyos.com
 * Text Domain:       aky-gdpr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( 'PLUGIN_NAME_VERSION', '2.1.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aky-gdpr-activator.php
 */
function activate_aky_gdpr() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-aky-gdpr-activator.php';
    Aky_Gdpr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aky-gdpr-deactivator.php
 */
function deactivate_aky_gdpr() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-aky-gdpr-deactivator.php';
    Aky_Gdpr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aky_gdpr' );
register_deactivation_hook( __FILE__, 'deactivate_aky_gdpr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aky-gdpr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aky_gdpr() {
    $plugin = new Aky_Gdpr();
    $plugin->run();
}
run_aky_gdpr();

// Include our updater file
if( ! class_exists( 'Aky_Gdpr_Updater' ) ){
    require_once plugin_dir_path( __FILE__ ) . 'updater.php';
}
$updater = new Aky_Gdpr_Updater( __FILE__ );
$updater->set_username( 'akyoscommunication' );
$updater->set_repository( 'aky-gdpr' );
//$updater->authorize( '71135cb1a5125b2b9d698d9670d380aab4c3c3bc' ); // auth code goes here for private repos
$updater->initialize();
