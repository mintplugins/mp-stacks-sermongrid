<?php
/**
* This file contains functions which create output for podcast selection regardless of the theme.
*
* @since 1.0.0
*
* @package    MP Stacks SocialGrid
* @subpackage Functions
*
* @copyright  Copyright (c) 2019, Mint Plugins
* @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @author     Philip Johnston
*/

/**
* Output the podcast page
*
* @since 1.6
*
* @param void
* @return void
*/
function mp_sermongrid_podcast_output() {

	if ( ! isset( $_GET['mp_stacks_sermongrid_podcast'] ) ) {
		return;
	}

	$feed_url = get_bloginfo( 'wpurl' ) . '/ctc-sermons/feed/';

	// If CTC is installed use it's feed for the podcast.
	if ( class_exists( 'Church_Theme_Content' ) ) {
		$feed_url = get_bloginfo( 'wpurl' ) . '/ctc-sermons/feed/';
	}

	// If WPFC is installed, use its feed.
	if ( class_exists( 'SermonManager' ) ) {
		$feed_url = get_bloginfo( 'wpurl' ) . '/wpfc-sermons/feed/';
	}

	$feed_url = apply_filters( 'mp_stacks_sermongrid_podcast_feed_url', $feed_url );

	if ( ! is_ssl() ) {
		$itunes_url = str_replace( 'http://', 'itpc://', $feed_url );
	} else {
		$itunes_url = str_replace( 'https://', 'itpc://', $feed_url );
	}

	// If we are on iPhone
	if ( mp_core_is_iphone() ) {
		if ( ! is_ssl() ) {
			$itunes_url = str_replace( 'http://', 'feed://', $feed_url );
		} else {
			$itunes_url = str_replace( 'https://', 'feed://', $feed_url );
		}
	}

	ob_get_clean();
	ob_start();
	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	<html>

		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>" />
			<meta name=viewport content="width=device-width, initial-scale=1">
			<title><?php echo __( 'Open podcast', 'mp_stacks_sermondgrid' ); ?></title>

			<!-- Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>

			<style type="text/css">
				.mp-sermongrid-podcast-page{
					width:100%;
					background-color: #f7f8f9;
					font-size: 1.2rem;
					margin:0px;
					font-family: 'Montserrat', 'Helvetica Neue', Arial,Helvetica, sans-serif;
					box-sizing:border-box;
				}
				h1{
					font-size: 30px;
				}
				.mp-sermongrid-podcast-page-container{
					margin: 40px auto;
					padding:30px;
					width:80%;
					max-width:600px;
					border-radius:4px;
					box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					-webkit-box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					-moz-box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					background-color:#FFFFFF;
				}
				.mp-sermondgrid-podcast-selection-item{
					margin-bottom:20px;
				}
				.mp-sermondgrid-podcast-selection-item-img{
					width:25px;
				}

				/* Global Button Styles */
				.animated-button {
					font-size: 18px;
					position: relative;
					display: block;
					padding: 14px 15px;
					color: #f9b429;
					text-align: center;
					text-decoration: none;
					overflow: hidden;
					letter-spacing: .08em;
					border-radius: 0;
					-webkit-transition: all 1s ease;
					-moz-transition: all 1s ease;
					-o-transition: all 1s ease;
					transition: all 1s ease;
				}


				/* Thar Buttons */
				.animated-button.thar-three {
					color: #545454;
					cursor: pointer;
					display: inline-block;
					position: relative;
					border: 3px solid #545454;
					transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
				}
				.animated-button.thar-three:before {
					display: block;
					position: absolute;
					top: 0px;
					right: 0px;
					height: 100%;
					width: 0px;
					z-index: -1;
					content: '';
					color: #FFFFFF !important;
					background: #f9b429;
					transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
				}

			</style>
		</head>

		<body class="mp-sermongrid-podcast-page">
			<div class="mp-sermongrid-podcast-page-container">
				<h1><?php echo __( 'How do you listen to podcasts?', 'mp_stacks_sermongrid' ); ?></h1>
				<div class="mp-sermongrid-podcast-selection-container">
					<div class="mp-sermondgrid-podcast-selection-item itunes">
						<a class="animated-button thar-three" href="<?php echo $itunes_url; ?>">
							<span class="mp-sermondgrid-podcast-selection-item-text"><?php echo __( 'I already use iTunes', 'mp_stacks_sermongrid' ); ?></span>
						</a>
					</div>
					<div class="mp-sermondgrid-podcast-selection-item other">
						<a class="animated-button thar-three" href="<?php echo get_bloginfo( 'wpurl' ) . '?mp_stacks_sermongrid_podcast_other'; ?>">
							<span class="mp-sermondgrid-podcast-selection-item-text"><?php echo __( 'I use another app (android etc)', 'mp_stacks_sermongrid' ); ?></span>
						</a>
					</div>
					<div class="mp-sermondgrid-podcast-selection-item other">
						<a class="animated-button thar-three" href="<?php echo 'https://www.google.com/search?q=podcasting+apps'; ?>">
							<span class="mp-sermondgrid-podcast-selection-item-text"><?php echo __( 'I don\'t have a way to listen to podcasts yet', 'mp_stacks_sermongrid' ); ?></span>
						</a>
					</div>
				</div>
			</div>
		</body>

	</html>

<?php
$output = ob_get_clean();
echo $output;
die();

}
add_action( 'init', 'mp_sermongrid_podcast_output' );


/**
* Output the podcast page
*
* @since 1.6
*
* @param void
* @return void
*/
function mp_sermongrid_podcast_other_output() {

	if ( ! isset( $_GET['mp_stacks_sermongrid_podcast_other'] ) ) {
		return;
	}

	$feed_url = get_bloginfo( 'wpurl' ) . '/ctc-sermons/feed/';

	// If CTC is installed use it's feed for the podcast.
	if ( class_exists( 'Church_Theme_Content' ) ) {
		$feed_url = get_bloginfo( 'wpurl' ) . '/ctc-sermons/feed/';
	}

	// If WPFC is installed, use its feed.
	if ( class_exists( 'SermonManager' ) ) {
		$feed_url = get_bloginfo( 'wpurl' ) . '/wpfc-sermons/feed/';
	}

	$feed_url = apply_filters( 'mp_stacks_sermongrid_podcast_feed_url', $feed_url );

	ob_get_clean();
	ob_start();
	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	<html>

		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>" />
			<meta name=viewport content="width=device-width, initial-scale=1">
			<title><?php echo __( 'Open podcast', 'mp_stacks_sermondgrid' ); ?></title>

			<!-- Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>

			<style type="text/css">
				.mp-sermongrid-podcast-page{
					width:100%;
					background-color: #f7f8f9;
					font-size: 1.2rem;
					margin:0px;
					font-family: 'Montserrat', 'Helvetica Neue', Arial,Helvetica, sans-serif;
					box-sizing:border-box;
				}
				h1{
					font-size: 30px;
				}
				.mp-sermongrid-podcast-page-container{
					margin: 40px auto;
					padding:30px;
					width:80%;
					max-width:600px;
					border-radius:4px;
					box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					-webkit-box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					-moz-box-shadow: rgba(0,0,0,.3) 0 1px 3px;
					background-color:#FFFFFF;
				}
				.mp-sermondgrid-podcast-selection-item{
					margin-bottom:20px;
				}
				.mp-sermondgrid-podcast-copy-url-field{
					margin-bottom:20px;
				}
				.mp-sermondgrid-podcast-selection-item-img{
					width:25px;
				}

				.mp-sermondgrid-podcast-instruction-area{
					line-height: 1.4em;
					font-size: 14px;
				}

				.mp-sermondgrid-podcast-copy-url-field{
					width:100%;
					height:50px;
					padding:10px;
					font-size: 30px;
					margin-top:20px;
				}

				/* Global Button Styles */
				.animated-button {
					font-size: 18px;
					position: relative;
					display: block;
					padding: 14px 15px;
					color: #f9b429;
					text-align: center;
					text-decoration: none;
					overflow: hidden;
					letter-spacing: .08em;
					border-radius: 0;
					-webkit-transition: all 1s ease;
					-moz-transition: all 1s ease;
					-o-transition: all 1s ease;
					transition: all 1s ease;
				}


				/* Thar Buttons */
				.animated-button.thar-three {
					color: #545454;
					cursor: pointer;
					display: inline-block;
					position: relative;
					border: 3px solid #545454;
					transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
				}
				.animated-button.thar-three:before {
					display: block;
					position: absolute;
					top: 0px;
					right: 0px;
					height: 100%;
					width: 0px;
					z-index: -1;
					content: '';
					color: #FFFFFF !important;
					background: #f9b429;
					transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
				}


			</style>

		</head>

		<body class="mp-sermongrid-podcast-page">
			<script type="text/javascript">

				function select_text() {

					console.log( 'sesg' );
					/* Get the text field */
					var copyText = document.getElementById("mp-sermondgrid-podcast-copy-url-field");

					/* Select the text field */
					copyText.select();

					/* Copy the text inside the text field */
					document.execCommand("copy");

				}
			</script>
			<div class="mp-sermongrid-podcast-page-container">
				<h1><?php echo __( 'Subscribe using your app\'s instructions', 'mp_stacks_sermongrid' ); ?></h1>
				<div class="mp-sermongrid-podcast-selection-container">
					<div class="mp-sermondgrid-podcast-instruction-area">
						<?php echo __( 'Great! Your app will have instructions on how to subscribe to a podcast. Usually, it will ask you for a podcast URL. When it does, copy and paste this URL into the app to subscribe:', 'mp_stacks_sermongrid' ); ?>
					</div>
					<div class="mp-sermondgrid-podcast-selection-item other">
						<input id="mp-sermondgrid-podcast-copy-url-field" class="mp-sermondgrid-podcast-copy-url-field" type="text" readonly="true" value="<?php echo esc_url( $feed_url ); ?>"/>
						<button class="animated-button thar-three" onclick="select_text()"><?php echo __( 'Copy', 'mp_stacks_sermongrid' ); ?></button>
					</div>
				</div>
			</div>
		</body>

	</html>

<?php
$output = ob_get_clean();
echo $output;
die();

}
add_action( 'init', 'mp_sermongrid_podcast_other_output' );
