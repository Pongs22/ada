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

define( 'FIELDS_DIR', dirname( __FILE__ ) . '/fields' );

if ( is_dir( FIELDS_DIR ) ) {
	add_action(
		'acf/init',
		function () {
			foreach ( glob( FIELDS_DIR . '/*.php' ) as $file_path ) {
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
}
