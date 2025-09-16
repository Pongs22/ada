<?php
/**
 * Show Footer Option.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package greydientlab
 */

$footer = new StoutLogic\AcfBuilder\FieldsBuilder( 'footer', array( 'position' => 'side' ) );
$footer
	->addTrueFalse(
		'show_footer',
		[
			'label'         => 'Show Footer?',
			'default_value' => 1,
		] 
	)
	->setLocation( 'post_type', '==', 'page' );
return $footer;
