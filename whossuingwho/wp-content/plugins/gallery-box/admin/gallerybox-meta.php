<?php
/*
 * All metabox create here.
 *
 * @link              http://awesomebootstrap.net
 * @since             1.0.0
 * @package           Gallery box wordpress plugin
 */

//add group fields 

/**
 * Hook in and add a metabox to demonstrate grouped fields
 */
 if ( ! function_exists( 'gbox_meta_group' ) ) :
function gbox_meta_group() {
	/**
	 *  Gallery box meta field groups
	 */
	$gallery_box_meta = new_cmb2_box( array(
		'id'           => 'm_gallery',
		'title'        => __( 'Choose gallery type and click to add item', 'gbox' ),
		'object_types' => array( 'gallery_box', ),
        'context'    => 'advanced',
		'priority'   => 'high',
		'tabs'      => array(
            
            'gbox_welcome' => array(
                'label' => __('Welcome tab', 'gbox'),
               // 'show_on_cb' => 'cmb2_tabs_show_if_front_page',
                'icon'  => 'dashicons-format-image', // Dashicon
            ),
            'simg' => array(
                'label' => __('Quick imaegs Gallery', 'gbox'),
               // 'show_on_cb' => 'cmb2_tabs_show_if_front_page',
                'icon'  => 'dashicons-format-image', // Dashicon
            ),
            'image' => array(
                'label' => __('Advance Image Gallery', 'gbox'),
               // 'show_on_cb' => 'cmb2_tabs_show_if_front_page',
                'icon'  => 'dashicons-images-alt2', // Dashicon
            ),
            'portfolio' => array(
                'label' => __('Portfolio Gallery', 'gbox'),
               // 'show_on_cb' => 'cmb2_tabs_show_if_front_page',
                'icon'  => 'dashicons-portfolio', // Dashicon
            ),
            'youtubee'  => array(
                'label' => __('Youtube gallery', 'gbox'),
                'icon'  => 'dashicons-video-alt2', // Dashicon
            ),
            'vime'    => array(
                'label' => __('Vimeo gallery', 'gbox'),
                'icon'  => 'dashicons-video-alt', // Custom icon, using image
            ),
            'iframe'    => array(
                'label' => __('iframe gallery', 'gbox'),
                'icon'  => 'dashicons-welcome-view-site', // Custom icon, using image
            ),
            'tabgallery'    => array(
                'label' => __('Gallery Tab pro', 'gbox'),
                'icon'  => 'dashicons-admin-generic', // Custom icon, using image
            ),
            'css'    => array(
                'label' => __('Custom css', 'gbox'),
                'icon'  => 'dashicons-admin-generic', // Custom icon, using image
            ),
            'donation'    => array(
                'label' => __('Upgrade pro', 'gbox'),
                'icon'  => 'dashicons-visibility', // Custom icon, using image
            ),
        ),
	) );

	/*
	* welcome tab
	*
	*/
	$gallery_box_meta->add_field(array(
		'name'       => '',
        'desc'       => __( ' 
        <div class="gboxwelcome-text"> 
        <div class="gboxwel-img"> 
            <img src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'images/image-small.jpg'.'" alt="" />
        </div>
            <div class="gboxwel-text">
            <h1>'.__('Welcome Gallery Box','gbox').'</h1>
            <a target="_blank" class="gbox-pro-link" href="https://wpthemespace.com/product/gallery-box-pro/">'.__('Upgrade To Pro','gbox').'</a>
            <h3>'.__('Select your gallery tab','gbox').'</h3>
           <p>'.__('Only add gallery items in your selected gallery and ignor all other tab.','gbox').'</p> 
            </div>
        </div>'

        , 'gbox' ),
        'id'         => 'gbox_wel',
        'type'       => 'text',
        'tab'  => 'gbox_welcome',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        
	) );



	/*
	* Simple image gallery
	*
	*/
	$gallery_box_meta->add_field(array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'simg_type',
        'type' => 'radio_image',
        'tab'  => 'simg',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'options' => array(
			'img_add' => __( 'Add gallery images', 'gbox' ),
			'img_set'   => __( 'Quick gallery settings', 'gbox' ),
		),
		'default' => 'img_add',
		
    ));

    $gallery_box_meta->add_field(array(
		'name' => __( 'Add Gallery Images', 'gbox' ),
		'desc' => __( 'You can add all gallery images by this options. It\'s quick and easy.', 'gbox' ),
		'id'   => 'simple_imgs',
		'type' => 'file_list',
		'tab'  => 'simg',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'attributes' => array(
			'data-conditional-id' => 'simg_type',
			'data-conditional-value' => 'img_add',

		),

	) );

	$simage_group_id = $gallery_box_meta->add_field( array(
        'id'          => 'simg_main',
        'type'        => 'group',
        'tab'  => 'simg',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
        'repeatable'  => false,
        'options'     => array(
	        'group_title'   => __( 'Quick Image gallery settings', 'gbox' ), 
	        'closed'     => false,
			),
        
    ) );


$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Image gallery layout', 'gbox' ),
		'desc'             => __( 'Select image gallery layout masonry or fixed height.', 'gbox' ),
		'id'               => 'simg_layout_type',
		'type'             => 'pw_select',
		'default'          => 'masonry_layout',
		'options'          => array(
			'normal_layout'   => __( 'Fixed height', 'gbox' ),
			'masonry_layout'   => __( 'Masonry gallery layout style one ', 'gbox' ),
			'pro1'   => __( 'Masonry gallery layout style two (Available in pro) )', 'gbox' ),
			'pro2'   => __( 'Masonry gallery layout style three (Available in pro)', 'gbox' ),
			'carousel_slider'   => __( 'Carousel slider', 'gbox' ),
			'carousel_fixed'   => __( 'Carousel slider fixed height', 'gbox' ),
		
		),
        
	) );


$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Show carousel nav', 'gbox' ),
		'desc'             => __( 'You can show or hide carousel nav.', 'gbox' ),
		'id'               => 'simg_car_nav',
		'type'	           => 'switch',
        'default'          => '',
        'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'carousel_slider', 'carousel_fixed' ) ) ,

		),
        
	) );
$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Show carousel dot', 'gbox' ),
		'desc'             => __( 'You can show or hide carousel dot.', 'gbox' ),
		'id'               => 'simg_car_dot',
		'type'	           => 'switch',
        'default'          => '',
        'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'carousel_slider', 'carousel_fixed' ) ) ,

		),
        
	) );
$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Carousel auto play', 'gbox' ),
		'desc'             => __( 'You can active or hide carousel autoplay.', 'gbox' ),
		'id'               => 'simg_car_auto',
		'type'	           => 'switch',
        'default'          => '',
        'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'carousel_slider', 'carousel_fixed' ) ) ,

		),
        
	) );
$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Number of images', 'gbox' ),
		'desc'             => __( 'Set imaegs for carosuel. You can set one image for create slider.', 'gbox' ),
		'id'               => 'simg_car_imgnum',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '3', // start value
		'value_label' => __('images:','gbox'),
        'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'carousel_slider', 'carousel_fixed' ) ) ,

		),
        
	) );

$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Images height', 'gbox' ),
		'desc'             => __( 'Set image height. Image height only work fixed height layout and fixed height carosuel.', 'gbox' ),
		'id'               => 'simg_custom_height',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '220', // start value
		'value_label' => __('px:','gbox'),
        'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'normal_layout','carousel_fixed' ) ) ,

		),
        
	) );


$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Image size', 'gbox' ),
		'desc'             => __( 'Set image size. image size randomly set in the masonary image layout . ', 'gbox' ),
		'id'               => 'simg_img_size',
		'type'             => 'pw_select',
		'default'          => 'gbox-medium',
		'options'          => array(
			'thumbnail' => __( 'Thumbnail ( 150px x 150px hard cropped )  ', 'gbox' ),
			'medium'   => __( ' Medium ( 300px x 300px hard cropped )  ', 'gbox' ),
			'gbox-medium'   => __( ' Extra medium ( 450px x 450px )  ', 'gbox' ),
            'gbox-large'   => __( ' Large medium ( 600px x 600px )  ', 'gbox' ),
            'gbox-horizontal'   => __( ' horizontal( 1000px x 500px )  ', 'gbox' ),
            'gbox-hlarge'   => __( ' Large horizontal ( 1400px x 600px )  ', 'gbox' ),
			'gbox-vertical'   => __( ' Vertical ( 600px x 900px )  ', 'gbox' ),
			'large' => __( 'Large ( 1024px x 1024px max height 1024px )', 'gbox' ),
			'full'     => __( 'Full (original size uploaded)', 'gbox' ),
		
		),
		'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'carousel_slider', 'carousel_fixed','normal_layout' ) ) ,

		),
        
	) );
$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Image gallery column', 'gbox' ),
		'desc'             => __( 'Set image gallery column for this image gallery. Image column not work in justify gallery.', 'gbox' ),
		'id'               => 'simg_column',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			1  => __( 'one column','gbox' ),
            2  => __( 'Two column','gbox' ),
            3  => __( 'Three column','gbox' ),
            4  => __( 'Four column','gbox' ),
		
		),
		'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'masonry_layout', 'masonry_layout_two','masonry_layout_three','normal_layout' ) ) ,

		),
        
	) );    

$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Image gallery lightbox', 'gbox' ),
		'desc'             => __( 'You may set lightbox only overlay or lihghtbox and link overlay or set image only gallery.', 'gbox' ),
		'id'               => 'simg_lightbox',
		'type'             => 'pw_select',
		'default'          => 'light_show',
		'options'          => array(
			'light_show'   => __( 'Lightbox active', 'gbox' ),
			'light_hide'   => __( 'Lightbox hide', 'gbox' ),
		
		),
        
	) );

$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Load more button', 'gbox' ),
		'desc'             => __( 'Load more button only available in pro verison.', 'gbox' ),
		'id'               => 'simg_loadmore',
		'type'             => 'pw_select',
		'default'          => 'pro1',
		'options'          => array(
			'pro1'   => __( 'Only available in pro', 'gbox' ),
            'disable'  => __( 'Disable','gbox' ),
		
		),
		'attributes' => array(
			'data-conditional-id' => 'simg_layout_type',
			'data-conditional-value' => wp_json_encode( array( 'masonry_layout', 'masonry_layout_two','masonry_layout_three','normal_layout' ) ) ,

		),
        
	) );

$gallery_box_meta->add_group_field( $simage_group_id, array(
		'name'             => __( 'Images margin', 'gbox' ),
		'desc'             => __( 'Set image margin. The margin work in right and bottom position.', 'gbox' ),
		'id'               => 'simg_img_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '100',
		'default'     => '0', // start value
		'value_label' => __('px:','gbox'),
        
        
	) );

	/*
	 * Advance Image all meta options set here.
	 */
	$gallery_box_meta->add_field(array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'adimg_type',
        'type' => 'radio_image',
        'tab'  => 'image',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'options' => array(
			'img_add' => __( 'Add advance images', 'gbox' ),
			'img_set'   => __( 'Advance image gallery Settings', 'gbox' ),
		),
		'default' => 'img_add',
		
    ));
	$image_group_id = $gallery_box_meta->add_field( array(
        'id'          => 'img_main',
        'type'        => 'group',
        'tab'  => 'image',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
        'before_group'       => '<div id="gbox_adimg">',
        'after_group'        => '</div>',
        'options'     => array(
            'group_title'   => __( 'Advance Image gallery item {#}', 'gbox' ),
            'sortable'          => true,
            'add_button'    => __( 'Add more', 'gbox' ),
            'remove_button' => __( 'Remove Entry', 'gbox' ),
        ),
    ) );

	$gallery_box_meta->add_group_field( $image_group_id, array(
		'name' => __( 'Enter gallery item title', 'gbox' ),
		'desc' => __( 'Set Your gallery item title here.', 'gbox' ),
		'id'   => 'image_title',
		'type' => 'text',
	) );
	$gallery_box_meta->add_group_field( $image_group_id, array(
		'name' => __( 'Set gallery Image', 'gbox' ),
		'desc' => __( 'This image show in front.Big size image good for masonry image layout.', 'gbox' ),
		'id'   => 'image_small',
		'type' => 'file',
	) );
	$gallery_box_meta->add_group_field( $image_group_id, array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'advance_options',
        'type' => 'radio_image',
        'options' => array(
			'show_adv' => __( 'Show advance options', 'gbox' ),
			'hide_adv'   => __( 'Hide advance options', 'gbox' ),
		),
		'default' => 'hide_adv',
		
    ));

    $gallery_box_meta->add_group_field( $image_group_id, array(
		'name' => __( 'Enter link url', 'gbox' ),
		'desc' => __( 'Please type or past your link url here. The link only show link only gallery.', 'gbox' ),
		'id'   => 'link_url',
		'type' => 'text_url',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
        
	) );
    
	$gallery_box_meta->add_group_field( $image_group_id, array(
		'name' => __( 'Set lightbox Image', 'gbox' ),
		'desc' => __( 'This image show when lightbox open.If you don\'t set this image, primery gallery image will be open lightbox.', 'gbox' ),
		'id'   => 'image_light',
		'type' => 'file',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
        
	) );
	
	$gallery_box_meta->add_group_field( $image_group_id, array(
		'name'       => __( 'Enter image lightbox caption', 'gbox' ),
		'desc' 		=> __( 'Set your lightbox caption.You can hide or show caption by lightbox settings.Default caption is item title', 'gbox' ),
		'id'         => 'img_caption',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
       
	) );

	$gallery_box_meta->add_group_field( $image_group_id, array(
		'name'       => __( 'Enter button text', 'gbox' ),
		'desc' 		=> __( 'Button text must be small. <strong>Note:</strong> Button text only show lightbox only mode. Default button text is( view large ).', 'gbox' ),
		'id'         => 'img_btn_text',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
	) );

	// advance gallery settings
$settings_group = $gallery_box_meta->add_field( array(
		'id'          => 'settings_main',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Gallery settings', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="settings_maintab">',
        'after_group'        => '</div>',
        'tab'  => 'image',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );

	
	$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Image gallery type', 'gbox' ),
		'desc'             => __( 'Select image gallery layout masonry or fixed height.', 'gbox' ),
		'id'               => 'layout_type',
		'type'             => 'pw_select',
		'default'          => 'masonry',
		'options'          => array(
			'n_gallery'   => __( 'Fixed height gallery layout ', 'gbox' ),
			'masonry'   => __( 'masonry layout style one', 'gbox' ),
			'pro1'   => __( 'masonry layout style two (pro feature)', 'gbox' ),
			'pro2'   => __( 'masonry layout style three (pro feature)', 'gbox' ),
		
		),
	) );
		$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Set images height', 'gbox' ),
		'desc'             => __( 'Set image height by this settings. Image height only work fixed height gallery.', 'gbox' ),
		'id'               => 'img_custom_height',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '220', // start value
		'value_label' => __('px:','gbox'),
		'attributes' => array(
			'data-conditional-id' => 'layout_type',
			'data-conditional-value' => 'n_gallery',

		)
		
	) );
	$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Image size', 'gbox' ),
		'desc'             => __( 'Set image size. image size randomly set in the masonary image layout . ', 'gbox' ),
		'id'               => 'adimg_img_size',
		'type'             => 'pw_select',
		'default'          => 'gbox-medium',
		'options'          => array(
			'default' => __( 'Thumbnail ( 150px x 150px hard cropped )  ', 'gbox' ),
			'thumbnail' => __( 'Thumbnail ( 150px x 150px hard cropped )  ', 'gbox' ),
			'medium'   => __( ' Medium ( 300px x 300px hard cropped )  ', 'gbox' ),
			'gbox-medium'   => __( ' Extra medium ( 450px x 450px )  ', 'gbox' ),
            'gbox-large'   => __( ' Large medium ( 600px x 600px )  ', 'gbox' ),
            'gbox-horizontal'   => __( ' horizontal( 1000px x 500px )  ', 'gbox' ),
            'gbox-hlarge'   => __( ' Large horizontal ( 1400px x 600px )  ', 'gbox' ),
			'gbox-vertical'   => __( ' Vertical ( 600px x 900px )  ', 'gbox' ),
			'large' => __( 'Large ( 1024px x 1024px max height 1024px )', 'gbox' ),
			'full'     => __( 'Full (original size uploaded)', 'gbox' ),
		
		),
		'attributes' => array(
			'data-conditional-id' => 'layout_type',
			'data-conditional-value' => wp_json_encode( array( 'masonry_layout', 'n_gallery' ) ) ,

		)
        
	) );
    $gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Image gallery column', 'gbox' ),
		'desc'             => __( 'Set image gallery column for this image gallery.', 'gbox' ),
		'id'               => 'uni_img_column',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			1  => __( 'one column','gbox' ),
            2  => __( 'Two column','gbox' ),
            3  => __( 'Three column','gbox' ),
            4  => __( 'Four column','gbox' ),
		
		),
        
	) );
    $gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Image gallery overlay', 'gbox' ),
		'desc'             => __( 'You may set lightbox only overlay or title only or link overlay or set image only gallery.', 'gbox' ),
		'id'               => 'gbox_img_link_type',
		'type'             => 'pw_select',
		'default'          => 'light',
		'options'          => array(
			'light'   => __( 'Lightbox only', 'gbox' ),
			'link_only'   => __( 'Link only', 'gbox' ),
			'tit_only'   => __( 'Title only gallery', 'gbox' ),
			'img_only'   => __( 'Image only gallery', 'gbox' ),
		
		),
	) );
    $gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Gallery items order', 'gbox' ),
		'desc'             => __( 'You can set order ascending or descending.', 'gbox' ),
		'id'               => 'gbox_img_order',
		'type'             => 'pw_select',
		'default'          => 'asc',
		'options'          => array(
			'asc'   => __( 'Ascending order', 'gbox' ),
			'desc'   => __( 'Descending order', 'gbox' ),
		
		),
	) );
	$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Select hover animation', 'gbox' ),
		'desc'             => __( 'This hover animation only for this image gallery. This animation not work in image only gallery. <span style="color:red">Support 16 animation in pro version.</span>', 'gbox' ),
		'id'               => 'uni_img_hover',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
						'default' => __( 'Default', 'gbox' ),
						'ehover1' => __( 'Animation One', 'gbox' ),
						'ehover2'   => __( 'Animation Two', 'gbox' ),
						'ehover3'     => __( 'Animation Three', 'gbox' ),
						'ehover4'     => __( 'Animation Four', 'gbox' ),
						'ehover5'     => __( 'Animation Five', 'gbox' ),
						
						),
           
	) );
	
	$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Item margin', 'gbox' ),
		'desc'             => __( 'The margin work right and bottom. The margin set by px.', 'gbox' ),
		'id'               => 'img_right_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('px:','gbox'),
		
	) );

	$gallery_box_meta->add_group_field( $settings_group, array(
		'name'             => __( 'Load more button', 'gbox' ),
		'desc'             => __( 'Load more button only available in pro verison.', 'gbox' ),
		'id'               => 'uniqe_loadmore',
		'type'             => 'pw_select',
		'default'          => 'pro1',
		'options'          => array(
			'pro1'   => __( 'Only available in pro', 'gbox' ),
            'disable'  => __( 'Disable','gbox' ),
		
		),
	) );


	/*
	 * portfolio gallery meta.
	 */
	$gallery_box_meta->add_field(array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'portfolio_type',
        'type' => 'radio_image',
        'tab'  => 'portfolio',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'options' => array(
			'img_add' => __( 'Add portfolios', 'gbox' ),
			'img_set'   => __( 'Portfolio gallery Settings', 'gbox' ),
		),
		'default' => 'img_add',
		
    ));
	$portfolio_group_id = $gallery_box_meta->add_field( array(
        'id'          => 'portfo_main',
        'type'        => 'group',
        'tab'  => 'portfolio',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
        'before_group'       => '<div id="gbox_portfolio">',
        'after_group'        => '</div>',
        'options'     => array(
            'group_title'   => __( 'Portfolio gallery item {#}', 'gbox' ), 
            'add_button'    => __( 'Add more', 'gbox' ),
            'remove_button' => __( 'Remove Entry', 'gbox' ),
            'sortable'          => true,
        ),
    ) );

	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
		'name' => __( 'Enter portfolio title', 'gbox' ),
		'desc' => __( 'Portfolio item title write here.', 'gbox' ),
		'id'   => 'portfolio_title',
		'type' => 'text',
	) );
	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
		'name' => __( 'Set Portfolio Image', 'gbox' ),
		'desc' => __( 'Set your portfolio image here.', 'gbox' ),
		'id'   => 'port_img',
		'type' => 'file',
	) );
	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
		'name' => __( 'Enter portfolio link', 'gbox' ),
		'desc' => __( 'Enter your portfolio link here.', 'gbox' ),
		'id'   => 'port_link',
		'type' => 'text_url',
        
	) );
	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'advance_options',
        'type' => 'radio_image',
        'options' => array(
			'show_adv' => __( 'Show advance options', 'gbox' ),
			'hide_adv'   => __( 'Hide advance options', 'gbox' ),
		),
		'default' => 'hide_adv',
		
    ));


    
	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
		'name' => __( 'Set lightbox Image', 'gbox' ),
		'desc' => __( 'This image show when lightbox open.If you don\'t set this image, gallery image will be open lightbox.', 'gbox' ),
		'id'   => 'image_light',
		'type' => 'file',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
        
	) );
	
	$gallery_box_meta->add_group_field( $portfolio_group_id, array(
		'name'       => __( 'Enter image lightbox caption', 'gbox' ),
		'desc' 		=> __( 'Set your lightbox caption.You can hide or show caption by lightbox settings.Default caption is item title', 'gbox' ),
		'id'         => 'port_caption',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'advance_options',
			'data-conditional-value' => 'show_adv',

		),
       
	) );


	// advance gallery settings
$port_settings_group = $gallery_box_meta->add_field( array(
		'id'          => 'port_settings',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Portfolio gallery settings', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="port_settings">',
        'after_group'        => '</div>',
        'tab'  => 'portfolio',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );

	
	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Portfolio gallery type', 'gbox' ),
		'desc'             => __( 'Select image gallery layout masonry or fixed height.', 'gbox' ),
		'id'               => 'layout_type',
		'type'             => 'pw_select',
		'default'          => 'masonry',
		'options'          => array(
			'fixed'   => __( 'Fixed height gallery layout ', 'gbox' ),
			'masonry'   => __( 'masonry layout style one', 'gbox' ),
			'pro1'   => __( 'masonry layout style two (pro feature)', 'gbox' ),
			'pro2'   => __( 'masonry layout style three (pro feature)', 'gbox' ),
		
		),
	) );
	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Set images height', 'gbox' ),
		'desc'             => __( 'Set your image height. The height only work when you set fixed image.', 'gbox' ),
		'id'               => 'img_custom_height',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '220', // start value
		'value_label' => __('px:','gbox'),
		'attributes' => array(
			'data-conditional-id' => 'layout_type',
			'data-conditional-value' => 'fixed',

		)
		
	) );
	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Portfolio Image size', 'gbox' ),
		'desc'             => __( 'Set Portfolio image size. image size randomly set in the masonary image layout. ', 'gbox' ),
		'id'               => 'port_img_size',
		'type'             => 'pw_select',
		'default'          => 'gbox-medium',
		'options'          => array(
			'default' => __( 'Thumbnail ( 150px x 150px hard cropped )  ', 'gbox' ),
			'thumbnail' => __( 'Thumbnail ( 150px x 150px hard cropped )  ', 'gbox' ),
			'medium'   => __( ' Medium ( 300px x 300px hard cropped )  ', 'gbox' ),
			'gbox-medium'   => __( ' Extra medium ( 450px x 450px )  ', 'gbox' ),
            'gbox-large'   => __( ' Large medium ( 600px x 600px )  ', 'gbox' ),
            'gbox-horizontal'   => __( ' horizontal( 1000px x 500px )  ', 'gbox' ),
            'gbox-hlarge'   => __( ' Large horizontal ( 1400px x 600px )  ', 'gbox' ),
			'gbox-vertical'   => __( ' Vertical ( 600px x 900px )  ', 'gbox' ),
			'large' => __( 'Large ( 1024px x 1024px max height 1024px )', 'gbox' ),
			'full'     => __( 'Full (original size uploaded)', 'gbox' ),
		
		),
		'attributes' => array(
			'data-conditional-id' => 'layout_type',
			'data-conditional-value' => wp_json_encode( array( 'masonry_layout', 'fixed' ) ) ,

		)
        
	) );
    $gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Portfolio image gallery column', 'gbox' ),
		'desc'             => __( 'Set image gallery column for this image gallery.', 'gbox' ),
		'id'               => 'uni_img_column',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			1  => __( 'one column','gbox' ),
            2  => __( 'Two column','gbox' ),
            3  => __( 'Three column','gbox' ),
            4  => __( 'Four column','gbox' ),
		
		),
        
	) );

	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Select hover animation', 'gbox' ),
		'desc'             => __( 'This hover animation only for this image gallery. <span style="color:red">Support 16 animation in pro version.</span> ', 'gbox' ),
		'id'               => 'uni_img_hover',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
						'default' => __( 'Default', 'gbox' ),
						'ehover1' => __( 'Animation One', 'gbox' ),
						'ehover2'   => __( 'Animation Two', 'gbox' ),
						'ehover3'     => __( 'Animation Three', 'gbox' ),
						'ehover4'     => __( 'Animation Four', 'gbox' ),
						'ehover5'     => __( 'Animation Five', 'gbox' ),
						
						),
           
	) );

	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Gallery items order', 'gbox' ),
		'desc'             => __( 'You can set order ascending or descending.', 'gbox' ),
		'id'               => 'gbox_portfolio_order',
		'type'             => 'pw_select',
		'default'          => 'asc',
		'options'          => array(
			'asc'   => __( 'Ascending order', 'gbox' ),
			'desc'   => __( 'Descending order', 'gbox' ),
		
		),
	) );

	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Portfolio link open', 'gbox' ),
		'desc'             => __( 'You can portfolio link self tab or new tab.', 'gbox' ),
		'id'               => 'gbox_portfolio_link_tergat',
		'type'             => 'pw_select',
		'default'          => '_blank',
		'options'          => array(
			'_self'   => __( 'Self Tab', 'gbox' ),
			'_blank'   => __( 'New Tab', 'gbox' ),
		
		),
	) );
	
	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Item margin', 'gbox' ),
		'desc'             => __( 'The margin work right and bottom. The margin set by px.', 'gbox' ),
		'id'               => 'img_right_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('px:','gbox'),
		
	) );

	$gallery_box_meta->add_group_field( $port_settings_group, array(
		'name'             => __( 'Load more button', 'gbox' ),
		'desc'             => __( 'Load more button only available in pro verison.', 'gbox' ),
		'id'               => 'uniqe_loadmore',
		'type'             => 'pw_select',
		'default'          => 'pro1',
		'options'          => array(
			'pro1'   => __( 'Only available in pro', 'gbox' ),
            'disable'  => __( 'Disable','gbox' ),
		
		),
	) );



	/*
	 *Youtube all options meta set here.
	 */
	$gallery_box_meta->add_field(array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'youtube_type',
        'type' => 'radio_image',
        'tab'  => 'youtube',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'options' => array(
			'you_add' => __( 'Add Youtube gallery video', 'gbox' ),
			'you_set'   => __( 'Youtube gallery settings', 'gbox' ),
		),
		'default' => 'you_add',
		
    ));
	$Youtube_group_id = $gallery_box_meta->add_field( array(
		'id'          => 'youtube_main',
		'type'        => 'group',
		'options'     => array(
            'group_title'   => __( 'Video gallery item  {#}', 'gbox' ), 
            'add_button'    => __( 'Add more', 'gbox' ),
            'remove_button' =>  __( 'Remove', 'gbox' ),
            'closed'     => false,
             'sortable'      => true,
            ),
        'before_group'       => '<div id="youtube_maintab">',
        'after_group'        => '</div>',
        'tab'  => 'youtube',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
		'name' => __( 'Enter Gallery item title', 'gbox' ),
		'desc' => __( 'Youtube Gallery item title enter here. ', 'gbox' ),
		'id'   => 'you_title',
		'type' => 'text',
		'allow' => array( 'url', 'attachment' )

	) );

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
		'name'       => __( 'Youtube video link', 'gbox' ),
		'desc' 		=> __( 'Past or type Youtube video link. Go your Youtube url and copy link and past in this box.', 'gbox' ),
		'id'         => 'you_url',
		'type'       => 'oembed',
	) );

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'you_advance',
        'type' => 'radio_image',
        'options' => array(
			'show_adv' => __( 'Show advance options', 'gbox' ),
			'hide_adv'   => __( 'Hide advance options', 'gbox' ),
		),
		'default' => 'hide_adv',
		
    ));

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
		'name' => __( 'Set Youtube gallery image', 'gbox' ),
		'desc' => __( '(optional) This image show in front. Default image is ( Youtube default image)', 'gbox' ),
		'id'   => 'you_image',
		'type' => 'file',
		'allow' => array( 'url', 'attachment' ),
		'attributes' => array(
			'data-conditional-id' => 'you_advance',
			'data-conditional-value' => 'show_adv',

		),

	) );

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
		'name'       => __( 'Enter video lightbox caption', 'gbox' ),
		'desc' 		=> __( 'Set your lightbox caption.You can hide or show caption by lightbox settings.Default caption is item title', 'gbox' ),
		'id'         => 'You_caption',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'you_advance',
			'data-conditional-value' => 'show_adv',

		),
	) );

	$gallery_box_meta->add_group_field( $Youtube_group_id, array(
		'name'       => __( 'Enter button text', 'gbox' ),
		'desc' 		=> __( 'Button text must be small.Default button text is( Show video )', 'gbox' ),
		'id'         => 'youtube_button',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'you_advance',
			'data-conditional-value' => 'show_adv',

		),
	) );

	//Youtube gallery settings
$you_settings = $gallery_box_meta->add_field( array(
		'id'          => 'you_settings',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Youtube gallery settings', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="you_settings">',
        'after_group'        => '</div>',
        'tab'  => 'youtube',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );

	
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Youtube gallery layout', 'gbox' ),
		'desc'             => __( 'Select image gallery layout masonry or fixed height.', 'gbox' ),
		'id'               => 'you_layout',
		'type'             => 'pw_select',
		'default'          => 'masonry',
		'options'          => array(
			'fixed'   => __( 'Fixed height gallery layout ', 'gbox' ),
			'masonry'   => __( 'Masonry layout style', 'gbox' ),
		
		),
	) );
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Set Youtube thumbnail height', 'gbox' ),
		'desc'             => __( 'Set Youtube video thumbnail height.', 'gbox' ),
		'id'               => 'thumb_height',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '220', // start value
		'value_label' => __('px:','gbox'),
		'attributes' => array(
			'data-conditional-id' => 'you_layout',
			'data-conditional-value' => 'fixed',

		)
		
	) );
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Video thumbnail size', 'gbox' ),
		'desc'             => __( 'Set image size. The image size only work in custom video thumbnail. ', 'gbox' ),
		'id'               => 'you_thumb_size',
		'type'             => 'pw_select',
		'default'          => 'gbox-medium',
		'options'          => array(
			'medium'   => __( ' Medium ( 300px x 300px hard cropped )  ', 'gbox' ),
			'gbox-medium'   => __( ' Extra medium ( 450px x 450px )  ', 'gbox' ),
            'gbox-large'   => __( ' Large medium ( 600px x 600px )  ', 'gbox' ),
            'gbox-horizontal'   => __( ' horizontal( 1000px x 500px )  ', 'gbox' ),
            'gbox-hlarge'   => __( ' Large horizontal ( 1400px x 600px )  ', 'gbox' ),
			'gbox-vertical'   => __( ' Vertical ( 600px x 900px )  ', 'gbox' ),
		
		),
		
        
	) );
	
    $gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Video autoplay', 'gbox' ),
		'desc'             => __( 'You can show or hide active or hide autoplay.', 'gbox' ),
		'id'               => 'youtube_auto',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			'yes' => __( 'Active','gbox' ),
            'no'  => __( 'Hide','gbox' ),
		
		),
        
	) );	
    $gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Show video icon', 'gbox' ),
		'desc'             => __( 'You can show or hide video play icon.', 'gbox' ),
		'id'               => 'video_icon',
		'type'             => 'pw_select',
		'default'          => 'show',
		'options'          => array(
			'show' => __( 'Show','gbox' ),
            'hide'  => __( 'Hide','gbox' ),
		
		),
        
	) );
    $gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Youtube gallery column', 'gbox' ),
		'desc'             => __( 'Set Youtbe gallery column for this Youtbe gallery.', 'gbox' ),
		'id'               => 'you_column',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			1  => __( 'one column','gbox' ),
            2  => __( 'Two column','gbox' ),
            3  => __( 'Three column','gbox' ),
            4  => __( 'Four column','gbox' ),
		
		),
        
	) );
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Select hover animation', 'gbox' ),
		'desc'             => __( 'This hover animation only for this Youtube gallery. <span style="color:red">Support 16 animation in pro version.</span>', 'gbox' ),
		'id'               => 'you_hover',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
						'default' => __( 'Default', 'gbox' ),
						'ehover1' => __( 'Animation One', 'gbox' ),
						'ehover2'   => __( 'Animation Two', 'gbox' ),
						'ehover3'     => __( 'Animation Three', 'gbox' ),
						'ehover4'     => __( 'Animation Four', 'gbox' ),
						'ehover5'     => __( 'Animation Five', 'gbox' ),
						
						),
           
	) );
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Gallery items order', 'gbox' ),
		'desc'             => __( 'You can set order ascending or descending.', 'gbox' ),
		'id'               => 'gbox_you_order',
		'type'             => 'pw_select',
		'default'          => 'asc',
		'options'          => array(
			'asc'   => __( 'Ascending order', 'gbox' ),
			'desc'   => __( 'Descending order', 'gbox' ),
		
		),
	) );
	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Item margin', 'gbox' ),
		'desc'             => __( 'The margin work right and bottom. The margin set by px.', 'gbox' ),
		'id'               => 'you_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('px:','gbox'),
		
	) );

	$gallery_box_meta->add_group_field( $you_settings, array(
		'name'             => __( 'Load more button for this gallery', 'gbox' ),
		'desc'             => __( 'Load more button only available in pro verison.', 'gbox' ),
		'id'               => 'you_loadmore',
		'type'             => 'pw_select',
		'default'          => 'pro1',
		'options'          => array(
			'pro1'   => __( 'Only available in pro', 'gbox' ),
            'disable'  => __( 'Disable','gbox' ),
		
		),
	) );

	

	/*
	 * Iframe gallery  meta options.
	 */
	$gallery_box_meta->add_field(array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'iframe_type',
        'type' => 'radio_image',
        'tab'  => 'iframe',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        'options' => array(
			'iframe_add' => __( 'Add iframe gallery url', 'gbox' ),
			'iframe_set'   => __( 'iframe gallery settings', 'gbox' ),
		),
		'default' => 'iframe_add',
		
    ));
	$iframe_group_id = $gallery_box_meta->add_field( array(
		'id'          => 'iframe_main',
		'type'        => 'group',
		'options'     => array(
            'group_title'   => __( 'iframe gallery item  {#}', 'gbox' ), // since
            'add_button'    => __( 'Add more', 'gbox' ),
            'remove_button' =>  __( 'Remove', 'gbox' ),
            'closed'     => false,
            'sortable'      => true,
            ),
        'before_group'       => '<div id="iframe_maintab">',
        'after_group'        => '</div>',
        'tab'  => 'iframe',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );
	$gallery_box_meta->add_group_field( $iframe_group_id, array(
		'name' => __( 'Enter gallery item title', 'gbox' ),
		'desc' => __( 'Iframe gallery item title enter here.', 'gbox' ),
		'id'   => 'iframe_title',
		'type' => 'text',
	) );
	$gallery_box_meta->add_group_field( $iframe_group_id, array(
		'name' => __( 'Set Iframe gallery image', 'gbox' ),
		'desc' => __( 'This image show in front.Image size (300*300) for 4 column,(450*450) for 3 column, (600*600) for 2 column.All images use same size for better view.', 'gbox' ),
		'id'   => 'Iframe_image',
		'type' => 'file',
	) );
	$gallery_box_meta->add_group_field( $iframe_group_id, array(
		'name'       => __( 'Enter page url', 'gbox' ),
		'desc'        =>  __('Copy your webpage url and past this box.', 'gbox' ),
		'id'         => 'iframe_url',
		'type'       => 'text_url',
	) );
	$gallery_box_meta->add_group_field( $iframe_group_id, array(
        'name' => esc_html__('', 'gbox'),
        'id'   => 'iframe_advance',
        'type' => 'radio_image',
        'options' => array(
			'show_adv' => __( 'Show advance options', 'gbox' ),
			'hide_adv'   => __( 'Hide advance options', 'gbox' ),
		),
		'default' => 'hide_adv',
		
    ));	
	$gallery_box_meta->add_group_field( $iframe_group_id, array(
		'name'       => __( 'Enter lightbox iframe caption', 'gbox' ),
		'desc' => __( 'Set your lightbox caption.You can hide or show caption by lightbox settings.Default caption is item title', 'gbox' ),
		'id'         => 'iframe_caption',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'iframe_advance',
			'data-conditional-value' => 'show_adv',

		),
	) );

	$gallery_box_meta->add_group_field( $iframe_group_id, array(
		'name'       => __( 'Enter button text', 'gbox' ),
		'desc' => __( 'Button text must be small.Default button text is( SHOW IFRAME )', 'gbox' ),
		'id'         => 'iframe_button',
		'type'       => 'text',
		'attributes' => array(
			'data-conditional-id' => 'iframe_advance',
			'data-conditional-value' => 'show_adv',

		),
	) );

//iframe gallery settings
	$iframe_settings = $gallery_box_meta->add_field( array(
		'id'          => 'iframe_settings',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'iframe gallery settings', 'gbox' ),
        'closed'     => false,
		),
        'before_group'       => '<div id="iframe_settings">',
        'after_group'        => '</div>',
        'tab'  => 'iframe',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );

	
	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'iframe gallery layout', 'gbox' ),
		'desc'             => __( 'Select iframe gallery layout masonry or fixed height.', 'gbox' ),
		'id'               => 'iframe_layout',
		'type'             => 'pw_select',
		'default'          => 'masonry',
		'options'          => array(
			'fixed'   => __( 'Fixed height gallery layout ', 'gbox' ),
			'masonry'   => __( 'Masonry layout', 'gbox' ),
		
		),
	) );
	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Set iframe thumbnail height', 'gbox' ),
		'desc'             => __( 'Set iframe video thumbnail height.', 'gbox' ),
		'id'               => 'iframe_height',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '220', // start value
		'value_label' => __('px:','gbox'),
		'attributes' => array(
			'data-conditional-id' => 'iframe_layout',
			'data-conditional-value' => 'fixed',

		)
		
	) );
	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'iframe thumbnail size', 'gbox' ),
		'desc'             => __( 'Set image size. image size set for iframe gallery. ', 'gbox' ),
		'id'               => 'iframe_thumb_size',
		'type'             => 'pw_select',
		'default'          => 'gbox-medium',
		'options'          => array(
			'medium'   => __( ' Medium ( 300px x 300px hard cropped )  ', 'gbox' ),
			'gbox-medium'   => __( ' Extra medium ( 450px x 450px )  ', 'gbox' ),
            'gbox-large'   => __( ' Large medium ( 600px x 600px )  ', 'gbox' ),
            'gbox-horizontal'   => __( ' horizontal( 1000px x 500px )  ', 'gbox' ),
            'gbox-hlarge'   => __( ' Large horizontal ( 1400px x 600px )  ', 'gbox' ),
			'gbox-vertical'   => __( ' Vertical ( 600px x 900px )  ', 'gbox' ),
		
		),
		
        
	) );

    $gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Vimeo gallery column', 'gbox' ),
		'desc'             => __( 'Set iframe gallery column for this iframe gallery.', 'gbox' ),
		'id'               => 'iframe_column',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
			'default'  => __( 'Default','gbox' ),
			1  => __( 'one column','gbox' ),
            2  => __( 'Two column','gbox' ),
            3  => __( 'Three column','gbox' ),
            4  => __( 'Four column','gbox' ),
		
		),
        
	) );


	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Select hover animation', 'gbox' ),
		'desc'             => __( 'This hover animation only for this iframe gallery. <span style="color:red">Support 16 animation in pro version.</span>', 'gbox' ),
		'id'               => 'iframe_hover',
		'type'             => 'pw_select',
		'default'          => 'default',
		'options'          => array(
						'default' => __( 'Default', 'gbox' ),
						'ehover1' => __( 'Animation One', 'gbox' ),
						'ehover2'   => __( 'Animation Two', 'gbox' ),
						'ehover3'     => __( 'Animation Three', 'gbox' ),
						'ehover4'     => __( 'Animation Four', 'gbox' ),
						'ehover5'     => __( 'Animation Five', 'gbox' ),
						
						),
           
	) );
	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Gallery items order', 'gbox' ),
		'desc'             => __( 'You can set order ascending or descending.', 'gbox' ),
		'id'               => 'gbox_iframe_order',
		'type'             => 'pw_select',
		'default'          => 'asc',
		'options'          => array(
			'asc'   => __( 'Ascending order', 'gbox' ),
			'desc'   => __( 'Descending order', 'gbox' ),
		
		),
	) );
	
	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Item margin', 'gbox' ),
		'desc'             => __( 'The margin work right and bottom. The margin set by px.', 'gbox' ),
		'id'               => 'iframe_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('px:','gbox'),
		
	) );

	$gallery_box_meta->add_group_field( $iframe_settings, array(
		'name'             => __( 'Load more button for this gallery', 'gbox' ),
		'desc'             => __( 'Load more button only available in pro verison.', 'gbox' ),
		'id'               => 'iframe_loadmore',
		'type'             => 'pw_select',
		'default'          => 'pro1',
		'options'          => array(
			'pro1'   => __( 'Only available in pro', 'gbox' ),
            'disable'  => __( 'Disable','gbox' ),
		
		),
	) );

	/*
	 * Custom css field.
	 */

	 $gallery_box_meta->add_field(array(
		'name'             => __( 'Custom css', 'gbox' ),
		'desc'             => __( 'Enter your custom css code here.This css code only for this gallery.', 'gbox' ),
		'id'               => 'custom_css',
		'type'             => 'textarea_code',
		'default'          => '',
		'tab'  => 'css',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
        

	) );

    $yout_gallery = $gallery_box_meta->add_field( array(
		'id'          => 'youtu_gallery',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Youtube Gallery', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="tab_gallery">',
        'after_group'        => '</div>',
        'tab'  => 'youtubee',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );
    $gallery_box_meta->add_group_field( $yout_gallery, array(
		'name'       => '',
        'desc'       => __( ' 
        <div class="gboxhelp-text"> 
        	<a href="https://wpthemespace.com/product/gallery-box-pro/" target="_blank">
            <img src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'images/gallery-youtube.png'.'" alt="pro image" />
            </a>
            <a href="'.esc_url('http://gbox.wpthemespace.com/youtube-video-gallery/').'" target="_blank" class="gbox-demo-link">Show youtube gallery demo</a>
        </div>'

        , 'gbox' ),
        'id'         => 'tab_gal',
        'type'       => 'text',
        
	) );

    $vim_gallery = $gallery_box_meta->add_field( array(
		'id'          => 'vim_gallery',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Vimeo Gallery', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="tab_gallery">',
        'after_group'        => '</div>',
        'tab'  => 'vime',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );
    $gallery_box_meta->add_group_field( $vim_gallery, array(
		'name'       => '',
        'desc'       => __( ' 
        <div class="gboxhelp-text"> 
        	<a href="https://wpthemespace.com/product/gallery-box-pro/" target="_blank">
            <img src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'images/gallery-vimeo.png'.'" alt="pro image" />
            </a><br >
            <a href="'.esc_url('http://gbox.wpthemespace.com/vimeo-video-gallery/').'" target="_blank" class="gbox-demo-link">Show vimeo gallery demo</a>
        </div>'

        , 'gbox' ),
        'id'         => 'tab_gal',
        'type'       => 'text',
        
	) );
	
    $tab_gallery = $gallery_box_meta->add_field( array(
		'id'          => 'tab_gallery',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Tab Gallery', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="tab_gallery">',
        'after_group'        => '</div>',
        'tab'  => 'tabgallery',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );
    $gallery_box_meta->add_group_field( $tab_gallery, array(
		'name'       => '',
        'desc'       => __( ' 
        <div class="gboxhelp-text"> 
        	<a href="https://wpthemespace.com/product/gallery-box-pro/" target="_blank">
            <img src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'images/gallery-tab.png'.'" alt="pro image" />
            </a>
        </div>'

        , 'gbox' ),
        'id'         => 'tab_gal',
        'type'       => 'text',
        
	) );
    $help_groupe = $gallery_box_meta->add_field( array(
		'id'          => 'gbox_help',
		'type'        => 'group',
        'repeatable'  => false,
		'options'     => array(
        'group_title'   => __( 'Upgrade', 'gbox' ), // since
        'closed'     => false,
		),
        'before_group'       => '<div id="gbox_helptab">',
        'after_group'        => '</div>',
        'tab'  => 'donation',
        'render_row_cb' => array('CMB2_Tabs', 'tabs_render_group_row_cb'),
	) );
    $gallery_box_meta->add_group_field( $help_groupe, array(
		'name'       => '',
        'desc'       => __( ' 
        <div class="gboxhelp-text"> 
        	<a href="https://wpthemespace.com/product/gallery-box-pro/" target="_blank">
            <img src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'images/gbox-pro.png'.'" alt="pro image" />
            </a>
        </div>'

        , 'gbox' ),
        'id'         => 'donar_helper',
        'type'       => 'text',
        
	) );
  
   
   	$gallery_box_info = new_cmb2_box( array(
		'id'            => 'gbox_doc_inf',
		'title'         => __( 'Video tutorial and demo', 'gbox' ),
		'object_types'  => array( 'gallery_box', ), // Post type
		'context'       => 'side',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	// Regular text field
	$gallery_box_info->add_field( array(
		'name'       => '<a class="button button-primary button-large" target="_blank" href="http://gbox.wpthemespace.com/">'.__('View demo and video tutorial','gbox').'</a>',
		/*'desc'       => '<a class="five-star" target="_blank"  href="https://wordpress.org/support/plugin/gallery-box/reviews/?filter=5">'.__('If you love the gallery then Please give five stars rating .  Your five stars will encourage me a lot.','gbox').'</a>',*/
		'id'         => 'gbox_info',
		'type'       => 'text',
	) ); 
    
	
}
add_action( 'cmb2_admin_init', 'gbox_meta_group');
endif;



//Admin notice 
function gbox_space_all() {
    if(get_option('gbox2n8')){
        return;
    }
	$class = 'gbox-notice notice notice-warning is-dismissible';
	$message = __( '<strong><span>Hi buddy!! UPGRADE TODAY:</span>  <span>UPGRADE Gallery Box FOR LIFETIME WITH NOMINAL PRICE:</span> Gallery Box PRO LICENSE NOW LIFETIME FOR YOU. BUY ONE TIME AND GET LIFETIME UPDATE, ADVANCED FEATURES, Youtube and Vimeo video Gallery, Tab Gallery, HIGH-QUALITY PERFORMANCE AND SUPPORT. SO WHY YOU LATE? BUILD YOUR SITE WITH PRO VERSION .</strong>', 'gute' );
	$url2 =esc_url('https://wpthemespace.com/product/gallery-box-pro/?add-to-cart=688');
    $url1 = esc_url('https://wpthemespace.com/product/gallery-box-pro/');

	printf( '<div class="%1$s" style="padding:10px 15px 20px;background: aliceblue;"><p>%2$s</p><a target="_blank" class="button button-primary" href="%3$s" style="margin-right:10px">'.__('Upgrade Pro','gute').'</a><a target="_blank" class="button button-primary" href="%4$s">'.__('Show details','gute').'</a><a style="margin-left:10px;cursor: pointer;" class="gbox-dismiss">Dissimiss the notice</a></div>', esc_attr( $class ), wp_kses_post( $message ),$url2,$url1 ); 
}
add_action( 'admin_notices', 'gbox_space_all' );

function gbox_admin_notice_option(){
    if(isset($_GET['ghide']) && $_GET['ghide'] == 1 ){
        update_option( 'gbox2n8', 1);
    }
}
add_action('init','gbox_admin_notice_option');


if( !function_exists('wpspace_admin_notice_mplugin')):
add_action( 'admin_notices', 'wpspace_admin_notice_mplugin' );
    function wpspace_admin_notice_mplugin() {
        global $pagenow;
        if(get_option('gboxmgp12') ||  $pagenow  == 'themes.php' || $pagenow  == 'plugins.php'){
        return;
        }

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        
        if (! file_exists( WP_PLUGIN_DIR . '/magical-posts-display/magical-posts-display.php' ) ) {

                $magial_einstall_url =  wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=magical-posts-display' ), 'install-plugin_magical-posts-display' );
                    $wpnmessage = sprintf(
                    /* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
                    esc_html__( 'Best WordPress posts display plugin %1$s, Install and show your posts awesome way!! It\'s free!!!  %2$s', 'gbox' ),
                    '<strong>' . esc_html__( 'Magical post display', 'gbox' ) . '</strong>',
                    '<a class="button button-primary" style="margin-left:20px" href="'.$magial_einstall_url.'">' . __( 'Install Magical posts Display', 'gbox' ) . '</a>'

                );
            printf( '<div class="notice notice-warning is-dismissible" style="padding: 13px 10px"><p>%1$s</p><button class="nothanks mgp-dismiss wpepop-dismiss">%2$s</button> <a style="margin-left:5px" href="%3$s" class="button-primary">%4$s</a></div> ', $wpnmessage,esc_html__('No Thanks','gbox'),$magial_einstall_url,esc_html__('Check one time','gbox') );

            
        }

    }
endif;

if( !function_exists('wpspace_admin_notice_option')):
function wpspace_admin_notice_option(){
    if(isset($_GET['dismissed']) && $_GET['dismissed'] == 1 ){
        update_option( 'gboxmgp12', 1);
    }
}
add_action('init','wpspace_admin_notice_option');
endif;

