<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Masterwp for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
 
define( 'AWAIKEN_PLUGINS_API_URI', 'https://awaikenthemes.com/wp-json/update-assets/v1/plugins/' );
define( 'AWAIKEN_PLUGINS_URI', 'https://cdn.awaikenthemes.com/plugins/' );
function masterwp_json_error_license_invalid() {
    echo '<div class="notice notice-error is-dismissible">
        <p>' . esc_html( 'Invalid license', 'masterwp' ) . '</p>
    </div>';
}

function masterwp_json_error_notice() {
    echo '<div class="notice notice-error is-dismissible">
        <p>' . esc_html( 'Unable to connect to Awaiken server. Failed to retrieve valid JSON data.', 'masterwp' ) . '</p>
    </div>';
}

function masterwp_http_error_notice() {
    echo '<div class="notice notice-error is-dismissible">
		<p>' . esc_html( 'Unable to connect to Awaiken server. Failed to fetch data from the server.', 'masterwp' ) . '</p>
    </div>';
}

function masterwp_get_plugin_versions() {
	
	$transient_key = AWAIKEN_THEME_SLUG.'_plugin_versions_api_' . md5( AWAIKEN_PLUGINS_API_URI );
	$cached_response = get_transient( $transient_key );
	
	if ( $cached_response !== false ) {
        return $cached_response;
    }

	// Get the JSON data from the specified URL using WordPress HTTP API
	$license = trim( get_option( AWAIKEN_THEME_SLUG . '_license_key' ) );
	$status  = get_option( AWAIKEN_THEME_SLUG . '_license_key_status', false );
	
	if ( empty($license) ) return null;
	if ( 'valid' !== $status ) return null;
	
	$api_params = array(
				'at_action'  => 'update_plugin',
				'url'        => home_url(),
				'license'    => $license,
				'item_id'    => AWAIKEN_ITEM_ID,
			);
	
	$verify_ssl = (bool) apply_filters( 'awaiken_sl_api_request_verify_ssl', true );
	$response   = wp_remote_post(
					AWAIKEN_PLUGINS_API_URI,
					array(
						'timeout'   => 15,
						'sslverify' => $verify_ssl,
						'body'      => $api_params,
					)
				);
				
	// Check for a successful response
    if ( !is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
        $json_contents = wp_remote_retrieve_body( $response );
		

        // Decode the JSON data
        $data = json_decode($json_contents, true);

        // Check if JSON decoding was successful and data structure is as expected
        if ( $data !== null && isset( $data['data'] ) ) {
            // Access plugin versions and store them in separate variables
            $elementskitVersion = $data['data']['elementskit'];
			
			$return = [
                'elementskit' => $elementskitVersion,
            ];
			
			set_transient( $transient_key, $return, 172800  );

            return $return;

        }
		else if ( $data !== null && isset( $data['license'] ) && $data['license'] === 'invalid' ) { 
			// Show an admin notice if license invalid
            add_action('admin_notices', 'masterwp_json_error_license_invalid');
            return null;
		} 
		else {
            // Show an admin notice if JSON structure is unexpected
            add_action('admin_notices', 'masterwp_json_error_notice');
            return null;
        }
    } else {
        // Show an admin notice if the HTTP request fails
        add_action('admin_notices', 'masterwp_http_error_notice');
        return null;
    }
}
require_once MASTERWP_THEME_DIR . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'masterwp_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function masterwp_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	 
	$plugin_versions = masterwp_get_plugin_versions();
	
	if ( $plugin_versions !== null ) {
		$elementskit_version 		= $plugin_versions['elementskit'];
		$elementskit_source_url 	= AWAIKEN_PLUGINS_URI . 'elementskit/elementskit-' . $elementskit_version . '.zip';
	}
	else{
		$elementskit_source_url 	= get_template_directory() . '/assets/plugins/elementskit-3.8.5.zip';
		$elementskit_version 		= '3.8.5';
	}

	$plugins = array(
		array(
			'name' 				=> esc_html__('Elementor', 'masterwp'),
			'slug' 				=> 'elementor',
			'required' 			=> true,
			'external_url' 		=> 'https://wordpress.org/plugins/elementor/',
		),
		array(
			'name' 				=> esc_html__('ElementsKit Lite', 'masterwp'),
			'slug' 				=> 'elementskit-lite',
			'required' 			=> true,
			'external_url' 		=> 'https://wordpress.org/plugins/elementskit-lite/',
		),
		array(
			'name' 				=> esc_html__('ElementsKit Pro', 'masterwp'),
			'slug' 				=> 'elementskit',
			'source' 			=> $elementskit_source_url,
			'required' 			=> true,
			'version' 			=> $elementskit_version,
			'external_url' 		=> 'https://wpmet.com/plugin/elementskit/',
			),
		array(
			'name'              => esc_html__('Masterwp Theme Addons', 'masterwp'), 
			'slug'              => 'masterwp-theme-addons',
			'source'            => get_template_directory() . '/assets/plugins/masterwp-theme-addons.zip', 
			'version'			=> '1.0.0',
			'required'          => true, 
		),
		array(
			'name'      		=> esc_html__('Contact Form 7', 'masterwp'),
			'slug'      		=> 'contact-form-7',
			'required'  		=> true,
		),
		array(
			'name'     			=> esc_html__('One Click Demo Import', 'masterwp') ,
			'slug'      		=> 'one-click-demo-import',
			'required'  		=> false,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'masterwp',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
