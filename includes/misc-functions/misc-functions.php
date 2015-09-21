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
 * Function which returns an array of font awesome icons
 */
function mp_stacks_sermongrid_get_font_awesome_icons(){
	
	//Get all font styles in the css document and put them in an array
	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	//$subject = file_get_contents( plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
	
	$args = array(
		'timeout'     => 5,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => array(),
		'cookies'     => array(),
		'body'        => null,
		'compress'    => false,
		'decompress'  => true,
		'sslverify'   => false,
		'stream'      => false,
		'filename'    => null
	); 

	$response = wp_remote_retrieve_body( wp_remote_get( plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ), $args ) );
	
	preg_match_all($pattern, $response, $matches, PREG_SET_ORDER);
	
	$icons = array();

	foreach($matches as $match){
		$icons[$match[1]] = $match[1];
	}
	
	return $icons;
}