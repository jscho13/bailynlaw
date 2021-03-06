<?php 
/**
 * Magical addons style and scripts 
 */
class mgAddonsEnqueueFile{
	
	function __construct(){
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_widget_styles' ] );
		add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'frontend_assets_scripts' ] );
		add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'frontend_progressbar_scripts' ] );
		add_action( 'admin_enqueue_scripts', [$this, 'mgaddons_admin_scripts'] );
	}

		/*
	plugin css
	*/
	function frontend_widget_styles(){
		wp_enqueue_style( 'bootstrap', MAGICAL_ADDON_URL.'assets/css/bootstrap.min.css', array(), '4.3.1', 'all');
/*		wp_enqueue_style( 'magical-default-style',  MAGICAL_ADDON_URL.'assets/css/mg-default-style.css', array(), '1.0', 'all');
*/		wp_register_style( 'flipclock',  MAGICAL_ADDON_URL.'assets/css/flipclock.css', array(), '1.0', 'all');
//accordion style
		wp_register_style( 'mg-accordion',  MAGICAL_ADDON_URL.'assets/css/accordion/mg-accordion.css', array(), '1.0', 'all');
//image hover card
		wp_register_style( 'mg-hover-card',  MAGICAL_ADDON_URL.'assets/widget-assets/img-hvr-card/imagehover.min.css', array(), '1.0', 'all');
//Timeline style
		wp_register_style( 'mg-timeline',  MAGICAL_ADDON_URL.'assets/widget-assets/timeline/timeline.min.css', array(), '1.0', 'all');
//Timeline style
		wp_register_style( 'mg-tabs',  MAGICAL_ADDON_URL.'assets/widget-assets/mg-tabs/mg-tabs.css', array(), '1.0', 'all');
//Slider style
		wp_register_style( 'swiper',  MAGICAL_ADDON_URL.'assets/widget-assets/slider/swiper.min.css', array(), '5.3.1', 'all');
		wp_register_style( 'swiper-style',  MAGICAL_ADDON_URL.'assets/widget-assets/slider/mgs-style.css', array(), '1.0.3', 'all');
//lightbox style
		wp_enqueue_style( 'venobox',  MAGICAL_ADDON_URL.'assets/css/venobox.min.css', array(), '1.8.9', 'all');

//main style
		wp_enqueue_style( 'mg-style',  MAGICAL_ADDON_URL.'assets/css/mg-style.css', array(), time(), 'all');



	}

		/*
	plugin js
	*/
	function frontend_assets_scripts(){
		wp_enqueue_script("bootstrap-js",MAGICAL_ADDON_URL.'assets/js/bootstrap.min.js',array('jquery'),'4.3.1',true);
		wp_enqueue_script("flipclock-js",MAGICAL_ADDON_URL.'assets/js/flipclock.min.js',array('jquery'),'1.0',true);

		//accordion style
		wp_enqueue_script("jquery.beefup-js",MAGICAL_ADDON_URL.'assets/widget-assets/accordion/jquery.beefup.min.js',array('jquery'),'1.0',true);
		wp_enqueue_script("mg-accordion-js",MAGICAL_ADDON_URL.'assets/js/accordion/mg-accordion.js',array('jquery'),'1.0',true);
//Timeline script 
		wp_enqueue_script("mg-timeline-js", MAGICAL_ADDON_URL.'assets/widget-assets/timeline/timeline.min.js', array(), '1.0',true);
		wp_enqueue_script("mg-timeline-active", MAGICAL_ADDON_URL.'assets/widget-assets/timeline/timeline-active.js', array(), '1.0',true);
// Vinobox lightbox js
		wp_enqueue_script("venobox", MAGICAL_ADDON_URL.'assets/js/venobox.min.js', array(), '1.8.9',true);
		wp_enqueue_script("venobox-active", MAGICAL_ADDON_URL.'assets/js/venobox-active.js', array(), '1.8.9',true);

	//Slider script
		wp_enqueue_script("swiper", MAGICAL_ADDON_URL.'assets/widget-assets/slider/swiper.min.js', array(), '5.3.1',true);
		wp_enqueue_script("swiper-active", MAGICAL_ADDON_URL.'assets/widget-assets/slider/mgs-main.js', array(), '5.3.1',true);


		wp_enqueue_script("mga-script-js",MAGICAL_ADDON_URL.'assets/js/main-scripts.js',array('jquery'),time(),true);
		wp_enqueue_script("waypoints-js",'//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js',array('jquery'),time(),false);
	}
	/*
	progressbar scripts
	*/
	function frontend_progressbar_scripts(){
		wp_enqueue_script('elementor-waypoints');
		wp_enqueue_script("progressbar-js",MAGICAL_ADDON_URL.'assets/js/progressbar/progressbar.min.js',array('jquery'),'1.0',true);
		wp_enqueue_script("progressbar-active-js",MAGICAL_ADDON_URL.'assets/js/progressbar/progressbar-active.js',array('jquery'),time(),true);
	}

	public function mgaddons_admin_scripts(){
		global $pagenow;

		if( in_array($pagenow, array('admin.php'))) {
		   
			//wp_enqueue_style('mgaddons-admin-style',  MAGICAL_ADDON_URL.'assets/css/switcher.css', array(), '1.0.5', 'all' );
			wp_enqueue_style('mgaddons-admin-style',  MAGICAL_ADDON_URL.'assets/css/mg-admin.css', array(), '1.0.5', 'all' );

			/*wp_enqueue_script( 'switcher',  MAGICAL_ADDON_URL.'assets/js/jquery.switcher.min.js', array( 'jquery' ), '2.5.1', false);
			wp_enqueue_script( 'mgaddons-admin-script',  MAGICAL_ADDON_URL.'assets/js/mg-admin.js', array( 'jquery' ), '2.5.1', true);*/
		 }
	}


}