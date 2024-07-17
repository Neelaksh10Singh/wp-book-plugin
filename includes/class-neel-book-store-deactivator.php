<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://neel10singh.netlify.app/
 * @since      1.0.0
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 * @author     Neelaksh Singh <neelaksh.singh@hbwsl.com>
 */
class Neel_Book_Store_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
    	flush_rewrite_rules();
	}

}
