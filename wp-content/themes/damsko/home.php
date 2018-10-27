<?php

/**
 * Adds landing page body class.
 *
 * @since 1.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
add_filter( 'body_class', 'smntcs_home_body_class' );
function smntcs_home_body_class( $classes ) {

	$classes[] = 'full-width';
	return $classes;

}

genesis();