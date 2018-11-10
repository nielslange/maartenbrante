<?php
// Enqueue custom scripts
add_action( 'wp_enqueue_scripts', 'nl_home_enqueue_script' );
function nl_home_enqueue_script() {
	wp_enqueue_script( 'responsive-slides-script', get_stylesheet_directory_uri() . '/lib/responsive-slides/responsiveslides.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'responsive-slides-style', get_stylesheet_directory_uri() . '/lib/responsive-slides/responsiveslides.css' );

	if ( ! wp_script_is( 'jquery', 'done' ) ) {
		wp_enqueue_script( 'jquery' );
	}
	wp_add_inline_script( 'jquery-migrate', 'jQuery(document).ready(function(){ jQuery(".rslides").responsiveSlides({
		auto: false,
		pager: true,
		nav: true,
		speed: 2000,
		namespace: "centered-btns",
        before: function () {
			jQuery(".events").append("<li>before event fired.</li>");
        },
        after: function () {
			jQuery(".events").append("<li>after event fired.</li>");
        }
	}) });' );
}

/**
 * Adds custom loop
 *
 * @since 1.0
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'nl_custom_loop' );
function nl_custom_loop() {
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			//the_title( '<h1>', '</h1>' );
			//echo ucfirst(get_the_date( 'l, mS F Y', get_the_ID() ));
			//the_category( );
			//the_tags( 'Tags: ', ', ', '<br />' );

			$images = get_field('gallery');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)

			if( $images ): ?>
			<div class="callbacks_container">
				<ul class="rslides" id="slider1">
					<?php foreach( $images as $image ): ?>
						<li>
							<?php $image_page = get_attachment_link($image['ID']); ?>
							<?php echo '<a href="' . $image_page . '">' . wp_get_attachment_image( $image['ID'], $size ) . '</a>'; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				</div>
			<?php endif;

			the_field( 'description' );

			comment_form();

		endwhile;
	endif;
}

genesis();