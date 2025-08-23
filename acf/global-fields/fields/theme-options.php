<?php
/**
 * ACF Themes Options Fields.
 *
 * This is an example of how to create an ACF Banner Block.
 * Make sure that the location (setLocation) exists in the
 * acf/blocks and should match the name in block.json file
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

$theme_option = new StoutLogic\AcfBuilder\FieldsBuilder( 'theme_option' );
$theme_option
	->addText( 'title' )
	->addTextarea( 'description' )
	->addPageLink(
		'button_link',
		array(
			'label'         => __( 'Button Link', 'firstfold' ),
			'return_format' => 'url',
		)
	)
	->addText( 'button_text' )
	->setLocation( 'options_page', '==', 'theme-general-settings' );

return $theme_option;
