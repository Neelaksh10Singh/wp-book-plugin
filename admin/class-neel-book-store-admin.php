<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://neel10singh.netlify.app/
 * @since      1.0.0
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/admin
 * @author     Neelaksh Singh <neelaksh.singh@hbwsl.com>
 */
class Neel_Book_Store_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Neel_Book_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Neel_Book_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/neel-book-store-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Neel_Book_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Neel_Book_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script(
			'neel-book-store-block',
			plugin_dir_url(__FILE__) . 'js/neel-book-store-block.js',
			array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-data'),
			filemtime(plugin_dir_path(__FILE__) . 'js/neel-book-store-block.js')
		);
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/neel-book-store-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_book_post_type(){
		$labels = array(
			'name'               => 'Books',
			'singular_name'      => 'Book',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Book',
			'edit_item'          => 'Edit Book',
			'new_item'           => 'New Book',
			'all_items'          => 'All Books',
			'view_item'          => 'View Book',
			'search_items'       => 'Search Books',
			'not_found'          =>  'No books found',
			'not_found_in_trash' => 'No books found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Books'
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'books' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);
	
		register_post_type( 'book', $args );
	}
	function register_taxonomy_book_category() {
		$labels = array(
			'name'              => _x( 'Book Categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Book Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Book Categories' ),
			'all_items'         => __( 'All Book Categories' ),
			'parent_item'       => __( 'Parent Book Category' ),
			'parent_item_colon' => __( 'Parent Book Category:' ),
			'edit_item'         => __( 'Edit Book Category' ),
			'update_item'       => __( 'Update Book Category' ),
			'add_new_item'      => __( 'Add New Book Category' ),
			'new_item_name'     => __( 'New Book Category Name' ),
			'menu_name'         => __( 'Book Category' ),
		);
		$args   = array(
			'hierarchical'      => true, 
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [ 'slug' => 'book_category' ],
			'show_in_rest'      => true,
		);
		register_taxonomy( 'book_category', [ 'book' ], $args );
	}
	function register_taxonomy_book_tag() {
		$labels = array(
			'name'              => _x( 'Book Tags', 'taxonomy general name' ),
			'singular_name'     => _x( 'Book Tag', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Book Tags' ),
			'all_items'         => __( 'All Book Tags' ),
			'parent_item'       => __( 'Parent Book Tag' ),
			'parent_item_colon' => __( 'Parent Book Tag:' ),
			'edit_item'         => __( 'Edit Book Tag' ),
			'update_item'       => __( 'Update Book Tag' ),
			'add_new_item'      => __( 'Add New Book Tag' ),
			'new_item_name'     => __( 'New Book CTagName' ),
			'menu_name'         => __( 'Book Tag' ),
		);
		$args   = array(
			'hierarchical'      => false, 
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [ 'slug' => 'book_tag' ],
		);
		register_taxonomy( 'book_tag', [ 'book' ], $args );
	}
	public function add_custom_box() {
		$screens = [ 'book' ];
		foreach ( $screens as $screen ) {
			add_meta_box(
				'box_id',         
				'Book Information', 
				array($this, 'box_html'), 
				$screen                
			);
		}
	}

	
	public function box_html( $post ) {
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'books_meta';
		
		$meta_data = $wpdb->get_results($wpdb->prepare(
			"SELECT meta_key, meta_value FROM $table_name WHERE book_id = %d",
			$post->ID
		), OBJECT_K);
		
		
		$author = isset($meta_data['_book_author']->meta_value) ? $meta_data['_book_author']->meta_value : '';
    	$price = isset($meta_data['_book_price']->meta_value) ? $meta_data['_book_price']->meta_value : '';
    	$publisher = isset($meta_data['_book_publisher']->meta_value) ? $meta_data['_book_publisher']->meta_value : '';
    	$year = isset($meta_data['_book_year']->meta_value) ? $meta_data['_book_year']->meta_value : '';
		
		?>

		<p>
		<label for="book_author">Author Name</label>
		<input type="text" name="book_author" id="book_author" value="<?php echo esc_attr($author); ?>"/>
		</p>
		<p>
		<label for="book_publisher">Publisher</label>
		<input type="text" name="book_publisher" id="book_publisher" value="<?php echo esc_attr($publisher); ?>"/>
		</p>
		<p>
		<label for="book_price">Price</label>
		<input type="number" name="book_price" id="book_price" value="<?php echo esc_attr($price); ?>"/>
		</p>
		<p>
		<label for="book_year">Year</label>
		<input type="text" name="book_year" id="book_year" value="<?php echo esc_attr($year); ?>"/>
		</p>
		<?php
	}
	public function save_book( int $post_id ) {

		// if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		// 	return;
		// }

		global $wpdb;
		$table_name = $wpdb->prefix . 'books_meta';

		$meta_keys = array(
			'book_author' => '_book_author',
			'book_price' => '_book_price',
			'book_publisher' => '_book_publisher',
			'book_year' => '_book_year',
		);
		foreach ($meta_keys as $key => $meta_key) {
			if (isset($_POST[$key])) {
				$meta_value = sanitize_text_field($_POST[$key]);
				$existing_meta = $wpdb->get_var($wpdb->prepare(
					"SELECT COUNT(*) FROM $table_name WHERE book_id = %d AND meta_key = %s",
					$post_id, $meta_key
				));

				if ($existing_meta) {
					$wpdb->update(
						$table_name,
						array('meta_value' => $meta_value),
						array('book_id' => $post_id, 'meta_key' => $meta_key),
						array('%s'),
						array('%d', '%s')
					);
				} else {
					$wpdb->insert(
						$table_name,
						array(
							'book_id' => $post_id,
							'meta_key' => $meta_key,
							'meta_value' => $meta_value,
						),
						array('%d', '%s', '%s')
					);
				}
			}
		}
	}

	public function book_options_page(){         

		$book_options = get_option('book_settings', ['currency'=>'', 'entries'=>'']);
		

		ob_start(); ?> 
		<div class = "wrap">
			<h2> Books Page Settings </h2>    
			<form method="post" action="options.php">

				<?php settings_fields("book_settings_group"); ?>

				<h3><?php _e('Display Settings','book_domain'); ?></h3>
				<p>
					<label class="description" for="book_settings[currency]"><?php _e('Currency ','book_domain'); ?></label>
					<input id="book_settings[currency]" name="book_settings[currency]" type="text" value="<?php echo $book_options['currency'];  ?>"/>
					
				</p>
				<p>
					<label class="description" for="book_settings[entries]"><?php _e('Enties per page ','book_domain'); ?></label>
					<input id="book_settings[entries]" name="book_settings[entries]" type="text" value="<?php echo $book_options['entries']; ?>"/>
				</p>

				
				<p class="submit">
					<input type="submit" class="button-primary" value = "<?php _e('Save Options','book_domain'); ?>">
				</p>
			</form>
		</div>
		<?php
		echo ob_get_clean();

	}

	
	public function register_block() {
        wp_register_script(
            'neel-book-store-block',
            plugin_dir_url(__FILE__) . 'js/neel-book-store-block.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-data'),
            filemtime(plugin_dir_path(__FILE__) . 'js/neel-book-store-block.js')
        );

        register_block_type('neel-book-store/book-category', array(
            'editor_script' => 'neel-book-store-block',
            'render_callback' => array($this, 'render_block'),
            'attributes' => array(
                'category' => array(
                    'type' => 'string',
                ),
            ),
        ));
    }

	 public function render_block($attributes) {
        $category = isset($attributes['category']) ? $attributes['category'] : '';
        $query = new WP_Query(array(
            'post_type' => 'book',
            'tax_query' => array(
                array(
                    'taxonomy' => 'book_category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
            ),
        ));

        if (!$query->have_posts()) {
            return '<p>No books found.</p>';
        }

        $content = '<ul class="book-list">';
        while ($query->have_posts()) {
            $query->the_post();
            $content .= '<li>' . get_the_title() . '</li>';
        }
        $content .= '</ul>';

        wp_reset_postdata();

        return $content;
    }

	function neel_book_store_register_dashboard_widget() {
		wp_add_dashboard_widget(
			'neel_book_store_dashboard_widget', 
			'Top 5 Book Categories',            
			 array($this, 'neel_book_store_display_dashboard_widget')
		);
	}
	function neel_book_store_get_top_book_categories() {
    $terms = get_terms(array(
        'taxonomy' => 'book_category',
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => 5
    ));

		return $terms;
	}

	function neel_book_store_display_dashboard_widget() {
		$categories = $this->neel_book_store_get_top_book_categories();

		if (empty($categories) || is_wp_error($categories)) {
			echo 'No book categories found.';
			return;
		}

		echo '<ul>';
		foreach ($categories as $category) {
			echo '<li>' . esc_html($category->name) . ' (' . $category->count . ' books)</li>';
		}
		echo '</ul>';
	}

	 function book_add_options_link(){              
		add_options_page('Book Options', 'Books', 'manage_options', 'book-options', array($this, 'book_options_page'));
	}

	function book_register_settings(){             
		register_setting('book_settings_group','book_settings');
	}
	
}
