<?php
/**
 * Education Insight: Customizer-home-page
 *
 * @subpackage Education Insight
 * @since 1.0
 */

	//  Home Page Panel
	$wp_customize->add_panel( 'education_insight_custompage_panel', array(
		'title' => esc_html__( 'Custom Page Settings', 'education-insight' ),
		'priority' => 2,
	));
	// Top Header
    $wp_customize->add_section('education_insight_top',array(
        'title' => __('Header', 'education-insight'),
        'priority'=> 2,
        'panel' => 'education_insight_custompage_panel',
    ) );
    $wp_customize->add_setting( 'education_insight_section_contact_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_contact_heading', array(
		'label'       => esc_html__( 'Header Settings', 'education-insight' ),		
		'section'     => 'education_insight_top',
		'settings'    => 'education_insight_section_contact_heading',
		'priority'=> 1,
	) ) );
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_setting(
		'education_insight_topbar_enable',
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
				'education_insight_topbar_enable',
				array(
					'settings'        => 'education_insight_topbar_enable',
					'section'         => 'education_insight_top',
					'label'           => __( 'Show Account', 'education-insight' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'education-insight' ),
						'off'    => __( 'Off', 'education-insight' ),
					),
					'priority'=> 1,
					'active_callback' => '',
				)
			)
		);
	}
	$wp_customize->add_setting('education_insight_call',array(
		'default' => '',
		'sanitize_callback' => 'education_insight_sanitize_phone_number'
	));
	$wp_customize->add_control('education_insight_call',array(
		'label' => esc_html__('Add Phone Number','education-insight'),
		'section' => 'education_insight_top',
		'setting' => 'education_insight_call',
		'type'    => 'text',
		'priority'=> 1,
	));
	$wp_customize->selective_refresh->add_partial( 'education_insight_call', array(
		'selector' => '.top_header i',
		'render_callback' => 'education_insight_customize_partial_education_insight_call',
	) );
	$wp_customize->add_setting('education_insight_call_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_call_icon',array(
		'label'	=> __('Add Call Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_top',
		'setting'	=> 'education_insight_call_icon',
		'type'		=> 'icon',
		'priority'=> 1,
	)));
	$wp_customize->add_setting('education_insight_email',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email'
	));
	$wp_customize->add_control('education_insight_email',array(
		'label' => esc_html__('Add Email Address','education-insight'),
		'section' => 'education_insight_top',
		'setting' => 'education_insight_email',
		'type'    => 'text',
		'priority'=> 1,
	));
	$wp_customize->add_setting('education_insight_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_email_icon',array(
		'label'	=> __('Add email Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_top',
		'setting'	=> 'education_insight_email_icon',
		'type'		=> 'icon',
		'priority'=> 1,
	)));

	// Social Media
    $wp_customize->add_section('education_insight_urls',array(
        'title' => __('Social Media', 'education-insight'),
        'priority' => 3,
        'panel' => 'education_insight_custompage_panel',
    ) );
    $wp_customize->add_setting( 'education_insight_section_social_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_social_heading', array(
		'label'       => esc_html__( 'Social Media Settings', 'education-insight' ),
		'description' => __( 'Add social media links in the below feilds', 'education-insight' ),			
		'section'     => 'education_insight_urls',
		'settings'    => 'education_insight_section_social_heading',
	) ) );
	$wp_customize->add_setting(
		'header_social_icon_enable',
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
			'header_social_icon_enable',
			array(
				'settings'        => 'header_social_icon_enable',
				'section'         => 'education_insight_urls',
				'label'           => __( 'Check to show social fields', 'education-insight' ),			
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_section_facebook_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_facebook_heading', array(
		'label'       => esc_html__( 'Facebook Settings', 'education-insight' ),		
		'section'     => 'education_insight_urls',
		'settings'    => 'education_insight_section_facebook_heading',
	) ) );
	$wp_customize->add_setting('education_insight_facebook_icon',array(
		'default'	=> 'fab fa-facebook',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_facebook_icon',array(
		'label'	=> __('Add Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_facebook_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_facebook',array(
		'label' => esc_html__('Add URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_facebook',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'education_insight_header_facebook_target',
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
			'education_insight_header_facebook_target',
			array(
				'settings'        => 'education_insight_header_facebook_target',
				'section'         => 'education_insight_urls',
				'label'           => __( 'Open link in a new tab', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_section_twitter_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_twitter_heading', array(
		'label'       => esc_html__( 'Twitter Settings', 'education-insight' ),		
		'section'     => 'education_insight_urls',
		'settings'    => 'education_insight_section_twitter_heading',
	) ) );
	$wp_customize->add_setting('education_insight_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_twitter_icon',array(
		'label'	=> __('Add Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_twitter_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->selective_refresh->add_partial( 'education_insight_twitter', array(
		'selector' => '.social-icon a i',
		'render_callback' => 'education_insight_customize_partial_education_insight_twitter',
	) );
	$wp_customize->add_setting('education_insight_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_twitter',array(
		'label' => esc_html__('Add URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_twitter',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'education_insight_header_twt_target',
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
			'education_insight_header_twt_target',
			array(
				'settings'        => 'education_insight_header_twt_target',
				'section'         => 'education_insight_urls',
				'label'           => __( 'Open link in a new tab', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_section_linkedin_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_linkedin_heading', array(
		'label'       => esc_html__( 'Linkedin Settings', 'education-insight' ),		
		'section'     => 'education_insight_urls',
		'settings'    => 'education_insight_section_linkedin_heading',
	) ) );
	$wp_customize->add_setting('education_insight_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_linkedin_icon',array(
		'label'	=> __('Add Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_linkedin_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_linkedin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_linkedin',array(
		'label' => esc_html__('Add URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_linkedin',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'education_insight_header_linkedin_target',
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
			'education_insight_header_linkedin_target',
			array(
				'settings'        => 'education_insight_header_linkedin_target',
				'section'         => 'education_insight_urls',
				'label'           => __( 'Open link in a new tab', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'education_insight_section_pinterest_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_pinterest_heading', array(
		'label'       => esc_html__( 'Pinterest Settings', 'education-insight' ),		
		'section'     => 'education_insight_urls',
		'settings'    => 'education_insight_section_pinterest_heading',
	) ) );
	$wp_customize->add_setting('education_insight_pinterest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Education_Insight_Fontawesome_Icon_Chooser(
        $wp_customize,'education_insight_pinterest_icon',array(
		'label'	=> __('Add Icon','education-insight'),
		'transport' => 'refresh',
		'section'	=> 'education_insight_urls',
		'setting'	=> 'education_insight_pinterest_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('education_insight_pinterest',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('education_insight_pinterest',array(
		'label' => esc_html__('Add URL','education-insight'),
		'section' => 'education_insight_urls',
		'setting' => 'education_insight_pinterest',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'education_insight_header_pinterest_target',
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
			'education_insight_header_pinterest_target',
			array(
				'settings'        => 'education_insight_header_pinterest_target',
				'section'         => 'education_insight_urls',
				'label'           => __( 'Open link in a new tab', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'active_callback' => '',
			)
		)
	);

    //Slider
	$wp_customize->add_section( 'education_insight_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'education-insight' ),
		'priority'   => 4,
		'panel' => 'education_insight_custompage_panel',
	) );
	$wp_customize->add_setting( 'education_insight_section_slide_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_slide_heading', array(
		'label'       => esc_html__( 'Slider Settings', 'education-insight' ),
		'description' => __( 'Slider Image Dimension ( 600px x 700px )', 'education-insight' ),		
		'section'     => 'education_insight_slider_section',
		'settings'    => 'education_insight_section_slide_heading',
		'priority'   => 1,
	) ) );
	$wp_customize->add_setting(
		'education_insight_hide_show',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_hide_show',
			array(
				'settings'        => 'education_insight_hide_show',
				'section'         => 'education_insight_slider_section',
				'label'           => __( 'Check To Show Slider', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'priority'   => 1,
				'active_callback' => '',
			)
		)
	);
	$education_insight_args = array('numberposts' => -1);
	$post_list = get_posts($education_insight_args);
	$i = 0;
	$pst_sls[]= __('Select','education-insight');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting('education_insight_post_setting'.$i,array(
			'sanitize_callback' => 'education_insight_sanitize_choices',
		));
		$wp_customize->add_control('education_insight_post_setting'.$i,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','education-insight'),
			'section' => 'education_insight_slider_section',
			'priority' => 1,
			'active_callback' => 'education_insight_slider_dropdown',
		));
		$wp_customize->selective_refresh->add_partial( 'education_insight_post_setting'.$i, array(
			'selector' => '.inner_carousel h2',
			'render_callback' => 'education_insight_customize_partial_education_insight_post_setting'.$i,
		) );
	}
	wp_reset_postdata();

	$wp_customize->add_setting( 'education_insight_slider_content_alignment',
		array(
			'default' => 'CENTER-ALIGN',
			'transport' => 'refresh',
			'sanitize_callback' => 'education_insight_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Education_Insight_Text_Radio_Button_Custom_Control( $wp_customize, 'education_insight_slider_content_alignment',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Slider Content Alignment', 'education-insight' ),
			'section' => 'education_insight_slider_section',
			'choices' => array(
				'LEFT-ALIGN' => __('LEFT','education-insight'),
	            'CENTER-ALIGN' => __('CENTER','education-insight'),
	            'RIGHT-ALIGN' => __('RIGHT','education-insight'),
			),
			'active_callback' => 'education_insight_slider_dropdown',
		)
	) );

	//Middle Section
	$wp_customize->add_section( 'education_insight_middle_section' , array(
    	'title'      => __( 'Services Settings', 'education-insight' ),
		'priority'   => 4,
		'panel' => 'education_insight_custompage_panel',
	) );
	$wp_customize->add_setting( 'education_insight_section_service_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_service_heading', array(
			'label'       => esc_html__( 'Services Settings', 'education-insight' ),	
			'section'     => 'education_insight_middle_section',
			'settings'    => 'education_insight_section_service_heading',
			'priority'   => 1,
	) ) );
	$wp_customize->add_setting(
		'education_insight_middle_sec_hide_show',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_middle_sec_hide_show',
			array(
				'settings'        => 'education_insight_middle_sec_hide_show',
				'section'         => 'education_insight_middle_section',
				'label'           => __( 'Check To Show Section', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'priority'   => 1,
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('education_insight_middle_sec_page_settigs',array(
		'sanitize_callback' => 'education_insight_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('education_insight_middle_sec_page_settigs',array(
		'type'    => 'dropdown-pages',
		'label' => __('Select Page','education-insight'),
		'section' => 'education_insight_middle_section',
		'active_callback' => 'education_insight_middle_sec_dropdown',
	));
	$wp_customize->selective_refresh->add_partial( 'education_insight_middle_sec_page_settigs', array(
		'selector' => '#middle-sec h3',
		'render_callback' => 'education_insight_customize_partial_education_insight_middle_sec_page_settigs',
	) );
	$education_insight_args = array('numberposts' => -1);
	$post_list = get_posts($education_insight_args);
	$s = 0;
	$pst_sls[]= __('Select','education-insight');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $s = 1; $s <= 4; $s++ ) {
		$wp_customize->add_setting('education_insight_mid_section_icon'.$s,array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('education_insight_mid_section_icon'.$s,array(
			'label' => esc_html__('Icon','education-insight'),
			'input_attrs' => array(
            	'placeholder' => __( 'Ex: fas fa-envelope','education-insight' ),
        	),
			'section' => 'education_insight_middle_section',
			'setting' => 'education_insight_mid_section_icon',
			'type'    => 'text',
			'active_callback' => 'education_insight_middle_sec_dropdown',
		));
		$wp_customize->add_setting('education_insight_middle_sec_settigs'.$s,array(
			'sanitize_callback' => 'education_insight_sanitize_choices',
		));
		$wp_customize->add_control('education_insight_middle_sec_settigs'.$s,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','education-insight'),
			'section' => 'education_insight_middle_section',
			'active_callback' => 'education_insight_middle_sec_dropdown',
		));
	}
	wp_reset_postdata();

	// Top Categories
	$wp_customize->add_section('education_insight_popular_courses',array(
		'title' => esc_html__('Courses Settings','education-insight'),
		'priority'=>4,
		'panel' => 'education_insight_custompage_panel',
	));
	$wp_customize->add_setting( 'education_insight_section_popular_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_popular_heading', array(
			'label'       => esc_html__( 'Courses Settings', 'education-insight' ),
			'description' => __( 'Image Dimension ( 410 x 260 ) px', 'education-insight' ),	
			'section'     => 'education_insight_popular_courses',
			'settings'    => 'education_insight_section_popular_heading',
			'priority' => 1,
	) ) );
	$wp_customize->add_setting(
		'education_insight_popular_courses_hide_show',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Education_Insight_Customizer_Customcontrol_Switch(
			$wp_customize,
			'education_insight_popular_courses_hide_show',
			array(
				'settings'        => 'education_insight_popular_courses_hide_show',
				'section'         => 'education_insight_popular_courses',
				'label'           => __( 'Check To Show Section', 'education-insight' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'education-insight' ),
					'off'    => __( 'Off', 'education-insight' ),
				),
				'priority' => 1,
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('education_insight_popular_courses_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('education_insight_popular_courses_heading',array(
		'label' => esc_html__('Heading','education-insight'),
		'section' => 'education_insight_popular_courses',
		'setting' => 'education_insight_popular_courses_heading',
		'type'    => 'text',
		'active_callback' => 'education_insight_popular_courses_dropdown',
	));
	$wp_customize->selective_refresh->add_partial( 'education_insight_popular_courses_heading', array(
		'selector' => '#course-cat h3',
		'render_callback' => 'education_insight_customize_partial_education_insight_popular_courses_heading',
	) );
	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= __('Select','education-insight');
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}
	$wp_customize->add_setting('education_insight_popular_courses_setting',array(
		'default' => 0,
		'sanitize_callback' => 'education_insight_sanitize_select',
	));
	$wp_customize->add_control('education_insight_popular_courses_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display courses','education-insight'),
		'section' => 'education_insight_popular_courses',
		'active_callback' => 'education_insight_popular_courses_dropdown',
	));

	//Footer
    $wp_customize->add_section( 'education_insight_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'education-insight' ),
    	'priority' => 4,
    	'panel' => 'education_insight_custompage_panel',
	) );
    $wp_customize->add_setting( 'education_insight_section_footer_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Education_Insight_Customizer_Customcontrol_Section_Heading( $wp_customize, 'education_insight_section_footer_heading', array(
		'label'       => esc_html__( 'Footer Settings', 'education-insight' ),		
		'section'     => 'education_insight_footer_copyright',
		'settings'    => 'education_insight_section_footer_heading',
	) ) );
    $wp_customize->add_setting('education_insight_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('education_insight_footer_text',array(
		'label'	=> esc_html__('Copyright Text','education-insight'),
		'section'	=> 'education_insight_footer_copyright',
		'type'		=> 'text'
	));
	$wp_customize->selective_refresh->add_partial( 'education_insight_footer_text', array(
		'selector' => '.site-info a',
		'render_callback' => 'education_insight_customize_partial_education_insight_footer_text',
	) );
	$wp_customize->add_setting( 'education_insight_footer_widget',
		array(
			'default' => '4',
			'transport' => 'refresh',
			'sanitize_callback' => 'education_insight_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Education_Insight_Text_Radio_Button_Custom_Control( $wp_customize, 'education_insight_footer_widget',
		array(
			'type' => 'select',
			'label' => esc_html__('Footer Per Column','education-insight'),
			'section' => 'education_insight_footer_copyright',
			'choices' => array(
				'1' => __('1','education-insight'),
	            '2' => __('2','education-insight'),
	            '3' => __('3','education-insight'),
	            '4' => __('4','education-insight'),
			)
		)
	) );