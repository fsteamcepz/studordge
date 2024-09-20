<?php
/**
 * Education Insight functions and definitions
 *
 * @subpackage Education Insight
 * @since 1.0
 */

//woocommerce//
//shop page no of columns
function education_insight_woocommerce_loop_columns() {
	$retrun = get_theme_mod( 'education_insight_archieve_item_columns', 3 );
    return $retrun;
}
add_filter( 'loop_shop_columns', 'education_insight_woocommerce_loop_columns' );

function education_insight_woocommerce_products_per_page() {
		$retrun = get_theme_mod( 'education_insight_archieve_shop_perpage', 6 );
    
    return $retrun;
}
add_filter( 'loop_shop_per_page', 'education_insight_woocommerce_products_per_page' );
//related products
function education_insight_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod( 'education_insight_related_shop_perpage', 3 ),
        'columns'        => get_theme_mod( 'education_insight_related_item_columns', 3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'education_insight_related_products_args' );
//woocommerce-end

// get start function
function education_insight_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
   		wp_safe_redirect( admin_url("themes.php?page=education-insight-guide-page") );
   	}
}
add_action('after_setup_theme', 'education_insight_notice');
function education_insight_add_new_page() {
  $edit_page = admin_url().'post-new.php?post_type=page';
  echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

  exit;
}
add_action( 'wp_ajax_education_insight_add_new_page','education_insight_add_new_page' );
// get startfunction end//

// tag count
function display_post_tag_count() {
    $tags = get_the_tags();
    $tag_count = ($tags) ? count($tags) : 0;
    $tag_text = ($tag_count === 1) ? 'tag' : 'tags'; // Check for pluralization
    echo $tag_count . ' ' . $tag_text;
}

//media post format
function education_insight_get_media($type = array()){
	$content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get audio from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $content, $type );
    return $output;
  }
}

// front page template
function education_insight_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'education_insight_front_page_template' );

// excerpt function
function education_insight_custom_excerpt() {
    global $post;
    $content = get_the_content(); // Use get_the_content to retrieve the full post content
    $excerpt_length = get_theme_mod('education_insight_post_excerpt', 30); // Get the excerpt length from the Customizer setting

    // Use wp_trim_words to limit the content to the desired number of words
    $excerpt = wp_trim_words($content, $excerpt_length);

    $read_more_link = sprintf(
        '<div class="link-more text-center"><a href="%s" class="more-link py-2 px-4">%s</a></div>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(__('Read More<span class="screen-reader-text"> "%s"</span>', 'education-insight'), get_the_title(get_the_ID()))
    );

    echo $excerpt . $read_more_link;
}

// typography
function education_insight_fonts_scripts() {
	$education_insight_headings_font = esc_html(get_theme_mod('education_insight_headings_text'));
	$education_insight_body_font = esc_html(get_theme_mod('education_insight_body_text'));

	if( $education_insight_headings_font ) {
		wp_enqueue_style( 'education-insight-headings-fonts', '//fonts.googleapis.com/css?family='. $education_insight_headings_font );
	} else {
		wp_enqueue_style( 'education-insight-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $education_insight_body_font ) {
		wp_enqueue_style( 'education-insight-body-fonts', '//fonts.googleapis.com/css?family='. $education_insight_body_font );
	} else {
		wp_enqueue_style( 'education-insight-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'education_insight_fonts_scripts' );

// custom sanitizations
// dropdown
function education_insight_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
// slider custom control
if ( ! function_exists( 'education_insight_sanitize_integer' ) ) {
	function education_insight_sanitize_integer( $input ) {
		return (int) $input;
	}
}
// range contol
function education_insight_sanitize_number_absint( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
// select post page
function education_insight_sanitize_select( $education_insight_input, $setting ){
    $education_insight_input = sanitize_key($education_insight_input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $education_insight_input, $choices ) ? $education_insight_input : $setting->default );
}
// toggle switch
function education_insight_callback_sanitize_switch( $value ) {
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );
}
//choices control
function education_insight_sanitize_choices( $education_insight_input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $education_insight_input, $control->choices ) ) {
        return $education_insight_input;
    } else {
        return $setting->default;
    }
}
// phone number
function education_insight_sanitize_phone_number( $phone ) {
  return preg_replace( '/[^\d+]/', '', $phone );
}

// customizer-dropdowns
function education_insight_slider_dropdown(){
	if(get_option('education_insight_hide_show') == true ) {
		return true;
	}
	return false;
}
function education_insight_middle_sec_dropdown(){
	if(get_option('education_insight_middle_sec_hide_show') == true ) {
		return true;
	}
	return false;
}
function education_insight_popular_courses_dropdown(){
	if(get_option('education_insight_popular_courses_hide_show') == true ) {
		return true;
	}
	return false;
}

// theme setup
function education_insight_setup() {
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'education-insight-featured-image', 2000, 1200, true );
	add_image_size( 'education-insight-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary-1' => __( 'Primary Left Menu', 'education-insight' ),
		'primary-2' => __( 'Primary Right Menu', 'education-insight' ),
		'primary-3' => __( 'Mobile Menu', 'education-insight' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('video','gallery','audio','quote',) );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', education_insight_fonts_url() ) );
}
add_action( 'after_setup_theme', 'education_insight_setup' );

// widget
function education_insight_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'education-insight' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'education-insight' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'education-insight' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'education-insight' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'education-insight' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'education-insight' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'education-insight' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'education-insight' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'education_insight_widgets_init' );

function education_insight_fonts_url(){
	$education_insight_font_url = '';
	$education_insight_font_family = array();
	$education_insight_font_family[] = 'Roboto Slab:wght@100;200;300;400;500;600;700;800;900';
	$education_insight_font_family[] = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900';
	$education_insight_font_family[] = 'Catamaran:wght@100;200;300;400;500;600;700;800;900';
	$education_insight_font_family[] = 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';

	$education_insight_query_args = array(
		'family'	=> rawurlencode(implode('|',$education_insight_font_family)),
	);
	$education_insight_font_url = add_query_arg($education_insight_query_args,'//fonts.googleapis.com/css');
	return $education_insight_font_url;
	$education_insight_contents = wptt_get_webfont_url( esc_url_raw( $education_insight_fonts_url ) );
}

function education_insight_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'education-insight-fonts', education_insight_fonts_url(), array());

	// Bootstarp
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() .'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'education-insight-style', get_stylesheet_uri() );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'education-insight-style',$education_insight_custom_style );

	// font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'education-insight-block-style', get_template_directory_uri().'/assets/css/blocks.css' );

	// Custom JS
	wp_enqueue_script( 'education-insight-custom.js', get_theme_file_uri( '/assets/js/education-insight-custom.js' ), array( 'jquery' ), true );

	// Nav Focus JS
	wp_enqueue_script( 'education-insight-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	// Bootstarp JS
	wp_enqueue_script( 'bootstrap.js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_insight_scripts' );

function education_insight_enqueue_admin_script( $hook ) {

	// Admin JS
	wp_enqueue_script( 'education-insight-admin.js', get_theme_file_uri( '/assets/js/education-insight-admin.js' ), array( 'jquery' ), true );

	wp_localize_script('education-insight-admin.js', 'education_insight_scripts_localize',
        array(
            'ajax_url' => esc_url(admin_url('admin-ajax.php'))
        )
    );
}
add_action( 'admin_enqueue_scripts', 'education_insight_enqueue_admin_script' );

function education_insight_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'education-insight-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'education-insight-fonts', education_insight_fonts_url(), array());
}
add_action( 'enqueue_block_editor_assets', 'education_insight_block_editor_styles' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'education_insight_customize_controls_register_scripts' );

function education_insight_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'education-insight-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}

require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );
require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );
require get_parent_theme_file_path( '/inc/typofont.php' );
require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );
require get_parent_theme_file_path( '/inc/breadcrumb.php' );