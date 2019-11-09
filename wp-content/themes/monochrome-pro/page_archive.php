<?php
/**
 * Monochrome Pro.
 *
 * This file adds the archive page template to the Monochrome Pro Theme.
 *
 * Template Name: Archive
 *
 * @package Monochrome
 * @author  Niels Lange
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/monochrome/
 */

// Add pricing page body class to the head.
add_filter( 'body_class', 'monochrome_add_body_class' );
function monochrome_add_body_class( $classes ) {

	$classes[] = 'pricing-archive';

	return $classes;

}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Fetch and list all blog post links.
add_action( 'genesis_entry_content', 'nl_list_blog_post_links', 9 );
function nl_list_blog_post_links() {
	global $post;
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 100,
		'post_status'    => 'publish',
		'paged'          => get_query_var( 'paged' )
	);

	global $wp_query;
	$wp_query = new WP_Query( $args );

	if ( have_posts() ) :
		echo '<dl>';

		while ( have_posts() ) :
			the_post();
			printf(
				'<dt>%s</dt>',
				get_the_date( get_option( 'date_format' ) )
			);
			printf(
				'<dd><a href="%s">%s</a></dd>',
				get_the_permalink(),
				esc_html( get_the_title() )
			);
		endwhile;

		echo '</dl>';
		do_action( 'genesis_after_endwhile' );

	endif;

	wp_reset_query();
}

// Run the Genesis loop.
genesis();
