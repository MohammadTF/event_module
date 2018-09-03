<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/MohammadTF
 * @since             1.0.0
 * @package           Tob_Events
 *
 * @wordpress-plugin
 * Plugin Name:       TOB Events
 * Plugin URI:        https://www.genetechsolutions.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Genetech
 * Author URI:        https://github.com/MohammadTF
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tob-events
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( !defined('TOB_E_PLUGIN_PATH') ){
    define('TOB_E_PLUGIN_PATH',plugin_dir_path(__FILE__));
}

if ( !defined('TOB_E_PLUGIN_URL') ){
    define('TOB_E_PLUGIN_URL',plugin_dir_url(__FILE__));
}

if ( !defined('TOB_E_AJAX_URL') ){
    define('TOB_E_AJAX_URL',admin_url('admin-ajax.php'));
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
if ( !defined('TOB_E_PLUGIN_NAME_VERSION') ){
	define( 'TOB_E_PLUGIN_NAME_VERSION', '1.0.0' );
}

if ( !defined('TOB_E_PLUGIN_NAME') ){
	define( 'TOB_E_PLUGIN_NAME', 'tob_event' );
}
if ( !defined('TOB_E_CLASS_PREFIX') ){
	define( 'TOB_E_CLASS_PREFIX', 'tob-events' );
	
}



use Tob_Events\Classes\Tob_Events_Activator;
use Tob_Events\Classes\Tob_Events_Deactivator ;
use Tob_Events\Classes\Tob_Events_Init;


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tob-events-activator.php
 */
function activate_tob_events() {
	//require_once plugin_dir_path( __FILE__ ) . 'includes/class-tob-events-activator.php';
	Tob_Events_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tob-events-deactivator.php
 */
function deactivate_tob_events() {
//	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tob-events-deactivator.php';
	Tob_Events_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tob_events' );
register_deactivation_hook( __FILE__, 'deactivate_tob_events' );


require_once TOB_E_PLUGIN_PATH.'bootstrap/autoloader.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
//require plugin_dir_path( __FILE__ ) . 'includes/class-tob-events.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_tob_events() {

	$plugin = new Tob_Events_Init();
	$plugin->run();

}
run_tob_events();
