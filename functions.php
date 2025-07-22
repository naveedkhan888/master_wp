<?php
/**
 * Theme functions and definitions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'MASTERWP_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'MASTERWP_THEME_DIR', get_template_directory() );
define( 'MASTERWP_THEME_URL', get_template_directory_uri() );
define( 'XPERTPOINT_ITEM_ID', 8576 );
define( 'XPERTPOINT_ITEM_NAME', 'Masterwp' );
define( 'XPERTPOINT_THEME_SLUG', 'masterwp' );
define( 'XPERTPOINT_MP', 'TF' ); 

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP-CLI
//-------------------------------------------------------------------------
$GLOBALS['MASTERWP_STORAGE'] = array(
		'social_sharing' => 'facebook,whatsapp,linkedin',
		'social_urls' => 'https://www.instagram.com/ ,https://www.facebook.com/ ,https://www.youtube.com/',
		'show_preloader' => 0,
		'magic_cursor' => 1,
		'show_small_heading_icon' => 1,
		'small_heading_icon' => '',
		'footer_copyright_text' => '',
		'smooth_scrolling' => 0,
		'archive_page_layout' => 'full-width',
		'blog_single_page_layout' => 'full-width',
		'preloader_icon' => '',
		'programmes_page_title' => '',
		'programmes_archive_page_layout' => 'full-width',
		'programmes_single_page_layout' => 'full-width',
		'programmes_page_header_background_image' => '',
		'header_background_image' => '',
		'blog_page_header_background_image' => '',
		'404_image' => MASTERWP_THEME_URL.'/assets/images/404-error-img.png',
		'read_more_icon' => MASTERWP_THEME_DIR.'/assets/images/arrow-white.svg',
);

if ( ! function_exists( 'masterwp_slug_fonts_url' ) ) {
	function masterwp_slug_fonts_url() {
		$fonts_url = ''; 
		  
		/* Translators: If there are characters in your language that are not
		* supported by Inter, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$font = _x( 'on', 'Inter font: on or off', 'masterwp' );
		
		/* Translators: If there are characters in your language that are not
		* supported by Onest, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$font2 = _x( 'on', 'Onest font: on or off', 'masterwp' );
		 
		if ( 'off' !== $font || 'off' !== $font2 ) {
			
			$font_families = array();
			 
			if ( 'off' !== $font ) {
				$font_families[] = 'Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900';
			}
			
			if ( 'off' !== $font2 ) {
				$font_families[] = 'Onest:wght@100..900';
			}
			
			$query_args = array(
				'family'	=> implode( '&family=', $font_families ),
				'display' 	=> 'swap' ,
			);
		
			$query_args = str_replace(array('%26','%3D'), array('&','='), $query_args);
			
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
			
		}
		 
		return esc_url_raw( $fonts_url );
	}
}

if ( ! function_exists( 'masterwp_theme_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function masterwp_theme_setup() {
	
		register_nav_menus( 
			array( 
					'header' => esc_html__( 'Header', 'masterwp' ) ,
					'footer' => esc_html__( 'Footer', 'masterwp' ) 
				 )		
		);

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'editor-styles' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 350,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		
		/*
		 * Gutenberg wide images.
		 */
		add_theme_support( 'align-wide' );
		
		/**
        * Load textdomain.
        */
        load_theme_textdomain( 'masterwp', MASTERWP_THEME_DIR . '/languages' );

		
		
		if ( is_admin() ) { 
			add_editor_style( array( masterwp_slug_fonts_url(), 'assets/css/css-variable.css', 'assets/css/all.min.css', 'style-editor.css' ) );
		}

	}

}
add_action( 'after_setup_theme', 'masterwp_theme_setup' );

/**
 * Enqueue styles
 */
if ( ! function_exists( 'masterwp_theme_load_styles' ) ) {
	function masterwp_theme_load_styles() {
		
		if( get_option( 'masterwp_demo_imported' ) != 1 ) {
			wp_enqueue_style( 'masterwp-font-manrope', masterwp_slug_fonts_url(), array(), null );	
		}
		
		wp_enqueue_style( 'masterwp-css-variable', MASTERWP_THEME_URL . '/assets/css/css-variable.css', array(), MASTERWP_THEME_VERSION );
		wp_enqueue_style( 'fontawesome-6.4.0', MASTERWP_THEME_URL . '/assets/css/all.min.css', array(), MASTERWP_THEME_VERSION );
		wp_enqueue_style( 'bootstrap-5.3.2', MASTERWP_THEME_URL . '/assets/css/bootstrap.min.css', array(), MASTERWP_THEME_VERSION );
		wp_enqueue_style( 'masterwp-style', MASTERWP_THEME_URL . '/style.css', array('bootstrap-5.3.2','fontawesome-6.4.0'), MASTERWP_THEME_VERSION );

	}
}
add_action( 'wp_enqueue_scripts', 'masterwp_theme_load_styles', 998 );

/**
 * Enqueue scripts
 */
if ( ! function_exists( 'masterwp_theme_load_scripts' ) ) {
	function masterwp_theme_load_scripts() {
		global $MASTERWP_STORAGE;
	
		if( get_theme_mod( 'smooth_scrolling', $MASTERWP_STORAGE['smooth_scrolling'] ) ) { 
			wp_enqueue_script( 'SmoothScroll', MASTERWP_THEME_URL . '/assets/js/SmoothScroll.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		}
		
		wp_enqueue_script( 'gsap', MASTERWP_THEME_URL . '/assets/js/gsap.min.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		if( get_theme_mod( 'magic_cursor', $MASTERWP_STORAGE['magic_cursor'] ) ) { 
		wp_enqueue_script( 'magiccursor', MASTERWP_THEME_URL . '/assets/js/magiccursor.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		}
		
		wp_enqueue_script( 'SplitText', MASTERWP_THEME_URL . '/assets/js/SplitText.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		wp_enqueue_script( 'ScrollTrigger', MASTERWP_THEME_URL . '/assets/js/ScrollTrigger.min.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		wp_enqueue_script( 'theme-js', MASTERWP_THEME_URL . '/assets/js/function.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );
		
		// js for comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'masterwp_theme_load_scripts' );


/**
 * Register widget area.
 */
if ( ! function_exists( 'masterwp_widgets_init' ) ) {
	function masterwp_widgets_init() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'masterwp' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'masterwp' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Programmes Sidebar', 'masterwp' ),
			'id'            => 'programmes-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your programmes sidebar.', 'masterwp' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
	}
}
add_action( 'widgets_init', 'masterwp_widgets_init' );

/**
*	Include required file
*/
require_once MASTERWP_THEME_DIR . '/inc/init.php';