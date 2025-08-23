<?php
/**
 * Initialize ACF Custom Blocks
 * Learn more about blocks here:
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package firstfold
 */

/**
 * Register Custom ACF Blocks.
 */
function register_acf_blocks() {
	$path  = dirname( __FILE__ );
	$files = array_diff( scandir( $path ), array( '.', '..', '.blocks.php' ) );

	foreach ( $files as $file ) {
		register_block_type( dirname( __FILE__ ) . '/' . $file );
	}
}
add_action( 'init', 'register_acf_blocks' );

/**
 * Register block script
 */
function register_block_script() {
	$path  = dirname( __FILE__ );
	$files = array_diff( scandir( $path ), array( '.', '..', '.script.min.js' ) );

	foreach ( $files as $file ) {
		$script = dirname( __FILE__ ) . '/' . $file . '/js/script.min.js';
		if ( file_exists( $script ) ) {
			wp_register_script( $file, get_template_directory_uri() . '/acf/blocks/' . $file . '/js/script.js', array( 'jquery', 'acf', 'alpine' ), _FF_VERSION, true );
		};
	}
}
add_action( 'init', 'register_block_script' );
