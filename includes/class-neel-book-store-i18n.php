<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://neel10singh.netlify.app/
 * @since      1.0.0
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 * @author     Neelaksh Singh <neelaksh.singh@hbwsl.com>
 */
class Neel_Book_Store_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'neel-book-store',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
