<?php
/**
 * Education Insight: Customizer
 *
 * @subpackage Education Insight
 * @since 1.0
 */

function education_insight_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

  	require get_parent_theme_file_path( 'inc/switch/control_switch.php' );

  	require get_parent_theme_file_path( 'inc/custom-control.php' );

  	// Add homepage customizer file
  	require get_template_directory() . '/inc/customizer-home-page.php';

  	// pro section
 	$wp_customize->add_section('education_insight_pro', array(
        'title'    => __('UPGRADE EDUCATION PREMIUM', 'education-insight'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('education_insight_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Education_Insight_Pro_Control($wp_customize, 'education_insight_pro', array(
        'label'    => __('EDUCATION PREMIUM', 'education-insight'),
        'section'  => 'education_insight_pro',
        'settings' => 'education_insight_pro',
        'priority' => 1,
    )));

    // logo
    $wp_customize->add_setting('education_insight_logo_title',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_logo_title',
			array(
				'settings'        => 'education_insight_logo_title',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Title', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('education_insight_logo_text',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_logo_text',
			array(
				'settings'        => 'education_insight_logo_text',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Tagline', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
    $wp_customize->add_setting('education_insight_logo_max_height',array(
		'default'=> '50',
		'transport' => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_integer'
	));
	$wp_customize->add_control(new Education_Insight_Slider_Custom_Control( $wp_customize, 'education_insight_logo_max_height',array(
		'label'	=> esc_html__('Logo Width','education-insight'),
		'section'=> 'title_tagline',
		'settings'=>'education_insight_logo_max_height',
		'input_attrs' => array(
			'reset'			   => 50,
            'step'             => 1,
			'min'              => 0,
			'max'              => 250,
        ),
        'priority' => 9
	)));

  	// typography
	$wp_customize->add_section( 'education_insight_typography_settings', array(
		'title'       => __( 'Typography', 'education-insight' ),
		'priority'       => 3,
	) );
	$education_insight_font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
	$wp_customize->add_setting( 'education_insight_section_typo_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_typo_heading', array(
		'label'       => esc_html__( 'Typography Settings', 'education-insight' ),
		'section'     => 'education_insight_typography_settings',
		'settings'    => 'education_insight_section_typo_heading',
	) ) );
	$wp_customize->add_setting( 'education_insight_headings_text', array(
		'sanitize_callback' => 'education_insight_sanitize_fonts',
	));
	$wp_customize->add_control( 'education_insight_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'education-insight'),
		'section' => 'education_insight_typography_settings',
		'choices' => $education_insight_font_choices
	));
	$wp_customize->add_setting( 'education_insight_body_text', array(
		'sanitize_callback' => 'education_insight_sanitize_fonts'
	));
	$wp_customize->add_control( 'education_insight_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'education-insight' ),
		'section' => 'education_insight_typography_settings',
		'choices' => $education_insight_font_choices
	) );

    // Theme General Settings
    $wp_customize->add_section('education_insight_theme_settings',array(
        'title' => __('Theme General Settings', 'education-insight'),
        'priority' => 2,
    ) );
    $wp_customize->add_setting( 'education_insight_sticky_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_sticky_heading', array(
		'label'       => esc_html__( 'Sticky Header Settings', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'settings'    => 'education_insight_sticky_heading',
	) ) );
    $wp_customize->add_setting(
		'education_insight_sticky_header',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_sticky_header',
			array(
				'settings'        => 'education_insight_sticky_header',
				'section'         => 'education_insight_theme_settings',
				'label'           => __( 'Show Sticky Header', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_loader_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_loader_heading', array(
		'label'       => esc_html__( 'Loader Settings', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'settings'    => 'education_insight_loader_heading',
	) ) );
	$wp_customize->add_setting(
		'education_insight_theme_loader',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_theme_loader',
			array(
				'settings'        => 'education_insight_theme_loader',
				'section'         => 'education_insight_theme_settings',
				'label'           => __( 'Show Site Loader', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_theme_width_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_theme_width_heading', array(
		'label'       => esc_html__( 'Theme Width Settings', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'settings'    => 'education_insight_theme_width_heading',
	) ) );
	$wp_customize->add_setting('education_insight_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'education_insight_sanitize_choices'
	));
	$wp_customize->add_control('education_insight_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','education-insight'),
        'section' => 'education_insight_theme_settings',
        'choices' => array(
            'full_width' => __('fullwidth','education-insight'),
            'container' => __('container','education-insight'),
            'container_fluid' => __('container fluid','education-insight'),
        ),
	) );
	$wp_customize->add_setting( 'education_insight_text_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_text_heading', array(
		'label'       => esc_html__( 'Menu Settings', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'settings'    => 'education_insight_text_heading',
	) ) );
	$wp_customize->add_setting('education_insight_menu_text_transform',array(
        'default' => 'CAPITALISE',
        'sanitize_callback' => 'education_insight_sanitize_choices'
	));
	$wp_customize->add_control('education_insight_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','education-insight'),
        'section' => 'education_insight_theme_settings',
        'choices' => array(
            'CAPITALISE' => __('CAPITALISE','education-insight'),
            'UPPERCASE' => __('UPPERCASE','education-insight'),
            'LOWERCASE' => __('LOWERCASE','education-insight'),
        ),
	) );
	$wp_customize->add_setting( 'education_insight_section_scroll_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_scroll_heading', array(
		'label'       => esc_html__( 'Scroll Top Settings', 'education-insight' ),
		'section'     => 'education_insight_theme_settings',
		'settings'    => 'education_insight_section_scroll_heading',
	) ) );
	$wp_customize->add_setting(
		'education_insight_scroll_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_scroll_enable',
			array(
				'settings'        => 'education_insight_scroll_enable',
				'section'         => 'education_insight_theme_settings',
				'label'           => __( 'show Scroll Top', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_scroll_options',
		array(
			'default' => 'right_align',
			'transport' => 'refresh',
			'sanitize_callback' => 'education_insight_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Education_Insight_Text_Radio_Button_Custom_Control( $wp_customize, 'education_insight_scroll_options',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Scroll Top Alignment', 'education-insight' ),
			'section' => 'education_insight_theme_settings',
			'choices' => array(
				'left_align' => __('LEFT','education-insight'),
				'center_align' => __('CENTER','education-insight'),
				'right_align' => __('RIGHT','education-insight'),
			)
		)
	) );
	$wp_customize->add_setting('education_insight_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_theme_settings',
		'setting'	=> 'education_insight_scroll_top_icon',
		'type'		=> 'icon'
	)));

	// Post Layouts
    $wp_customize->add_panel( 'education_insight_post_panel', array(
		'title' => esc_html__( 'Post Layout', 'education-insight' ),
		'priority' => 4,
	));
    $wp_customize->add_section('education_insight_layout',array(
        'title' => __(' Single-Post Layout', 'education-insight'),
        'panel' => 'education_insight_post_panel',      
    ) );
    $wp_customize->add_setting( 'education_insight_section_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_post_heading', array(
		'label'       => esc_html__( 'single Post Structure', 'education-insight' ),
		'section'     => 'education_insight_layout',
		'settings'    => 'education_insight_section_post_heading',
	) ) );
	$wp_customize->add_setting( 'education_insight_single_post_option',
		array(
			'default' => 'single_right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Education_Insight_Radio_Image_Control( $wp_customize, 'education_insight_single_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Single Post Page Layout', 'education-insight' ),
			'section' => 'education_insight_layout',
			'choices' => array(

				'single_right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'education-insight' )
				),
				'single_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'education-insight' )
				),
				'single_full_width' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'education-insight' )
				),
			)
		)
	) );
	$wp_customize->add_setting('education_insight_single_post_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new education_insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_post_date',
			array(
				'settings'        => 'education_insight_single_post_date',
				'section'         => 'education_insight_layout',
				'label'           => __( 'Show Date', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_single_post_date', array(
		'selector' => '.date-box',
		'render_callback' => 'education_insight_customize_partial_education_insight_single_post_date',
	) );
	$wp_customize->add_setting('education_insight_single_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_single_date_icon',array(
		'label'	=> __('date Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_layout',
		'setting'	=> 'education_insight_single_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_single_post_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new education_insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_post_admin',
			array(
				'settings'        => 'education_insight_single_post_admin',
				'section'         => 'education_insight_layout',
				'label'           => __( 'Show Author/Admin', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_single_post_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'education_insight_customize_partial_education_insight_single_post_admin',
	) );
	$wp_customize->add_setting('education_insight_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_single_author_icon',array(
		'label'	=> __('Author Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_layout',
		'setting'	=> 'education_insight_single_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_single_post_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new education_insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_post_comment',
			array(
				'settings'        => 'education_insight_single_post_comment',
				'section'         => 'education_insight_layout',
				'label'           => __( 'Show Comment', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('education_insight_single_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_single_comment_icon',array(
		'label'	=> __('comment Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_layout',
		'setting'	=> 'education_insight_single_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_single_post_tag_count',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_post_tag_count',
			array(
				'settings'        => 'education_insight_single_post_tag_count',
				'section'         => 'education_insight_layout',
				'label'           => __( 'Show tag count', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('education_insight_single_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_single_tag_icon',array(
		'label'	=> __('tag Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_layout',
		'setting'	=> 'education_insight_single_tag_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_single_post_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new education_insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_post_tag',
			array(
				'settings'        => 'education_insight_single_post_tag',
				'section'         => 'education_insight_layout',
				'label'           => __( 'Show Tags', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_single_post_tag', array(
		'selector' => '.single-tags',
		'render_callback' => 'education_insight_customize_partial_education_insight_single_post_tag',
	) );
	$wp_customize->add_section('education_insight_archieve_post_layot',array(
        'title' => __('Archieve-Post Layout', 'education-insight'),
        'panel' => 'education_insight_post_panel',
    ) );
	$wp_customize->add_setting( 'education_insight_section_archive_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_archive_post_heading', array(
		'label'       => esc_html__( 'Archieve Post Structure', 'education-insight' ),
		'section'     => 'education_insight_archieve_post_layot',
		'settings'    => 'education_insight_section_archive_post_heading',
	) ) );
	$wp_customize->add_setting( 'education_insight_post_option',
		array(
			'default' => 'right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Education_Insight_Radio_Image_Control( $wp_customize, 'education_insight_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Post Page Layout', 'education-insight' ),
			'section' => 'education_insight_archieve_post_layot',
			'choices' => array(
				'right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'education-insight' )
				),
				'left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'education-insight' )
				),
				'one_column' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'education-insight' )
				),
				'three_column' => array(
					'image' => get_template_directory_uri().'/assets/images/3column.jpg',
					'name' => __( 'Three Column', 'education-insight' )
				),
				'four_column' => array(
					'image' => get_template_directory_uri().'/assets/images/4column.jpg',
					'name' => __( 'Four Column', 'education-insight' )
				),
				'grid_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-sidebar.jpg',
					'name' => __( 'Grid-Sidebar Layout', 'education-insight' )
				),
				'grid_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-left.png',
					'name' => __( 'Grid-Sidebar Layout', 'education-insight' )
				),
				'grid_post' => array(
					'image' => get_template_directory_uri().'/assets/images/grid.jpg',
					'name' => __( 'Grid Layout', 'education-insight' )
				)
			)
		)
	) );
    $wp_customize->add_setting( 'education_insight_grid_column',
		array(
			'default' => '3_column',
			'transport' => 'refresh',
			'sanitize_callback' => 'education_insight_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Education_Insight_Text_Radio_Button_Custom_Control( $wp_customize, 'education_insight_grid_column',
		array(
			'type' => 'select',
			'label' => esc_html__('Grid Post Per Row','education-insight'),
			'section' => 'education_insight_archieve_post_layot',
			'choices' => array(
				'1_column' => __('1','education-insight'),
	            '2_column' => __('2','education-insight'),
	            '3_column' => __('3','education-insight'),
	            '4_column' => __('4','education-insight'),
			)
		)
	) );
	$wp_customize->add_setting('education_insight_post_excerpt',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_integer'
	));
	$wp_customize->add_control(new Education_Insight_Slider_Custom_Control( $wp_customize, 'education_insight_post_excerpt',array(
		'label' => esc_html__( 'Excerpt Limit','education-insight' ),
		'section'=> 'education_insight_archieve_post_layot',
		'settings'=>'education_insight_post_excerpt',
		'input_attrs' => array(
			'reset'			   => 30,
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	$wp_customize->add_setting('education_insight_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_date',
			array(
				'settings'        => 'education_insight_date',
				'section'         => 'education_insight_archieve_post_layot',
				'label'           => __( 'Show Date', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_date', array(
		'selector' => '.date-box',
		'render_callback' => 'education_insight_customize_partial_education_insight_date',
	) );
	$wp_customize->add_setting('education_insight_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_date_icon',array(
		'label'	=> __('date Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_archieve_post_layot',
		'setting'	=> 'education_insight_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_admin',
			array(
				'settings'        => 'education_insight_admin',
				'section'         => 'education_insight_archieve_post_layot',
				'label'           => __( 'Show Author/Admin', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'education_insight_customize_partial_education_insight_admin',
	) );
	$wp_customize->add_setting('education_insight_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_author_icon',array(
		'label'	=> __('Author Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_archieve_post_layot',
		'setting'	=> 'education_insight_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_comment',
			array(
				'settings'        => 'education_insight_comment',
				'section'         => 'education_insight_archieve_post_layot',
				'label'           => __( 'Show Comment', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'education_insight_customize_partial_education_insight_comment',
	) );
	$wp_customize->add_setting('education_insight_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_comment_icon',array(
		'label'	=> __('comment Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_archieve_post_layot',
		'setting'	=> 'education_insight_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_tag',
			array(
				'settings'        => 'education_insight_tag',
				'section'         => 'education_insight_archieve_post_layot',
				'label'           => __( 'Show tag count', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'education_insight_tag', array(
		'selector' => '.tags',
		'render_callback' => 'education_insight_customize_partial_education_insight_tag',
	) );
	$wp_customize->add_setting('education_insight_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_tag_icon',array(
		'label'	=> __('tag Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_archieve_post_layot',
		'setting'	=> 'education_insight_tag_icon',
		'type'		=> 'icon'
	)));

	// breadcrumb
	$wp_customize->add_section('education_insight_breadcrumb_settings',array(
        'title' => __('Breadcrumb Settings', 'education-insight'),
        'priority' => 4
    ) );
	$wp_customize->add_setting( 'education_insight_section_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_breadcrumb_heading', array(
		'label'       => esc_html__( 'Theme Breadcrumb Settings', 'education-insight' ),
		'section'     => 'education_insight_breadcrumb_settings',
		'settings'    => 'education_insight_section_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'education_insight_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_enable_breadcrumb',
			array(
				'settings'        => 'education_insight_enable_breadcrumb',
				'section'         => 'education_insight_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);	
	$wp_customize->add_setting( 'education_insight_single_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_single_breadcrumb_heading', array(
		'label'       => esc_html__( 'Single post & Page', 'education-insight' ),
		'section'     => 'education_insight_breadcrumb_settings',
		'settings'    => 'education_insight_single_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'education_insight_single_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_single_enable_breadcrumb',
			array(
				'settings'        => 'education_insight_single_enable_breadcrumb',
				'section'         => 'education_insight_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_setting( 'education_insight_woocommerce_breadcrumb_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_woocommerce_breadcrumb_heading', array(
			'label'       => esc_html__( 'Woocommerce Breadcrumb', 'education-insight' ),
			'section'     => 'education_insight_breadcrumb_settings',
			'settings'    => 'education_insight_woocommerce_breadcrumb_heading',
		) ) );
		$wp_customize->add_setting(
			'education_insight_woocommerce_enable_breadcrumb',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Education_Insight_Customizer_Customcontrol_Switch(
				$wp_customize,
				'education_insight_woocommerce_enable_breadcrumb',
				array(
					'settings'        => 'education_insight_woocommerce_enable_breadcrumb',
					'section'         => 'education_insight_breadcrumb_settings',
					'label'           => __( 'Show Breadcrumb', 'education-insight' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'education-insight' ),
						'off'    => __( 'Off', 'education-insight' ),
					),
					'active_callback' => '',
				)
			)
		);
	}

	// woocommerce
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_section('education_insight_woocoomerce_section',array(
			 'title' => __('WooCommerce Settings', 'education-insight'),
	        'priority' => 4,
		));
		$wp_customize->add_setting( 'education_insight_section_shoppage_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_shoppage_heading', array(
			'label'       => esc_html__( 'Sidebar Settings', 'education-insight' ),
			'section'     => 'education_insight_woocoomerce_section',
			'settings'    => 'education_insight_section_shoppage_heading',
		) ) );
		$wp_customize->add_setting(
			'education_insight_shop_page_sidebar',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Education_Insight_Customizer_Customcontrol_Switch(
				$wp_customize,
				'education_insight_shop_page_sidebar',
				array(
					'settings'        => 'education_insight_shop_page_sidebar',
					'section'         => 'education_insight_woocoomerce_section',
					'label'           => __( 'Show Shop Page Sidebar', 'education-insight' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'education-insight' ),
						'off'    => __( 'Off', 'education-insight' ),
					),
					'active_callback' => '',
				)
			)
		);
		$wp_customize->add_setting(
			'education_insight_wocommerce_single_page_sidebar',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Education_Insight_Customizer_Customcontrol_Switch(
				$wp_customize,
				'education_insight_wocommerce_single_page_sidebar',
				array(
					'settings'        => 'education_insight_wocommerce_single_page_sidebar',
					'section'         => 'education_insight_woocoomerce_section',
					'label'           => __( 'Show Single Product Page Sidebar', 'education-insight' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'education-insight' ),
						'off'    => __( 'Off', 'education-insight' ),
					),
					'active_callback' => '',
				)
			)
		);
		$wp_customize->add_setting( 'education_insight_section_archieve_product_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_archieve_product_heading', array(
			'label'       => esc_html__( 'Archieve Product Settings', 'education-insight' ),
			'section'     => 'education_insight_woocoomerce_section',
			'settings'    => 'education_insight_section_archieve_product_heading',
		) ) );
		$wp_customize->add_setting('education_insight_archieve_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'education_insight_sanitize_choices'
		));
		$wp_customize->add_control('education_insight_archieve_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','education-insight'),
	        'section' => 'education_insight_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','education-insight'),
	            '2' => __('Two Column','education-insight'),
	            '3' => __('Three Column','education-insight'),
	            '4' => __('four Column','education-insight'),
	            '5' => __('Five Column','education-insight'),
	            '6' => __('Six Column','education-insight'),
	        ),
		) );
		$wp_customize->add_setting( 'education_insight_archieve_shop_perpage', array(
			'default'              => 6,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'education_insight_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'education_insight_archieve_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','education-insight' ),
			'section'     => 'education_insight_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 30,
			),
		) );
		$wp_customize->add_setting( 'education_insight_section_related_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_related_heading', array(
			'label'       => esc_html__( 'Related Product Settings', 'education-insight' ),
			'section'     => 'education_insight_woocoomerce_section',
			'settings'    => 'education_insight_section_related_heading',
		) ) );
		$wp_customize->add_setting('education_insight_related_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'education_insight_sanitize_choices'
		));
		$wp_customize->add_control('education_insight_related_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select Related item Columns','education-insight'),
	        'section' => 'education_insight_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','education-insight'),
	            '2' => __('Two Column','education-insight'),
	            '3' => __('Three Column','education-insight'),
	        ),
		) );
		$wp_customize->add_setting( 'education_insight_related_shop_perpage', array(
			'default'              => 3,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'education_insight_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'education_insight_related_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','education-insight' ),
			'section'     => 'education_insight_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 10,
			),
		) );
		$wp_customize->add_setting(
			'education_insight_related_product',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Education_Insight_Customizer_Customcontrol_Switch(
				$wp_customize,
				'education_insight_related_product',
				array(
					'settings'        => 'education_insight_related_product',
					'section'         => 'education_insight_woocoomerce_section',
					'label'           => __( 'Show Related Products', 'education-insight' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'education-insight' ),
						'off'    => __( 'Off', 'education-insight' ),
					),
					'active_callback' => '',
				)
			)
		);
	}
	
	//button
	$wp_customize->add_section('education_insight_button_options',array(
        'title' => __('Button settings', 'education-insight'),
        'priority' => 4,
    ) );
    $wp_customize->add_setting( 'education_insight_theme_button_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_theme_button_heading', array(
		'label'       => esc_html__( 'Theme Button Settings', 'education-insight' ),
		'section'     => 'education_insight_button_options',
		'settings'    => 'education_insight_theme_button_heading',
	) ) );
    $wp_customize->add_setting( 'education_insight_theme_button_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'education_insight_theme_button_color', array(
	    'label' => esc_html__( 'Background Color','education-insight' ),
	    'section' => 'education_insight_button_options',
	    'settings' => 'education_insight_theme_button_color',
  	)));
	$wp_customize->add_setting('education_insight_button_border_radius',array(
		'default'=> 5,
		'transport' => 'refresh',
		'sanitize_callback' => 'education_insight_sanitize_integer'
	));
	$wp_customize->add_control(new Education_Insight_Slider_Custom_Control( $wp_customize, 'education_insight_button_border_radius',array(
		'label' => esc_html__( 'Border Radius','education-insight' ),
		'section'=> 'education_insight_button_options',
		'settings'=>'education_insight_button_border_radius',
		'input_attrs' => array(
			'reset'			   => 5,
            'step'             => 1,
			'min'              => 0,
			'max'              => 30,
        ),
	)));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'education_insight_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'education_insight_customize_partial_blogdescription',
	) );

	//front page
	$education_insight_num_sections = apply_filters( 'education_insight_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $education_insight_num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'education_insight_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'education-insight' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'education-insight' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'education_insight_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'education_insight_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'education_insight_customize_register' );

function education_insight_customize_partial_blogname() {
	bloginfo( 'name' );
}

function education_insight_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function education_insight_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function education_insight_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('EDUCATION_INSIGHT_PRO_LINK',__('https://www.ovationthemes.com/wordpress/education-wordpress-theme/','education-insight'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Education_Insight_Pro_Control')):
    class Education_Insight_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md-2 col-sm-6 upsell-btn">
                <a href="<?php echo esc_url( EDUCATION_INSIGHT_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATION PREMIUM','education-insight');?> </a>
	        </div>
            <div class="col-md-4 col-sm-6">
                <img class="education_insight_img_responsive " src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
            </div>
	        <div class="col-md-3 col-sm-6">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('EDUCATION PREMIUM - Features', 'education-insight'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'education-insight');?> </li>
                    <li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'education-insight');?> </li>
                   	<li class="upsell-education_insight"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'education-insight');?> </li>
                </ul>
        	</div>
		    <div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( EDUCATION_INSIGHT_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATION PREMIUM','education-insight');?> </a>
		    </div>
			<p><?php printf(__('Please review us if you love our product on %1$sWordPress.org%2$s. </br></br>  Thank You', 'education-insight'), '<a target="blank" href="https://wordpress.org/support/theme/education-insight/reviews/">', '</a>');
            ?></p>
        </label>
    <?php } }
endif;
