<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function masterwp_admin_css() {
	wp_enqueue_style( 'theme-default-font-admin', masterwp_slug_fonts_url(), array(), null );
	wp_enqueue_style( 'masterwp-admin', MASTERWP_THEME_URL . '/assets/css/admin.css', array(), MASTERWP_THEME_VERSION );	
	$documentation_link = apply_filters('masterwp_documentation_link', true);

    if ($documentation_link) {
		wp_enqueue_script( 'admin-theme-js', MASTERWP_THEME_URL . '/assets/js/admin.js', array( 'jquery' ), MASTERWP_THEME_VERSION, true );    
    }
}

// Hook the custom_admin_css function to the admin_enqueue_scripts action.
add_action('admin_enqueue_scripts', 'masterwp_admin_css', 11);

function masterwp_givewp_activation_redirect($location) {
    
	if( get_option( 'masterwp_demo_imported' ) != 1 ) {
		update_option( 'givewp_welcome_banner_dismiss', time() );
		// Check if the redirection is pointing to the GiveWP setup wizard
		if (strpos($location, 'page=give-onboarding-wizard') !== false) {
			return admin_url(); // Redirect to the dashboard instead
		}
	}
    return $location; // Allow other redirects
}
add_filter('wp_redirect', 'masterwp_givewp_activation_redirect', 10, 1);

add_action('admin_menu', 'masterwp_custom_appearance_submenu');

function masterwp_custom_appearance_submenu() {
	
    $documentation_link = apply_filters('masterwp_documentation_link', true);

    if (!$documentation_link) {
        return;
    }
	
    add_submenu_page(
        'themes.php', 
        __( 'Documentation', 'masterwp' ), 
        __( 'Documentation', 'masterwp' ), 
        'manage_options', 
        'custom_documentation_link', 
        '__return_null' 
    );
}