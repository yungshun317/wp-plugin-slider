<?php

if ( ! class_exists('Slider_Shortcode') ) {
    class Slider_Shortcode {
        public function __construct() {
            add_shortcode( 'slider', array( $this, 'add_shortcode' ));
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ) {

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));

            if ( ! empty( $id ) ) {
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            ob_start();
            require( SLIDER_PATH . 'views/slider_shortcode.php' );
            wp_enqueue_script( 'slider-main-jq' );
            // wp_enqueue_script( 'slider-options-js' );
            wp_enqueue_style( 'slider-main-css' );
            wp_enqueue_style( 'slider-style-css' );
            slider_options();
            return ob_get_clean();
        }
    }
}