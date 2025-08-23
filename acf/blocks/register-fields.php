<?php
// phpcs:ignoreFile
/**
 * ACF Builder initialization and fields loading.
 * Learn more about StoutLogic AFC Builder here:
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

add_action(
	'acf/init',
	function () {
		$path  = dirname( __FILE__ );
		$files = array_diff( scandir( $path ), array( '.', '..', 'blocks.php', 'register-fields.php' ) );

		$fields = array();
		foreach ( $files as $file ) {
			$file = dirname( __FILE__ ) . '/' . $file . '/fields.php';

			if ( file_exists( $file ) ) {
				array_push( $fields, $file );
			}
		}

		foreach ( $fields as $file_path ) {
			if ( ( $fields = require_once $file_path ) !== true ) {
				if ( ! is_array( $fields ) ) {
					$fields = array( $fields );
				}

				foreach ( $fields as $field ) {
					acf_add_local_field_group( $field->build() );
				}
			}
		}
	}
);