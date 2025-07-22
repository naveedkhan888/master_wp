<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'xpertpoint_generate_defaults' ) ) {
	function xpertpoint_generate_defaults() {
		global $MASTERWP_STORAGE;

		return apply_filters( 'xpertpoint_customizer_defaults', $MASTERWP_STORAGE );
	}
}


/**
 * Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class xpertpoint_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = xpertpoint_generate_defaults();


		// Register sections
		add_action( 'customize_register', array( $this, 'xpertpoint_add_customizer_sections' ) );
		
		// Register general control
		add_action( 'customize_register', array( $this, 'xpertpoint_register_general_options_controls' ) );
		
		// Register project control
		add_action( 'customize_register', array( $this, 'xpertpoint_register_programmes_options_controls' ) );

		// Register blog control
		add_action( 'customize_register', array( $this, 'xpertpoint_register_blog_options_controls' ) );
		
		// Register footer control
		add_action( 'customize_register', array( $this, 'xpertpoint_register_footer_options_controls' ) );
		
	}


	/**
	 * Register the Customizer sections
	 */
	public function xpertpoint_add_customizer_sections( $wp_customize ) {
		
		// Add section general options
		$wp_customize->add_section( 'general_options' , array(
			'title'      => __( 'General Options', 'masterwp' ),
		) );
		
		// Add section programmes options
		$wp_customize->add_section( 'programmes_options' , array(
			'title'      => __( 'Programmes Options', 'masterwp' ),
		) );
		
		// Add section blog options
		$wp_customize->add_section( 'blog_options' , array(
			'title'      => __( 'Blog Options', 'masterwp' ),
		) );
		
		// Add section footer options
		$wp_customize->add_section( 'footer_options' , array(
			'title'      => __( 'Footer Options', 'masterwp' ),
		) );
		
	}
	
	/**
	 * Register general option controls
	 */

	public function xpertpoint_register_general_options_controls( $wp_customize ) {  
		
		$section	=	'general_options';
		
		// Preloader
		$wp_customize->add_setting( 'show_preloader',
			array(
				'default' => $this->defaults['show_preloader'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'show_preloader',
			array(
				'label' => __( 'Preloader', 'masterwp' ),
				'description' => esc_html__( 'Display preloader while the page is loading.', 'masterwp' ),
				'section' => $section
			)
		) );
		
		// Magic Cursor
		$wp_customize->add_setting( 'magic_cursor',
			array(
				'default' => $this->defaults['magic_cursor'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'magic_cursor',
			array(
				'label' => __( 'Magic Cursor', 'masterwp' ),
				'description' => esc_html__( 'Show Magic Cursor.', 'masterwp' ),
				'section' => $section
			)
		) );
		
		
		// Smooth scrolling
		$wp_customize->add_setting( 'smooth_scrolling',
			array(
				'default' => $this->defaults['smooth_scrolling'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'smooth_scrolling',
			array(
				'label' => __( 'Smooth Scrolling', 'masterwp' ),
				'description' => esc_html__( 'Smooth Scrolling Disable/Enable', 'masterwp' ),
				'section' => $section
			)
		) );
		
		// heading icon 
		$wp_customize->add_setting( 'show_small_heading_icon',
			array(
				'default' => $this->defaults['show_small_heading_icon'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'show_small_heading_icon',
			array(
				'label' => __( 'Display Small Icon', 'masterwp' ),
				'description' => esc_html__( 'Display small icon before small heading.', 'masterwp' ),
				'section' => $section
			)
		) );
		
		// heading icon
		$wp_customize->add_setting( 'small_heading_icon',
			array(
				'default' => $this->defaults['small_heading_icon'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'small_heading_icon',
			array(
				'label' => __( 'Small heading icon', 'masterwp' ),
				'description' => esc_html__( 'If you want to change the current icon, select it here.', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );
		
		// Preloader icon
		$wp_customize->add_setting( 'preloader_icon',
			array(
				'default' => $this->defaults['preloader_icon'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'preloader_icon',
			array(
				'label' => __( 'Preloader icon', 'masterwp' ),
				'description' => esc_html__( 'If you want to change the current loading icon, select it here.', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );
		
		// Header background image
		$wp_customize->add_setting( 'header_background_image',
			array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'header_background_image',
			array(
				'label' => __( 'Header Background Image', 'masterwp' ),
				'description' => esc_html__( 'Header background image is intended for pages that are not created using Elementor.', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );

	}

	
	/**
	 * Register programmes option controls
	 */
	
	public function xpertpoint_register_programmes_options_controls( $wp_customize ) { 
			
		$section	=	'programmes_options';

		// Programmes page title 
		$wp_customize->add_setting( 'programmes_page_title', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'programmes_page_title', array(
			'type' => 'text',
			'section' => $section,
			'label'       => esc_html__( 'Programmes Page Archive Title', 'masterwp' ),
		) );
		
		// Header background image
		$wp_customize->add_setting( 'programmes_page_header_background_image',
			array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'programmes_page_header_background_image',
			array(
				'label' => __( 'Header Background Image', 'masterwp' ),
				'description' => esc_html__( 'Header background image for programmes archive and single pages that are not created using Elementor.', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );
		
		// Archive page layout
		$wp_customize->add_setting( 'programmes_archive_page_layout', array(
		  'default' => $this->defaults['programmes_archive_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'programmes_archive_page_layout', array(
			  'label'          => __( 'Programmes Archive Page Layout', 'masterwp' ),
			  'section' => $section,
			  'settings' => 'programmes_archive_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'masterwp' ),
				'with-sidebar'  => __( 'With Sidebar', 'masterwp' )
			  ),
		) );
		
		// Archive page single page layout
		$wp_customize->add_setting( 'programmes_single_page_layout', array(
		  'default' => $this->defaults['programmes_single_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'programmes_single_page_layout', array(
			  'label'          => __( 'Programmes Single Layout', 'masterwp' ),
			  'description' => esc_html__( 'Works with the Default Template only.', 'masterwp' ),
			  'section' => $section,
			  'settings' => 'programmes_single_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'masterwp' ),
				'with-sidebar'  => __( 'With Sidebar', 'masterwp' )
			  ),
		) );
		
	}
	
	
	/**
	 * Register blog option controls
	 */
	
	public function xpertpoint_register_blog_options_controls( $wp_customize ) { 
			
		$section	=	'blog_options';

		// Blog page title 
		$wp_customize->add_setting( 'blog_page_title', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'blog_page_title', array(
			'type' => 'text',
			'section' => $section,
			'label'       => esc_html__( 'Blog Page Title', 'masterwp' ),
		) );
		
		//Header Background Image
		$wp_customize->add_setting( 'blog_page_header_background_image',
			array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'blog_page_header_background_image',
			array(
				'label' => __( 'Header Background Image', 'masterwp' ),
				'description' => esc_html__( 'Header background image for blog archive and single page.', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );
		
		// Archive page layout
		$wp_customize->add_setting( 'archive_page_layout', array(
		  'default' => $this->defaults['archive_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'archive_page_layout', array(
			  'label'          => __( 'Archive Page Layout', 'masterwp' ),
			  'section' => $section,
			  'settings' => 'archive_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'masterwp' ),
				'with-sidebar'  => __( 'With Sidebar', 'masterwp' )
			  ),
		) );
		
		// Archive page single page layout
		$wp_customize->add_setting( 'blog_single_page_layout', array(
		  'default' => $this->defaults['blog_single_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'blog_single_page_layout', array(
			  'label'          => __( 'Blog Single Layout', 'masterwp' ),
			  'description' => esc_html__( 'Works with the Default Template only.', 'masterwp' ),
			  'section' => $section,
			  'settings' => 'blog_single_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'masterwp' ),
				'with-sidebar'  => __( 'With Sidebar', 'masterwp' )
			  ),
		) );
		
		// Social Sharing
		$wp_customize->add_setting( 'social_sharing',
			array(
				'default' => $this->defaults['social_sharing'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Pill_Checkbox_Custom_Control( $wp_customize, 'social_sharing',
			array(
				'label' => __( 'Social Sharing', 'masterwp' ),
				'description' => esc_html__( 'Choose the social network you want to display in the social share box.', 'masterwp' ),
				'section' => $section,
				'input_attrs' => array(
					'sortable' => true,
					'fullwidth' => true,
				),
				'choices' => array(
					'facebook' => esc_attr__( 'Facebook', 'masterwp' ),
					'twitter' => esc_attr__( 'Twitter', 'masterwp' ),
					'whatsapp' => esc_attr__( 'Whatsapp', 'masterwp' ),
					'linkedin' => esc_attr__( 'LinkedIn', 'masterwp' ),
					'reddit' => esc_attr__( 'Reddit', 'masterwp' ),
					'tumblr' => esc_attr__( 'Tumblr', 'masterwp' ),
					'pinterest' => esc_attr__( 'Pinterest', 'masterwp' ),
					'vk' => esc_attr__( 'vk', 'masterwp' ),
					'email' => esc_attr__( 'Email', 'masterwp' ),
					'telegram' => esc_attr__( 'Telegram', 'masterwp' ),
				)
			)
		) );

	}
	
	/**
	 * Register footer controls
	 */
	
	public function xpertpoint_register_footer_options_controls( $wp_customize ) { 
		
		$section	=	'footer_options';
		
		//Footer logo
		$wp_customize->add_setting( 'footer_logo',
			array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_logo',
			array(
				'label' => __( 'Footer Logo', 'masterwp' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'masterwp' ),
					'change' => __( 'Change File', 'masterwp' ),
					'default' => __( 'Default', 'masterwp' ),
					'remove' => __( 'Remove', 'masterwp' ),
					'placeholder' => __( 'No file selected', 'masterwp' ),
					'frame_title' => __( 'Select File', 'masterwp' ),
					'frame_button' => __( 'Choose File', 'masterwp' ),
				)
			)
		) );
		
		// Copyright text
		$wp_customize->add_setting( 'footer_copyright_text',
			array(
				'default' => $this->defaults['footer_copyright_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control( 'footer_copyright_text',
			array(
				'label' => __( 'Copyright Text', 'masterwp' ),
				'section' => $section,
				'type' => 'textarea',
			)
		);
		
		// Social media URLs
		$wp_customize->add_setting( 'social_urls',
			array(
				'default' => $this->defaults['social_urls'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'social_urls',
			array(
				'label' => __( 'Social URLs', 'masterwp' ),
				'description' => esc_html__( 'Enter the social profile URLs.', 'masterwp' ),
				'section' => $section,
				'button_labels' => array(
					'add' => __( 'Add Row', 'masterwp' ),
				)
			)
		) );
		
	}
	
}

/**
 * Load all our Customizer Custom Controls
 */
require_once MASTERWP_THEME_DIR . '/inc/customizer/custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$xpertpoint_settings = new xpertpoint_initialise_customizer_settings();
