<?php
/**
 * Aak Theme Customizer
 *
 * @package Aak
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aak_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	 //select sanitization function
        function aak_sanitize_select( $input, $setting ){
            $input = sanitize_key($input);
            $choices = $setting->manager->get_control( $setting->id )->choices;
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
        }
      
	
// Typography section
	$wp_customize->add_section('aak_typography', array(
		'title' => __('Aak Theme typography', 'aak'),
		'capability'     => 'edit_theme_options',
		'description'     => __('You can setup Aak theme typography by these options.', 'aak'),
		'priority'       => 4,

	));
	
	    //add setting to your section
        $wp_customize->add_setting( 
            'aak_body_fonts', 
            array(
            	'default'       => 'Poppins',
                'sanitize_callback' => 'aak_sanitize_theme_font',
		        'capability'     => 'edit_theme_options',
		        'type'           => 'theme_mod',
		        'transport' => 'refresh',
		    )
        );
          
        $wp_customize->add_control( 
            'aak_body_fonts', 
            array(
                'label' => esc_html__( 'Select theme body Font', 'aak' ),
                'section' => 'aak_typography',
                'type' => 'select',
                'choices' => array(
                    'Poppins' => esc_html__('Poppins','aak'),
                    'Roboto' => esc_html__('Roboto', 'aak'),
		            'Open Sans' => esc_html__('Open Sans', 'aak'),
		            'Lato' => esc_html__('Lato', 'aak'),
		            'Montserrat' => esc_html__('Montserrat', 'aak'),               
                )
            )
        ); 

    $wp_customize->add_setting('aak_font_size', array(
        'default' =>  '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_font_size_control', array(
        'label'      => __('Body font size', 'aak'),
        'description'     => __('Default body font size is 14px', 'aak'),
        'section'    => 'aak_typography',
        'settings'   => 'aak_font_size',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('aak_font_line_height', array(
        'default' =>  '24',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_font_line_height_control', array(
        'label'      => __('Body font line height', 'aak'),
        'description'     => __('Default body line height is 24px', 'aak'),
        'section'    => 'aak_typography',
        'settings'   => 'aak_font_line_height',
        'type'       => 'text',

    ));
 
	    //add setting to your section
        $wp_customize->add_setting( 
            'aak_head_fonts', 
            array(
            	'default'       => 'Lato',
                'sanitize_callback' => 'aak_sanitize_theme_head_font',
		        'capability'     => 'edit_theme_options',
		        'type'           => 'theme_mod',
		        'transport' => 'refresh',
		    )
        );
          
        $wp_customize->add_control( 
            'aak_head_fonts', 
            array(
                'label' => esc_html__( 'Select Header Tag Font', 'aak' ),
                'section' => 'aak_typography',
                'type' => 'select',
                'choices' => array(
                    'Poppins' => esc_html__('Poppins','aak'),
                    'Roboto' => esc_html__('Roboto', 'aak'),
		            'Open Sans' => esc_html__('Open Sans', 'aak'),
		            'Lato' => esc_html__('Lato', 'aak'),
		            'Montserrat' => esc_html__('Montserrat', 'aak'),               
                )
            )
        ); 
	    //add setting to your section
        $wp_customize->add_setting( 
            'aak_font_weight_head', 
            array(
            	'default'       => '700',
                'sanitize_callback' => 'aak_sanitize_select',
		        'capability'     => 'edit_theme_options',
		        'type'           => 'theme_mod',
		        'transport' => 'refresh',
		    )
        );
          
        $wp_customize->add_control( 
            'aak_font_weight_head', 
            array(
                'label' => esc_html__( 'Site header font weight', 'aak' ),
                'section' => 'aak_typography',
                'type' => 'select',
                'choices' => array(
                    '400' => __('Normal', 'aak'),
		            '500' => __('Semi Bold', 'aak'),
		            '700' => __('Bold', 'aak'),
		            '900' => __('Extra Bold', 'aak'),              
                )
            )
        ); 
    /*End typography section*/
     // Add Aak top header section
    $wp_customize->add_section('aak_topbar', array(
        'title' => __('Aak Top bar', 'aak'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The beshop topbar options ', 'aak'),
        'priority'       => 5,

    ));
	$wp_customize->add_setting( 'aak_topbar_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_topbar_show', array(
        'label'      => __('Show header topbar? ', 'aak'),
        'description'=> __('You can show or hide header topbar.', 'aak'),
        'section'    => 'aak_topbar',
        'settings'   => 'aak_topbar_show',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting('aak_topbar_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_topbar_container', array(
        'label'      => __('Topbar Container Type', 'aak'),
        'description'=> __('You can set standard container or full width container. ', 'aak'),
        'section'    => 'aak_topbar',
        'settings'   => 'aak_topbar_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'aak'),
            'container-fluid' => __('Full width Container', 'aak'),
        ),
    ));
    $wp_customize->add_setting('aak_topbar_mtext', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  esc_html__('Welcome to Our Website','aak'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_topbar_mtext', array(
        'label'      => __('Welcome text', 'aak'),
        'description'     => esc_html__('Enter your website welcome text. Leave empty if you don\'t want the text.','aak'),
        'section'    => 'aak_topbar',
        'settings'   => 'aak_topbar_mtext',
        'type'       => 'text',
    ));
    $wp_customize->add_setting( 'aak_topbar_menushow' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_topbar_menushow', array(
        'label'      => __('Show header topbar menu? ', 'aak'),
        'description'=> __('You can show or hide topbar menu. You need to add menu from menu section for display menu.', 'aak'),
        'section'    => 'aak_topbar',
        'settings'   => 'aak_topbar_menushow',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'aak_topbar_search' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_topbar_search', array(
        'label'      => __('Show header topbar search? ', 'aak'),
        'description'=> __('You can show or hide topbar search.', 'aak'),
        'section'    => 'aak_topbar',
        'settings'   => 'aak_topbar_search',
        'type'       => 'checkbox',
    ) );
	// Add setting
	$wp_customize->add_setting('aak_topbar_bg', array(
		'default' => '#343a40',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'aak_topbar_bg', array(
				'label' => __('Topbar Background Color','aak'),
				'section' => 'aak_topbar'
			)
		)
	);
	// Add setting
	$wp_customize->add_setting('aak_topbar_color', array(
		'default' => '#fff',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'aak_topbar_color', array(
				'label' => __('Topbar text Color','aak'),
				'section' => 'aak_topbar'
			)
		)
	);
	// Add setting
	$wp_customize->add_setting('aak_topbar_hcolor', array(
		'default' => '#dedede',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'aak_topbar_hcolor', array(
				'label' => __('Topbar link hover Color','aak'),
				'section' => 'aak_topbar'
			)
		)
	); // topbar section end
	$wp_customize->add_section('aak_main_header', array(
        'title' => __('Aak Header', 'aak'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The Aak theme main header settings options ', 'aak'),
        'priority'       => 20,


    ));
    $wp_customize->add_setting('aak_header_style', array(
        'default'       => 'style1',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_header_style', array(
        'label'      => __('Site Header Style', 'aak'),
        'section'    => 'aak_main_header',
        'settings'   => 'aak_header_style',
        'type'       => 'select',
        'choices'    => array(
            'style1' => __('Style One', 'aak'),
            'style2' => __('Style Two', 'aak'),
        ),
    ));
    $wp_customize->add_setting('aak_logo_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
      //  'priority'       => 20,
    ));
    $wp_customize->add_control('aak_logo_position', array(
        'label'      => __('Logo Position', 'aak'),
        'section'    => 'aak_main_header',
        'settings'   => 'aak_logo_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Logo left', 'aak'),
            'center' => __('Logo center', 'aak'),
            'right' => __('Logo right', 'aak'),
        ),
    ));
    $wp_customize->add_setting('aak_menu_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_menu_position', array(
        'label'      => __('Main menu Position', 'aak'),
        'section'    => 'aak_main_header',
        'settings'   => 'aak_menu_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Menu left', 'aak'),
            'center' => __('Menu center', 'aak'),
            'right' => __('Menu right', 'aak'),
        ),
    ));


	// Add beshop blog section
	$wp_customize->add_section('aak_blog', array(
		'title' => __('Aak Blog', 'aak'),
		'capability'     => 'edit_theme_options',
		'description'     => __('The beshop theme blog options ', 'aak'),
     'priority'       => 60,

	));
	 $wp_customize->add_setting('aak_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_blog_container', array(
        'label'      => __('Container type', 'aak'),
        'description'=> __('You can set standard container or full width container. ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'aak'),
            'container-fluid' => __('Full width Container', 'aak'),
        ),
    ));
    $wp_customize->add_setting('aak_blog_layout', array(
        'default'        => 'rightside',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_blog_layout', array(
        'label'      => __('Select Blog Layout', 'aak'),
        'description'=> __('Right and Left sidebar only show when sidebar widget is available. ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'aak'),
            'leftside' => __('Left Sidebar', 'aak'),
            'fullwidth' => __('Full Width', 'aak'),
        ),
    ));
		
    $wp_customize->add_setting('aak_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_blog_style', array(
        'label'      => __('Select Blog Style', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'aak'),
            'list' => __('List Style', 'aak'),
            'classic' => __('Classic Style', 'aak'),
        ),
    ));
   
    
    $wp_customize->add_setting( 'aak_blogdate_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_blogdate_control', array(
        'label'      => __('Show Posts Date? ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_blogdate_show',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'aak_blogauthor_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_blogauthor_control', array(
        'label'      => __('Show Posts Author? ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_blogauthor_show',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'aak_postcat_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_postcat_control', array(
        'label'      => __('Show Posts Categories? ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_postcat_show',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'aak_posttags_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_posttags_control', array(
        'label'      => __('Show Posts tags? ', 'aak'),
        'section'    => 'aak_blog',
        'settings'   => 'aak_posttags_show',
        'type'       => 'checkbox',
    ) );

    	// Add beshop page section
	$wp_customize->add_section('aak_page', array(
		'title' => __('Aak Page', 'aak'),
		'capability'     => 'edit_theme_options',
		'description'     => __('The beshop theme Page options ', 'aak'),
     'priority'       => 70,

	));
	 $wp_customize->add_setting('aak_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_page_container', array(
        'label'      => __('Page Container type', 'aak'),
        'description'=> __('You can set standard container or full width container for page. ', 'aak'),
        'section'    => 'aak_page',
        'settings'   => 'aak_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Page Container', 'aak'),
            'container-fluid' => __('Full width Page Container', 'aak'),
        ),
    ));
    $wp_customize->add_setting('aak_page_layout', array(
        'default'        => 'rightside',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'aak_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('aak_page_layout', array(
        'label'      => __('Select Page Layout', 'aak'),
        'description'=> __('Right and Left sidebar only show when sidebar widget is available. ', 'aak'),
        'section'    => 'aak_page',
        'settings'   => 'aak_page_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'aak'),
            'leftside' => __('Left Sidebar', 'aak'),
            'fullwidth' => __('Full Width', 'aak'),
        ),
    ));

    /*
* Footer setting section
*
*/
// Add beshop top header section
    $wp_customize->add_panel( 'aak_footer_panel', array(
  //  'priority'       => 75,
    'title'          => __('Aak footer settings', 'aak'),
    'description'    => __('All Aak theme footer settings in the panel', 'aak'),
    ) );
    $wp_customize->add_section('aak_footer_top', array(
        'title' => __('Aak Footer Top Settings', 'aak'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The beshop footer settings options ', 'aak'),
        'panel'    => 'aak_footer_panel',

    ));
    $wp_customize->add_setting( 'aak_topfooter_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '1',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'aak_topfooter_show', array(
        'label'      => __('Show Top Footer? ', 'aak'),
        'description'=> __('You can show or hide footer top section.The section only visible when you will set footer widget. ', 'aak'),
        'section'    => 'aak_footer_top',
        'settings'   => 'aak_topfooter_show',
        'type'       => 'checkbox',
        
    ) );
        //link hover color
    $wp_customize->add_setting('aak_topfooter_bgcolor', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_topfooter_bgcolor', array(
                'label' => __('Footer top background color.','aak'),
                'section' => 'aak_footer_top'
            )
        )
    );
        //link hover color
    $wp_customize->add_setting('aak_tftitle_color', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_tftitle_color', array(
                'label' => __('Footer Top Widget Title Color.','aak'),
                'section' => 'aak_footer_top'
            )
        )
    );
        //link hover color
    $wp_customize->add_setting('aak_tftext_color', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_tftext_color', array(
                'label' => __('Footer Top Widget Text Color.','aak'),
                'section' => 'aak_footer_top'
            )
        )
    );
        //link hover color
    $wp_customize->add_setting('aak_tflink_hovercolor', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_tflink_hovercolor', array(
                'label' => __('Footer Top Widget Link hover Color.','aak'),
                'section' => 'aak_footer_top'
            )
        )
    );
    // Footer section
    $wp_customize->add_section('aak_footer', array(
        'title' => __('Aak Footer Settings', 'aak'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The beshop footer settings options ', 'aak'),
        'panel'    => 'aak_footer_panel',

    ));
        
    $wp_customize->add_setting('aak_footer_bgcolor', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_footer_bgcolor', array(
                'label' => __('Footer background color.','aak'),
                'section' => 'aak_footer'
            )
        )
    );   
    $wp_customize->add_setting('aak_footer_color', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_footer_color', array(
                'label' => __('Footer text color.','aak'),
                'section' => 'aak_footer'
            )
        )
    );
    $wp_customize->add_setting('aak_footerlink_hcolor', array(
        'default' => '',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'aak_footerlink_hcolor', array(
                'label' => __('Footer Link Hover color.','aak'),
                'section' => 'aak_footer'
            )
        )
    );














	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'aak_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'aak_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'aak_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function aak_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function aak_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aak_customize_preview_js() {
	wp_enqueue_script( 'aak-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'aak_customize_preview_js' );
