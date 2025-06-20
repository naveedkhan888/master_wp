<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'awaiken_generate_defaults' ) ) {
	function awaiken_generate_defaults() {
		global $LENITY_STORAGE;

		return apply_filters( 'awaiken_customizer_defaults', $LENITY_STORAGE );
	}
}


/**
 * Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class awaiken_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = awaiken_generate_defaults();


		// Register sections
		add_action( 'customize_register', array( $this, 'awaiken_add_customizer_sections' ) );
		
		// Register general control
		add_action( 'customize_register', array( $this, 'awaiken_register_general_options_controls' ) );
		
		// Register project control
		add_action( 'customize_register', array( $this, 'awaiken_register_programmes_options_controls' ) );

		// Register blog control
		add_action( 'customize_register', array( $this, 'awaiken_register_blog_options_controls' ) );
		
		// Register footer control
		add_action( 'customize_register', array( $this, 'awaiken_register_footer_options_controls' ) );
		
	}


	/**
	 * Register the Customizer sections
	 */
	public function awaiken_add_customizer_sections( $wp_customize ) {
		
		// Add section general options
		$wp_customize->add_section( 'general_options' , array(
			'title'      => __( 'General Options', 'lenity' ),
		) );
		
		// Add section programmes options
		$wp_customize->add_section( 'programmes_options' , array(
			'title'      => __( 'Programmes Options', 'lenity' ),
		) );
		
		// Add section blog options
		$wp_customize->add_section( 'blog_options' , array(
			'title'      => __( 'Blog Options', 'lenity' ),
		) );
		
		// Add section footer options
		$wp_customize->add_section( 'footer_options' , array(
			'title'      => __( 'Footer Options', 'lenity' ),
		) );
		
	}
	
	/**
	 * Register general option controls
	 */

	public function awaiken_register_general_options_controls( $wp_customize ) {  
		
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
				'label' => __( 'Preloader', 'lenity' ),
				'description' => esc_html__( 'Display preloader while the page is loading.', 'lenity' ),
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
				'label' => __( 'Magic Cursor', 'lenity' ),
				'description' => esc_html__( 'Show Magic Cursor.', 'lenity' ),
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
				'label' => __( 'Smooth Scrolling', 'lenity' ),
				'description' => esc_html__( 'Smooth Scrolling Disable/Enable', 'lenity' ),
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
				'label' => __( 'Display Small Icon', 'lenity' ),
				'description' => esc_html__( 'Display small icon before small heading.', 'lenity' ),
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
				'label' => __( 'Small heading icon', 'lenity' ),
				'description' => esc_html__( 'If you want to change the current icon, select it here.', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
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
				'label' => __( 'Preloader icon', 'lenity' ),
				'description' => esc_html__( 'If you want to change the current loading icon, select it here.', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
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
				'label' => __( 'Header Background Image', 'lenity' ),
				'description' => esc_html__( 'Header background image is intended for pages that are not created using Elementor.', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
				)
			)
		) );

	}

	
	/**
	 * Register programmes option controls
	 */
	
	public function awaiken_register_programmes_options_controls( $wp_customize ) { 
			
		$section	=	'programmes_options';

		// Programmes page title 
		$wp_customize->add_setting( 'programmes_page_title', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'programmes_page_title', array(
			'type' => 'text',
			'section' => $section,
			'label'       => esc_html__( 'Programmes Page Archive Title', 'lenity' ),
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
				'label' => __( 'Header Background Image', 'lenity' ),
				'description' => esc_html__( 'Header background image for programmes archive and single pages that are not created using Elementor.', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
				)
			)
		) );
		
		// Archive page layout
		$wp_customize->add_setting( 'programmes_archive_page_layout', array(
		  'default' => $this->defaults['programmes_archive_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'programmes_archive_page_layout', array(
			  'label'          => __( 'Programmes Archive Page Layout', 'lenity' ),
			  'section' => $section,
			  'settings' => 'programmes_archive_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'lenity' ),
				'with-sidebar'  => __( 'With Sidebar', 'lenity' )
			  ),
		) );
		
		// Archive page single page layout
		$wp_customize->add_setting( 'programmes_single_page_layout', array(
		  'default' => $this->defaults['programmes_single_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'programmes_single_page_layout', array(
			  'label'          => __( 'Programmes Single Layout', 'lenity' ),
			  'description' => esc_html__( 'Works with the Default Template only.', 'lenity' ),
			  'section' => $section,
			  'settings' => 'programmes_single_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'lenity' ),
				'with-sidebar'  => __( 'With Sidebar', 'lenity' )
			  ),
		) );
		
	}
	
	
	/**
	 * Register blog option controls
	 */
	
	public function awaiken_register_blog_options_controls( $wp_customize ) { 
			
		$section	=	'blog_options';

		// Blog page title 
		$wp_customize->add_setting( 'blog_page_title', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'blog_page_title', array(
			'type' => 'text',
			'section' => $section,
			'label'       => esc_html__( 'Blog Page Title', 'lenity' ),
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
				'label' => __( 'Header Background Image', 'lenity' ),
				'description' => esc_html__( 'Header background image for blog archive and single page.', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
				)
			)
		) );
		
		// Archive page layout
		$wp_customize->add_setting( 'archive_page_layout', array(
		  'default' => $this->defaults['archive_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'archive_page_layout', array(
			  'label'          => __( 'Archive Page Layout', 'lenity' ),
			  'section' => $section,
			  'settings' => 'archive_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'lenity' ),
				'with-sidebar'  => __( 'With Sidebar', 'lenity' )
			  ),
		) );
		
		// Archive page single page layout
		$wp_customize->add_setting( 'blog_single_page_layout', array(
		  'default' => $this->defaults['blog_single_page_layout'],
		   'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( 'blog_single_page_layout', array(
			  'label'          => __( 'Blog Single Layout', 'lenity' ),
			  'description' => esc_html__( 'Works with the Default Template only.', 'lenity' ),
			  'section' => $section,
			  'settings' => 'blog_single_page_layout',
			  'type' => 'radio',
			  'choices' => array(
				'full-width'   => __( 'Full Width', 'lenity' ),
				'with-sidebar'  => __( 'With Sidebar', 'lenity' )
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
				'label' => __( 'Social Sharing', 'lenity' ),
				'description' => esc_html__( 'Choose the social network you want to display in the social share box.', 'lenity' ),
				'section' => $section,
				'input_attrs' => array(
					'sortable' => true,
					'fullwidth' => true,
				),
				'choices' => array(
					'facebook' => esc_attr__( 'Facebook', 'lenity' ),
					'twitter' => esc_attr__( 'Twitter', 'lenity' ),
					'whatsapp' => esc_attr__( 'Whatsapp', 'lenity' ),
					'linkedin' => esc_attr__( 'LinkedIn', 'lenity' ),
					'reddit' => esc_attr__( 'Reddit', 'lenity' ),
					'tumblr' => esc_attr__( 'Tumblr', 'lenity' ),
					'pinterest' => esc_attr__( 'Pinterest', 'lenity' ),
					'vk' => esc_attr__( 'vk', 'lenity' ),
					'email' => esc_attr__( 'Email', 'lenity' ),
					'telegram' => esc_attr__( 'Telegram', 'lenity' ),
				)
			)
		) );

	}
	
	/**
	 * Register footer controls
	 */
	
	public function awaiken_register_footer_options_controls( $wp_customize ) { 
		
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
				'label' => __( 'Footer Logo', 'lenity' ),
				'section' => $section,
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'lenity' ),
					'change' => __( 'Change File', 'lenity' ),
					'default' => __( 'Default', 'lenity' ),
					'remove' => __( 'Remove', 'lenity' ),
					'placeholder' => __( 'No file selected', 'lenity' ),
					'frame_title' => __( 'Select File', 'lenity' ),
					'frame_button' => __( 'Choose File', 'lenity' ),
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
				'label' => __( 'Copyright Text', 'lenity' ),
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
				'label' => __( 'Social URLs', 'lenity' ),
				'description' => esc_html__( 'Enter the social profile URLs.', 'lenity' ),
				'section' => $section,
				'button_labels' => array(
					'add' => __( 'Add Row', 'lenity' ),
				)
			)
		) );
		
	}
	
}

/**
 * Load all our Customizer Custom Controls
 */
require_once LENITY_THEME_DIR . '/inc/customizer/custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$awaiken_settings = new awaiken_initialise_customizer_settings();
