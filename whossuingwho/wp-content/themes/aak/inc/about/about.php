<?php
/**
 * About setup
 *
 * @package aak
 */

if ( ! function_exists( 'aak_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function aak_about_setup() {
		$theme = wp_get_theme();
		$config = array(
		// Menu name under Appearance.
		'menu_name'               => esc_html__( 'aak Info', 'aak' ),
		// Page title.
		'page_name'               => esc_html__( 'aak Info', 'aak' ),
		/* translators: Main welcome title */
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %s! - Version ', 'aak' ), $theme['Name'] ),
		// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'aak' ), $theme['Name'] ),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__( 'Getting Started', 'aak' ),
				'recommended_actions' => esc_html__( 'Recommended Actions', 'aak' ),
				'useful_plugins'  => esc_html__( 'Useful Plugins', 'aak' ),
				'free_pro'  => esc_html__( 'Free Vs Pro', 'aak' ),
				),

			// Quick links.
			'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'UPGRADE TO PRO', 'aak' ),
                    'url'  => 'https://wpthemespace.com/product/aak/?add-to-cart=2950',
                    'button' => 'danger',

                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'aak' ),
                    'url'  => 'http://aak.wpcolors.net/aak-demo/',
                ),
               
                'documentation_url' => array(
                    'text'   => esc_html__( 'View Documentation', 'aak' ),
                    'url'    => 'https://wpthemespace.com/knowledge-base/',
                    'button' => 'primary',
                ),
            ),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'aak' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'aak' ),
					'button_text' => esc_html__( 'View Documentation', 'aak' ),
					'button_url'  => 'http://aak.wpcolors.net/aak-demo/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Options', 'aak' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'aak' ),
					'button_text' => esc_html__( 'Customize', 'aak' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Demo Content', 'aak' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'aak' ), esc_html__( 'One Click Demo Import', 'aak' ) ),
					'button_text' => esc_html__( 'View Pro', 'aak' ),
					'button_url'  => esc_url('https://wpthemespace.com/product/aak/'),
					'button_type' => 'primary',
					),
				'four' => array(
				    'title'       => esc_html__( 'Set Widgets', 'aak' ),
				    'icon'        => 'dashicons dashicons-tagcloud',
				    'description' => esc_html__( 'Set widgets in your sidebar, Offcanvas as well as footer.', 'aak' ),
				    'button_text' => esc_html__( 'Add Widgets', 'aak' ),
				    'button_url'  => admin_url().'/widgets.php',
				    'button_type' => 'link',
				    'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__( 'Theme Preview', 'aak' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'aak' ),
					'button_text' => esc_html__( 'View Demo', 'aak' ),
					'button_url'  => 'http://aak.wpcolors.net/aak-demo/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
                'six' => array(
                    'title'       => esc_html__( 'Contact Support', 'aak' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'aak' ),
                    'button_text' => esc_html__( 'Contact Support', 'aak' ),
                    'button_url'  => 'https://wpthemespace.com/support/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
				),

					'useful_plugins'        => array(
						'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'aak' ),
						'already_activated_message' => esc_html__( 'Already activated', 'aak' ),
						'version_label' => esc_html__( 'Version: ', 'aak' ),
						'install_label' => esc_html__( 'Install and Activate', 'aak' ),
						'activate_label' => esc_html__( 'Activate', 'aak' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'aak' ),
						'content'                   => array(
							array(
								'slug' => 'magical-addons-for-elementor',
								'icon' => 'svg',
							),
							array(
								'slug' => 'elementor',
								'icon' => 'svg',
							),
							array(
								'slug' => 'gallery-box',
								'icon' => 'svg',
							),
							array(
								'slug' => 'click-to-top',
								'icon' => 'svg',
							)
						),
					),
					// Required actions array.
					'recommended_actions'        => array(
						'install_label' => esc_html__( 'Install and Activate', 'aak' ),
						'activate_label' => esc_html__( 'Activate', 'aak' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'aak' ),
						'content'            => array(
							'gallery-box' => array(
								'title'       => __('Gallery Box', 'aak' ),
								'description' => __( 'These recommended plugin need to install and active for better user experience.', 'aak' ),
								'plugin_slug' => 'gallery-box',
								'id' => 'gallery-box'
							),
							'go-pro' => array(
								'title'       => '<a target="_blank" class="activate-now button button-primary" href="https://wpthemespace.com/product/aak/">'.__('UPGRADE TO PRO','aak').'</a>',
								'description' => __( 'You will get more frequent updates and quicker support with the Pro version.', 'aak' ),
								//'plugin_slug' => 'x-instafeed',
								'id' => 'go-pro',
								'button' => 'danger',

							),
						),
					),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => __('Aak','aak'),
				'pro_theme_name'      => __('Aak Pro','aak'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/aak/',
				/* translators: View link */
				'get_pro_theme_label' => sprintf( __( 'Get %s', 'aak' ), 'Aak Pro' ),
				'features'            => array(
					array(
						'title'       => esc_html__( 'Daring Design for Devoted Readers', 'aak' ),
						'description' => esc_html__( 'aak\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'aak' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Mobile-Ready For All Devices', 'aak' ),
						'description' => esc_html__( 'aak makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'aak' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Home slider', 'aak' ),
						'description' => esc_html__( 'Aak gives you extra post slider feature. You can create awesome home slider in this theme.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Widgetized Sidebars To Keep Attention', 'aak' ),
						'description' => esc_html__( 'Aak comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'aak' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Multiple Header Layout', 'aak' ),
						'description' => esc_html__( 'Aak gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'aak' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Banner Slider Options', 'aak' ),
						'description' => esc_html__( 'aak\'s PRO version comes with more Slider options to display and filter posts. For instance, you can have far more control on setting the source of the posts or how they are displayed, everything to push the content to the right people and promote it by the blink of an eye.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Home Page Design', 'aak' ),
						'description' => esc_html__( 'aak\'s PRO version has more controll available to enable you to place widgets on Footer or Below the Post at the end of your articles.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Multiple home layout', 'aak' ),
						'description' => esc_html__( 'aak PRO verison has multiple home layout so you can show your blog with awesome masonry grid layout with all devices supporte.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Customizer Options', 'aak' ),
						'description' => esc_html__( 'Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Pagination', 'aak' ),
						'description' => esc_html__( 'Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.','aak' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Color Scheme', 'aak' ),
						'description' => esc_html__( 'Match your unique style in an easy and smart way by using an intuitive interface that you can fine-tune it until it fully represents you and matches your particular blogging needs.','aak' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Popular fonts', 'aak' ),
						'description' => esc_html__( 'Aak supports 6 popular fonts. So you can select your text and heading fonts differently.','aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Premium Support and Assistance', 'aak' ),
						'description' => esc_html__( 'We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.','aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'No Credit Footer Link', 'aak' ),
						'description' => esc_html__( 'You can easily remove the Theme: aak by aak copyright from the footer area and make the theme yours from start to finish.', 'aak' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

			);

		aak_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'aak_about_setup' );


//Admin notice 

function aak_admin_notice__error() {
    if(get_option('aak_notice')){
        return;
    }
	$class = 'bb-notice notice notice-warning is-dismissible';
	$message = __( '<strong><span> Hi Buddy!! <span>You are using the free version.</span> <span>Good News For You Aak Pro Now More updated for you!!</span> <br> If you want a beautiful, smart, SEO friendly, more secure and unlimited options website then need to upgrade pro. UPGRADE FOR LIFETIME WITH NOMINAL PRICE.</span> <span> PRO License Now Lifetime For You. Buy One Time And Get Lifetime Update, High-Quality performance And support. So Why You late? Build Your Site With Pro Version.</span> ', 'aak' );
    $url1 = esc_url('https://wpthemespace.com/product/aak/');
    $url2 =esc_url('https://wpthemespace.com/product/aak/?add-to-cart=2950');
	$url3 =esc_url('https://www.youtube.com/watch?v=8ldj27EHS8s');

	printf( '<div class="%1$s" style="padding:10px 15px 20px;"><p>%2$s</p><a target="_blank" class="button button-primary" href="%3$s" style="margin-right:10px">'.esc_html('View details').'</a><a target="_blank" style="margin-right:10px" class="button button-primary" href="%4$s">'.esc_html('Upgrade Pro Now ').'</a><a class="bbhide" href="#">'.esc_html('Hide the notice').'</a></div>', esc_attr( $class ), wp_kses_post( $message ),$url1,$url2 ); 
}
add_action( 'admin_notices', 'aak_admin_notice__error' );

function aak_admin_notice_option(){
    if(isset($_GET['hnotice']) && $_GET['hnotice'] == 1 ){
        update_option( 'aak_notice', 1);
    }
}
add_action('init','aak_admin_notice_option');
