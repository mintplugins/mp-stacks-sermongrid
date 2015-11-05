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