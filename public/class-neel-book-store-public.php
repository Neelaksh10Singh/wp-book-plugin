<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://neel10singh.netlify.app/
 * @since      1.0.0
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Neel_Book_Store
 * @subpackage Neel_Book_Store/public
 * @author     Neelaksh Singh <neelaksh.singh@hbwsl.com>
 */
class Neel_Book_Store_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode('book', array($this, 'book_shortcode'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/neel-book-store-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/neel-book-store-public.js', array( 'jquery' ), $this->version, false );

	}

	public function book_shortcode($atts) {
        $atts = shortcode_atts(
            array(
                'id' => '',
                'author_name' => '',
                'year' => '',
                'category' => '',
                'tag' => '',
                'publisher' => '',
            ),
            $atts,
            'book'
        );

        $query_args = array(
            'post_type' => 'book',
            'posts_per_page' => -1,
            'meta_query' => array('relation' => 'AND'),
            'tax_query' => array('relation' => 'AND'),
        );

        if (!empty($atts['id'])) {
            $query_args['p'] = intval($atts['id']);
        }

        if (!empty($atts['author_name'])) {
            $query_args['meta_query'][] = array(
                'key' => '_book_author',
                'value' => $atts['author_name'],
                'compare' => 'LIKE',
            );
        }

        if (!empty($atts['year'])) {
            $query_args['meta_query'][] = array(
                'key' => '_book_year',
                'value' => $atts['year'],
                'compare' => 'LIKE',
            );
        }

        if (!empty($atts['publisher'])) {
            $query_args['meta_query'][] = array(
                'key' => '_book_publisher',
                'value' => $atts['publisher'],
                'compare' => 'LIKE',
            );
        }

        if (!empty($atts['category'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $atts['category'],
            );
        }

        if (!empty($atts['tag'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $atts['tag'],
            );
        }

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            $output = '<div class="book-list">';
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<div class="book-item">';
                $output .= '<h2>' . get_the_title() . '</h2>';
                $output .= '<p><strong>Author:</strong> ' . esc_html(get_post_meta(get_the_ID(), '_book_author', true)) . '</p>';
                $output .= '<p><strong>Year:</strong> ' . esc_html(get_post_meta(get_the_ID(), '_book_year', true)) . '</p>';
                $output .= '<p><strong>Publisher:</strong> ' . esc_html(get_post_meta(get_the_ID(), '_book_publisher', true)) . '</p>';
                $output .= '<p><strong>Price:</strong> ' . esc_html(get_post_meta(get_the_ID(), '_book_price', true)) . '</p>';
                $output .= '<p><strong>URL:</strong> <a href="' . esc_url(get_post_meta(get_the_ID(), '_book_url', true)) . '">' . esc_html(get_post_meta(get_the_ID(), '_book_url', true)) . '</a></p>';
                $output .= '</div>';
            }
            $output .= '</div>';
            wp_reset_postdata();
        } else {
            $output = '<p>No books found.</p>';
        }

        return $output;
    }

}
