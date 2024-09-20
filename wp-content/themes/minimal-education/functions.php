<?php
/**
 * Theme functions and definitions
 *
 * @package minimal_education
 */

//enque files
if ( ! function_exists( 'minimal_education_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function minimal_education_enqueue_styles() {
		wp_enqueue_style( 'education-insight-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'minimal-education-style', get_stylesheet_directory_uri() . '/style.css', array( 'education-insight-style-parent' ), '1.0.0' );

    // Theme Customize CSS.
    require get_parent_theme_file_path( 'inc/extra_customization.php' );
    wp_add_inline_style( 'minimal-education-style',$education_insight_custom_style );

    require get_theme_file_path( 'inc/extra_customization.php' );
    wp_add_inline_style( 'minimal-education-style',$education_insight_custom_style );

    // blocks css
    wp_enqueue_style( 'minimal-education-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'minimal-education-style' ), '1.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'minimal_education_enqueue_styles', 99 );

//theme setup
function minimal_education_setup() {
  add_theme_support( "align-wide" );
  add_theme_support( "wp-block-styles" );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );
  add_theme_support('custom-background',array(
    'default-color' => 'ffffff',
  ));

  $GLOBALS['content_width'] = 525;

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

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, and column width.
   */
  add_editor_style( array( 'assets/css/editor-style.css', education_insight_fonts_url() ) );
}
add_action( 'after_setup_theme', 'minimal_education_setup' );

// widgets
function minimal_education_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'minimal-education' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Page Sidebar', 'minimal-education' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Add widgets here to appear in your pages and posts', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

   register_sidebar( array(
    'name'          => __( 'Sidebar 3', 'minimal-education' ),
    'id'            => 'sidebar-3',
    'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 1', 'minimal-education' ),
    'id'            => 'footer-1',
    'description'   => __( 'Add widgets here to appear in your footer.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 2', 'minimal-education' ),
    'id'            => 'footer-2',
    'description'   => __( 'Add widgets here to appear in your footer.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 3', 'minimal-education' ),
    'id'            => 'footer-3',
    'description'   => __( 'Add widgets here to appear in your footer.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 4', 'minimal-education' ),
    'id'            => 'footer-4',
    'description'   => __( 'Add widgets here to appear in your footer.', 'minimal-education' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'minimal_education_widgets_init' );

// remove sections
function minimal_education_customize_register() {
    global $wp_customize;
  $wp_customize->remove_section( 'education_insight_pro' );
  $wp_customize->remove_setting( 'education_insight_slider_content_alignment' );
  $wp_customize->remove_control( 'education_insight_slider_content_alignment' );
}
add_action( 'customize_register', 'minimal_education_customize_register', 11 );

// remove themelocation
function minimal_education_remove_parent_theme_locations(){
    unregister_nav_menu( 'primary-1' );
    unregister_nav_menu( 'primary-2' );
 }
 add_action( 'after_setup_theme', 'minimal_education_remove_parent_theme_locations', 20 );

// comments
function minimal_education_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'minimal_education_enqueue_comments_reply' );

// customizer
function minimal_education_customize( $wp_customize ) {

  wp_enqueue_style('customizercustom_css', get_stylesheet_directory_uri(). '/assets/css/customizer.css');

   require get_theme_file_path( 'inc/custom-control.php' );

  // pro control
  $wp_customize->add_section('minimal_education_pro', array(
    'title'    => __('UPGRADE EDUCATE PREMIUM', 'minimal-education'),
    'priority' => 1,
  ));
  $wp_customize->add_setting('minimal_education_pro', array(
    'default'           => null,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control(new Minimal_Education_Pro_Control($wp_customize, 'minimal_education_pro', array(
    'label'    => __('EDUCATE TRAINING PREMIUM', 'minimal-education'),
    'section'  => 'minimal_education_pro',
    'settings' => 'minimal_education_pro',
    'priority' => 1,
  )));

  // slider content alignment
  $wp_customize->add_setting( 'minimal_education_slider_content_alignment',
    array(
      'default' => 'LEFT-ALIGN',
      'transport' => 'refresh',
      'sanitize_callback' => 'education_insight_sanitize_choices'
    )
  );
  $wp_customize->add_control( new Minimal_Education_Text_Radio_Button_Custom_Control( $wp_customize, 'minimal_education_slider_content_alignment',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Slider Content Alignment', 'minimal-education' ),
      'section' => 'education_insight_slider_section',
      'choices' => array(
        'LEFT-ALIGN' => __('LEFT','minimal-education'),
              'CENTER-ALIGN' => __('CENTER','minimal-education'),
              'RIGHT-ALIGN' => __('RIGHT','minimal-education'),
      ),
      'active_callback' => 'education_insight_slider_dropdown',
    )
  ) );

  // admission btn
  $wp_customize->add_setting('education_insight_admission_text',array(
    'default' => '',
    'sanitize_callback'  => 'sanitize_text_field'
  ));
  $wp_customize->add_control('education_insight_admission_text',array(
    'type' => 'text',
    'label' => __('Button Text','minimal-education'),
    'section' => 'education_insight_top',
  ));
  $wp_customize->selective_refresh->add_partial( 'education_insight_admission_text', array(
    'selector' => '.admision-btn a',
    'render_callback' => 'education_insight_customize_partial_education_insight_admission_text',
  ) );
  $wp_customize->add_setting('education_insight_admission_link',array(
    'default' => '',
    'sanitize_callback'  => 'esc_url_raw'
  ));
  $wp_customize->add_control('education_insight_admission_link',array(
    'type' => 'url',
    'label' => __('Button Link','minimal-education'),
    'section' => 'education_insight_top',
  ));
}
add_action( 'customize_register', 'minimal_education_customize' );

if ( ! defined( 'MINIMAL_EDUCATION_PRO_LINK' ) ) {
  define('MINIMAL_EDUCATION_PRO_LINK',__('https://www.ovationthemes.com/wordpress/education-coach-wordpress-theme/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_SUPPORT' ) ) {
  define('EDUCATION_INSIGHT_SUPPORT',__('https://wordpress.org/support/theme/minimal-education/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_REVIEW' ) ) {
  define('EDUCATION_INSIGHT_REVIEW',__('https://wordpress.org/support/theme/minimal-education/reviews/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_LIVE_DEMO' ) ) {
define('EDUCATION_INSIGHT_LIVE_DEMO',__('https://www.ovationthemes.com/demos/education-insight/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_BUY_PRO' ) ) {
define('EDUCATION_INSIGHT_BUY_PRO',__('https://www.ovationthemes.com/wordpress/education-wordpress-theme/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_PRO_DOC' ) ) {
define('EDUCATION_INSIGHT_PRO_DOC',__('https://ovationthemes.com/docs/ot-education-insight-pro/','minimal-education'));
}
if ( ! defined( 'EDUCATION_INSIGHT_THEME_NAME' ) ) {
define('EDUCATION_INSIGHT_THEME_NAME',__('Premium Educate Theme','minimal-education'));
}
/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Minimal_Education_Pro_Control')):
    class Minimal_Education_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( MINIMAL_EDUCATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATE PREMIUM','minimal-education');?> </a>
            </div>
            <div class="col-md">
                <img class="minimal_education_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('EDUCATE TRAINING PREMIUM - Features', 'minimal-education'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'minimal-education');?> </li>
                    <li class="upsell-minimal_education"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'minimal-education');?> </li>
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( MINIMAL_EDUCATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATE PREMIUM','minimal-education');?> </a>
            </div>
        </label>
    <?php } }
endif;