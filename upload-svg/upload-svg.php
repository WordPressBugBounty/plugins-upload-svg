<?php
/*
 * Plugin Name:       Upload SVG
 * Description:       Safely enable SVG uploads with sanitization and prevent XML/SVG vulnerabilities on your WP website. Preview SVGs in your Media Library.
 * Version:           1.0.5
 * Requires at least: 5.7
 * Requires PHP:      7.1
 * Author:            Fla-shop.com
 * Author URI:        https://www.fla-shop.com
 * License:           GPL v2 or later
 * Text Domain:       upload-svg
*/

// Exit if accessed directly.
if( ! defined( 'ABSPATH' ) ){

	exit;
}

define( 'SVGUPL_PLUGIN_VERSION',   '1.0.5' );
define( 'SVGUPL_PHP_MIN_VERSION',  '7.1' );
define( 'SVGUPL_WP_MIN_VERSION',   '5.7' );
define( 'SVGUPL_PLUGIN_NAME',      'upload-svg' );
define( 'SVGUPL_PLUGIN_SHORT_NAME', 'svgupl' );

define( 'SVGUPL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SVGUPL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load classes Sanitizer.
if( ! class_exists('enshrined\svgSanitize\Sanitizer') ) {

	$svgupl_sanitizer_file_paths = array(
		'includes/svg-sanitizer/src/data/AttributeInterface.php',
		'includes/svg-sanitizer/src/data/TagInterface.php',
		'includes/svg-sanitizer/src/data/AllowedAttributes.php',
		'includes/svg-sanitizer/src/data/AllowedTags.php',
		'includes/svg-sanitizer/src/data/XPath.php',
		'includes/svg-sanitizer/src/ElementReference/Resolver.php',
		'includes/svg-sanitizer/src/ElementReference/Subject.php',
		'includes/svg-sanitizer/src/ElementReference/Usage.php',
		'includes/svg-sanitizer/src/Exceptions/NestingException.php',
		'includes/svg-sanitizer/src/Helper.php',
		'includes/svg-sanitizer/src/Sanitizer.php'
	);

	foreach( $svgupl_sanitizer_file_paths as $svgupl_sanitizer_file_path ) {

		$svgupl_real_path = SVGUPL_PLUGIN_DIR . $svgupl_sanitizer_file_path;

		if( realpath( $svgupl_real_path ) && file_exists( $svgupl_real_path ) ) {

			require_once( $svgupl_real_path );
		}
	}
}

// Init main plugin class.
$svgupl_main_class_path = SVGUPL_PLUGIN_DIR . 'includes/class-wp-upload-svg.php';

if( realpath( $svgupl_main_class_path ) && file_exists( $svgupl_main_class_path ) ) {

	require_once( $svgupl_main_class_path );
}

new SVGUPL_Upload();
