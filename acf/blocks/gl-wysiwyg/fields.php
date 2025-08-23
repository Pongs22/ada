<?php
/**
 * GL Wysiwyg.
 *
 * ACF GL Text.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

$ff_wysiwyg = new StoutLogic\AcfBuilder\FieldsBuilder( 'ff_wysiwyg' );
$ff_wysiwyg
	->addWysiwyg(
		'paragraph',
		array(
			'media_upload' => 0,
		)
	)
	->setLocation( 'block', '==', 'acf/wysiwyg' );

return $ff_wysiwyg;
