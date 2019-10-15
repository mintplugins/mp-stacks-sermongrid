<?php
/**
 * This file contains the enqueue scripts function for the sermongrid plugin
 *
 * @since 1.0.0
 *
 * @package    MP Stacks + SermonGrid
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2015, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * Make SermonGrid Content Type Centered by default
 *
 * @access   public
 * @since    1.0.0
 * @param    $centered_content_types array - An array containing a string for each content-type that should default to centered brick alignment.
 * @param    $centered_content_types array - An array containing a string for each content-type that should default to centered brick alignment.
 */
function mp_stacks_sermongrid_centered_by_default( $centered_content_types ){

	$centered_content_types['sermongrid'] = 'sermongrid';

	return $centered_content_types;

}
add_filter( 'mp_stacks_centered_content_types', 'mp_stacks_sermongrid_centered_by_default' );

/**
* Function which sets up default info settings for Church Theme Content plugin
*/
function mp_stacks_sermongrid_add_ctc_support() {

    /**
     * Plugin Support
     *
     * Tell plugin theme supports it. This leaves all features disabled so they can
     * be enabled explicitly below. When support not added, all features are revealed
     * so user can access content (in case switched to an unsupported theme).
     *
     * This also removes the plugin's "not using compatible theme" message.
     */

    add_theme_support( 'church-theme-content' );

    /**
     * Plugin Features
     *
     * When array of arguments not given, plugin defaults are used (enabling all taxonomies
     * and fields for feature). It is recommended to explicitly specify taxonomies and
     * fields used by theme so plugin updates don't reveal unsupported features.
     */
    add_theme_support( 'ctc-sermons' );

}
add_action( 'after_setup_theme', 'mp_stacks_sermongrid_add_ctc_support' );

/**
* Change the ctc-sermons url slug from "sermons" to "ctc-sermons" so that the user can have a page called "sermons" without it changing to "sermons-2".
*/
function mp_stacks_sermongrid_ctc_sermon_slug( $args ) {

	// Arguments
	$args['rewrite']['slug'] = 'ctc-sermons';

	return $args;

}
add_filter( 'ctc_post_type_sermon_args', 'mp_stacks_sermongrid_ctc_sermon_slug' ); // register post type

/**
* Redirect the user to the correct feed URL if they are using the /sermons/feed url (it is now /ctc-sermons/feed)
*/
function mp_stacks_sermongrid_sermon_feed_redirect(){

	$current_url = mp_core_get_current_url();

	if ( strpos( $current_url, '/sermons/feed' ) === false ){
		return false;
	}

	wp_redirect( get_bloginfo( 'wpurl' ) . '/ctc-sermons/feed/', 301 );
	exit;

}
add_action( 'template_redirect', 'mp_stacks_sermongrid_sermon_feed_redirect' );

/**
 * Remove menu links from Church Theme Content (they contain unneeded ads which have confused many users)
 */
function mp_stacks_sermongrid_remove_church_theme_content_menu_settings() {
	global $wp_filter;

	// Don't hide the menu if they have bought Church Content Pro.
	if ( class_exists( 'Church_Content_Pro' ) ) {
		return false;
	}

	// Remove the podcast items under the sermons.
	remove_action( 'admin_menu', 'ctc_add_settings_menu_links' );

	// Remove the CTC settings panel under the WP settings. This is a bit tougher to do because it's inside a class.
	// Loop through each priority in the admin_menu hooks.
	foreach ( $wp_filter['admin_menu']->callbacks as $priority => $hooked_functions ) {
		// Loop through each action hooked at this priority.
		foreach ( $hooked_functions as $function_key => $hooked_function_data ) {

			if ( strpos( $function_key, 'add_page' ) !== false ) {
				if ( $hooked_function_data['function'][0] instanceof CT_Plugin_Settings ) {
					// Remove the add_page method from the list of hooked functions to admin_menu.
					unset( $hooked_functions[ $function_key ] );
					$wp_filter['admin_menu']->callbacks[ $priority ] = $hooked_functions;
				}
			}
		}
	}
}
add_action( 'admin_menu', 'mp_stacks_sermongrid_remove_church_theme_content_menu_settings', 0 );
