<?php
/**
 * Custom header implementation
 */

function education_insight_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'education_insight_custom_header_args', array(
		'default-image'          => get_parent_theme_file_uri( '/assets/images/header-img.jpg' ),
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1200,
		'height'                 => 80,
		'flex-width'			 => true,
		'flex-height'			 => true,
		'wp-head-callback'       => 'education_insight_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-img.jpg',
			'thumbnail_url' => '%s/assets/images/header-img.jpg',
			'description'   => __( 'Default Header Image', 'education-insight' ),
		),
	) );
}

add_action( 'after_setup_theme', 'education_insight_custom_header_setup' );

if ( ! function_exists( 'education_insight_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see education_insight_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'education_insight_header_style' );
function education_insight_header_style() {
	if ( get_header_image() ) :
	$education_insight_custom_css = "
		.header-image, .woocommerce-page .single-post-image  {
			background-image:url('".esc_url(get_header_image())."');
			background-position: top;
			background-size:cover !important;
			background-repeat:no-repeat !important;
		}";
	   	wp_add_inline_style( 'education-insight-style', $education_insight_custom_css );
	endif;
}
endif;

