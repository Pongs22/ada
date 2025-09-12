<?php
/**
 * Value Section
 *
 * @package firstfold
 */

$value_section = new StoutLogic\AcfBuilder\FieldsBuilder( 'value-section' );
$value_section
	->addText( 'section_heading' )
	->addText( 'intro_text' )
	->addImage(
		'background_image',
		[
			'preview_size'  => 'large',
			'label'         => __( 'Background Image', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addImage(
		'value_logo',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Value Section Logo', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addRepeater(
		'value_tiles',
		[
			'label'        => 'Value Tiles',
			'button_label' => 'Add Tile',
			'layout'       => 'block',
		]
	)
	->addImage(
		'tile_image',
		[
			'preview_size'  => 'thumbnail',
			'label'         => __( 'Tile Circle Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended size: 150x150px',
		]
	)
	->addText( 'tile_heading' )
	->addText( 'tile_content' )
	->endRepeater()
	->setLocation( 'block', '==', 'acf/value-section' );

return $value_section;
