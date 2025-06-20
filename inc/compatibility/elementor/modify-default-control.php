<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'at_add_heading_animation_style_control' ) ) {
	function at_add_heading_animation_style_control( $element, $args ) {
			$element->add_control(
					'at_animation_heading_style',
					[
						'label' => __( 'Animation', 'lenity' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'' => __( 'None', 'lenity' ),
							'style-1' => __( 'Style 1', 'lenity' ),
							'style-2' => __( 'Style 2', 'lenity' ),
							'style-3' => __( 'Style 3', 'lenity' ),
						],
						'prefix_class' => 'at-heading-animation at-animation-heading-',
						'default' => 'none',
					]
				);
	}
	
add_action( 'elementor/element/heading/section_title/before_section_end', 'at_add_heading_animation_style_control', 10, 2 );
add_action( 'elementor/element/elementskit-heading/ekit_heading_section_title/before_section_end', 'at_add_heading_animation_style_control', 10, 2 );
	
}

// Add animation control to elementor image widget
add_action( 'elementor/element/image/section_image/before_section_end', function( $element, $args ) {

	$element->add_control(
		'at_animation_image_style',
		[
			'label' => __( 'Animation', 'lenity' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'' => __( 'None', 'lenity' ),
				'style-1' => __( 'Reveal Style 1', 'lenity' ),
			],
			'prefix_class' => 'at-image-animation at-animation-image-',
			'default' => 'none',
		]
	);
	
	$element->add_control(
		'at_animation_hover_effect',
		[
			'label' => __( 'Hover Effect', 'lenity' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'' => __( 'None', 'lenity' ),
				'shiny-glass-effect' => __( 'Shiny Glass', 'lenity' ),
			],
			'prefix_class' => 'at-',
			'default' => 'none',
		]
	);
	
}, 10, 2 );