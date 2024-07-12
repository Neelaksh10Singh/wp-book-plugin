<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://neel10singh.netlify.app/
 * @since             1.0.0
 * @package           Neel_Book_Store
 *
 * @wordpress-plugin
 * Plugin Name:       Neel book store
 * Plugin URI:        https://neel10singh.netlify.app/
 * Description:       A plugin to incroporate books in your website
 * Version:           1.0.0
 * Author:            Neelaksh Singh
 * Author URI:        https://neel10singh.netlify.app//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       neel-book-store
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
define( 'NEEL_BOOK_STORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-neel-book-store-activator.php
 */
function activate_neel_book_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neel-book-store-activator.php';
	Neel_Book_Store_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-neel-book-store-deactivator.php
 */
function deactivate_neel_book_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neel-book-store-deactivator.php';
	Neel_Book_Store_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_neel_book_store' );
register_deactivation_hook( __FILE__, 'deactivate_neel_book_store' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-neel-book-store.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_neel_book_store() {

	$plugin = new Neel_Book_Store();
	$plugin->run();

}
run_neel_book_store();
