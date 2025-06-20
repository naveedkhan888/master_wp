<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once MASTERWP_THEME_DIR . '/inc/functions.php';
require_once MASTERWP_THEME_DIR . '/inc/compatibility/elementor/elementor.php';
require_once MASTERWP_THEME_DIR . '/inc/compatibility/elementor/modify-default-control.php';
require_once MASTERWP_THEME_DIR . '/inc/compatibility/elementskit-lite.php';
require_once MASTERWP_THEME_DIR . '/inc/breadcrumbs.php';
require_once MASTERWP_THEME_DIR . '/inc/customizer/customizer.php';


if(is_admin()) {
	// One click demo import
	require_once MASTERWP_THEME_DIR . '/inc/ocdi.php';
	// TGM Plugin Activation class
	require_once MASTERWP_THEME_DIR . '/inc/required-plugins.php';
	// Admin related functions
	require_once MASTERWP_THEME_DIR . '/inc/admin/admin.php';
	//Load theme updater functions
	function masterwp_theme_updater() {
		$theme_updater = apply_filters( 'masterwp_theme_updater_enabled', true );
		if($theme_updater) {
			require_once MASTERWP_THEME_DIR . '/inc/updater/theme-updater.php';
		}
	}
	add_action( 'after_setup_theme', 'masterwp_theme_updater' );
}
