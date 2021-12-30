<?php




class gBoxEWidget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Blank widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'gbox_shortcode';
    }

    /**
     * Get widget title.
     *
     * Retrieve Blank widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return __( 'Gallery Box', 'gbox' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Blank widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Blank widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Register Blank widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_controls();

    }

    /**
     * Register Blank widget content ontrols.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    function register_content_controls() {

        $this->start_controls_section(
            'mgpl_query',
            [
                'label' => esc_html__( 'Gallery Box', 'gbox' ),
            ]
        );


            $this->add_control(
                'gbox_id',
                [
                    'label' => __( 'Select Gallery Box Gallery', 'gbox' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'default' => '0',
                    'options' => gbox_gallery_list(),
                    
                ]
            );

        $this->end_controls_section();
       
        
    }



    /**
     * Render Blank widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
       
        $settings = $this->get_settings_for_display(); 
        $gbox_id = $this->get_settings('gbox_id');

        echo do_shortcode( '[gallerybox id="'.$gbox_id.'"]' );

   
    }






}

