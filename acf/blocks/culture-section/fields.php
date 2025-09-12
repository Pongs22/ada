<?php
/**
 * Culture Section
 *
 * @package firstfold
 */

$culture_section = new StoutLogic\AcfBuilder\FieldsBuilder( 'culture-section' );
$culture_section
	->addText( 'section_heading' )
	->addRepeater(
		'culture_rows',
		[
			'label'        => 'Culture Row',
			'button_label' => 'Add Row',
			'layout'       => 'block',
		]
	)
	->addImage(
		'row_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Row Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimensions: 1:1 (Square)',


		]
	)
	->addText( 'row_title' )
	->addText( 'row_description' )
	->endRepeater()
	->setLocation( 'block', '==', 'acf/culture-section' );
return $culture_section;
