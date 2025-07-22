<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'XPERTPOINT_Theme_Updater_Admin' ) ) {
	include dirname( __FILE__ ) . '/theme-updater-admin.php';
}

// Loads the updater classes
$updater = new XPERTPOINT_Theme_Updater_Admin(
	// Config settings
	array(
		'remote_api_url' => 'https://xpertpoin8.com/', // Site where EDD is hosted
		'tf_pc_val_api_url' => 'https://xpertpoin8.com/wp-json/themeforest/v1/validate-purchase', // Site where EDD is hosted
		'item_name'      => XPERTPOINT_ITEM_NAME, // Name of theme
		'theme_slug'     => XPERTPOINT_THEME_SLUG, // Theme slug
		'version'        => wp_get_theme( get_template() )->get( 'Version' ), // The current version of this theme
		'author'         => 'Xpertpoint', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
		'item_id'        => XPERTPOINT_ITEM_ID,
	),
	// Strings
	array(
		'activate-license-info'     => __( 'Please activate the theme license key to proceed.', 'masterwp' ),
		'maybe-later-btn'    	 => __( 'Maybe Later', 'masterwp' ),
		'dismiss-notice-btn'    	 => __( 'Dismiss this notice', 'masterwp' ),
		'theme-license'             => __( 'Theme License', 'masterwp' ),
		'enter-key-tf'              => __( 'Enter your Item Purchase Code. <a href="%s" rel="noopener noreferrer" target="_blank">Refer to the article for instructions on where to find it</a>.', 'masterwp' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'masterwp' ),
		'license-key'               => __( 'License Key', 'masterwp' ),
		'license-buyer-email'       => __( 'Email', 'masterwp' ),
		'license-action'            => __( 'License Action', 'masterwp' ),
		'deactivate-license'        => __( 'Deactivate License', 'masterwp' ),
		'activate-license'          => __( 'Activate License', 'masterwp' ),
		'status-unknown'            => __( 'License status is unknown.', 'masterwp' ),
		'renew'                     => __( 'Renew?', 'masterwp' ),
		'unlimited'                 => __( 'unlimited', 'masterwp' ),
		'license-key-is-active'     => __( 'License key is active.', 'masterwp' ),
		/* translators: the license expiration date */
		'expires%s'                 => __( 'Expires %s.', 'masterwp' ),
		'expires-never'             => __( 'Lifetime License.', 'masterwp' ),
		/* translators: 1. the number of sites activated 2. the total number of activations allowed. */
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'masterwp' ),
		'activation-limit'          => __( 'Your license key has reached its activation limit.', 'masterwp' ),
		/* translators: the license expiration date */
		'license-key-expired-%s'    => __( 'License key expired %s.', 'masterwp' ),
		'license-key-expired'       => __( 'License key has expired.', 'masterwp' ),
		/* translators: the license expiration date */
		'license-expired-on'        => __( 'Your license key expired on %s.', 'masterwp' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'masterwp' ),
		'license-is-inactive'       => __( 'License is inactive.', 'masterwp' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'masterwp' ),
		'license-key-invalid'       => __( 'Invalid license.', 'masterwp' ),
		'site-is-inactive'          => __( 'Your license is not active for this URL.', 'masterwp' ),
		/* translators: the theme name */
		'item-mismatch'             => __( 'This appears to be an invalid license key for %s.', 'masterwp' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'masterwp' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'masterwp' ),
		'error-generic'             => __( 'An error occurred, please try again.', 'masterwp' ),
		'pending-active'            => __( 'Click the Activate License button to activate the license.', 'masterwp' ),
	)
);
