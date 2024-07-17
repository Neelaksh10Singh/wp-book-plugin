<?php
/**
 * Template Name: Books Page Template
 */

 //Work in progress template for book page displaying all books
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Query for books posts
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1,
    );
    $books_query = new WP_Query($args);

    if ($books_query->have_posts()) :
        while ($books_query->have_posts()) : $books_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p><?php esc_html_e('No books found.', 'your-text-domain'); ?></p>
    <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
