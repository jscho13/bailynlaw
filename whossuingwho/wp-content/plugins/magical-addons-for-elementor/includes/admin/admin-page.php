<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WeDevs_Settings_API_Test' ) ):
class WeDevs_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API();
        add_action( 'wsa_form_top_magical_tabs_welcome', [ $this, 'magical_welcome_tabs' ] );
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );

    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        //add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
        add_menu_page( esc_html__('Magical Addons','magical-addons-for-elementor'), esc_html__('Magical Addons','magical-addons-for-elementor'), 'delete_posts', 'magical-addons', array($this, 'plugin_page'), esc_url(MAGICAL_ADDON_URL.'assets/img/mg-icons.png'),10 );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'magical_tabs_welcome',
                'title' => __( 'Home', 'magical-addons-for-elementor' )
            ),
            array(
                'id'    => 'magical_addons',
                'title' => __( 'Addons', 'magical-addons-for-elementor' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'magical_tabs_welcome' => array(),

            'magical_addons' => array(
                array(
                    'name'  => 'mg_slider',
                    'label'  => __( 'MG Slider', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_postgrid',
                    'label'  => __( 'MG Posts Grid', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_postlist',
                    'label'  => __( 'MG Posts List', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_infobox',
                    'label'  => __( 'MG Info Box', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_card',
                    'label'  => __( 'MG Card', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_hover_card',
                    'label'  => __( 'MG Hover Card', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_pricing_table',
                    'label'  => __( 'MG Pricing Table', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_tabs',
                    'label'  => __( 'MG Tabs', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_countdown',
                    'label'  => __( 'MG Countdown', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_dual_heading',
                    'label'  => __( 'MG Dual Heading', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_text_effects',
                    'label'  => __( 'MG Text Effects', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_team_members',
                    'label'  => __( 'MG Team Members', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_timeline',
                    'label'  => __( 'MG Timeline', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_accordion',
                    'label'  => __( 'MG Accordion', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_aboutme',
                    'label'  => __( 'MG About Me', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
                array(
                    'name'  => 'mg_progressbar',
                    'label'  => __( 'MG Progressbar', 'magical-addons-for-elementor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'mgaddons_checkbox',
                ),
            ),
           
        );

        return $settings_fields;
    }
        // General tab
    function magical_welcome_tabs(){
        ob_start();
        include MAGICAL_ADDON_PATH . '/includes/admin/admin-pages/welcome-page.php';
        echo ob_get_clean();
    }

    function plugin_page() {
        echo '<div class="wrap magical-addons-page">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

new WeDevs_Settings_API_Test();