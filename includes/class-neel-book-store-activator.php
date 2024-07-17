<?php

/**
 * Fired during plugin activation
 *
 * @link       https://neel10singh.netlify.app/
 * @since      1.0.0
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/includes
 * @author     Neelaksh Singh <neelaksh.singh@hbwsl.com>
 */
class Neel_Book_Store_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_books_page();
        self::create_books_meta_table();
    	flush_rewrite_rules();
	}

	public static function create_books_page() {
    $page_check = get_page_by_title('Books');
    if (!isset($page_check->ID)) {
        $books_page = array(
            'post_title'    => 'Books',
            'post_content'  => 'This is the Books page.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
        );
        $page_id = wp_insert_post($books_page);

        // Add page to all menus
        $menus = wp_get_nav_menus();
        foreach ($menus as $menu) {
            wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' => 'Books',
                'menu-item-object' => 'page',
                'menu-item-object-id' => $page_id,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish'
            ));
        }
    }
    }

    public static function create_books_meta_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'books_meta';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            meta_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            book_id bigint(20) UNSIGNED NOT NULL,
            meta_key varchar(255) NOT NULL,
            meta_value longtext NOT NULL,
            PRIMARY KEY (meta_id),
            KEY book_id (book_id),
            KEY meta_key (meta_key(191))
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

}
