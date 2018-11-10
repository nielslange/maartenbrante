<?php

/**
 * Adds landing page body class.
 *
 * @since 1.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
add_filter( 'body_class', 'nl_home_body_class' );
function nl_home_body_class( $classes ) {

	$classes[] = 'full-width';
	return $classes;

}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'nl_custom_loop' );
function nl_custom_loop() {
	//global $post;
	// arguments, adjust as needed
/*	$args = array(
		'post_type'      => 'post',
		//'posts_per_page' => 1,
		'post_status'    => 'publish',
		'paged'          => get_query_var( 'paged' )
	);
	global $wp_query;
	$wp_query = new WP_Query( $args );*/
	if ( have_posts() ) :
		echo '<div class="posts">';
		while ( have_posts() ) : the_post();
			$bg = get_the_post_thumbnail_url( get_the_ID(), 'large' );
			printf( '<div class="post overlay" style="background: url(%s) no-repeat center/cover;"><a href="%s" class="text">%s</a></div>', $bg, get_the_permalink(), get_the_title() );
		endwhile;
		echo '</div>';
		do_action( 'genesis_after_endwhile' );
	endif;
	wp_reset_query();
}

genesis();