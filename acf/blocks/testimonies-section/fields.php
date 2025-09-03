<?php
/**
 * Testimonies Section
 *
 * @package firstfold
 */

$testimonies = new StoutLogic\AcfBuilder\FieldsBuilder( 'testimonies-section' );

$testimonies
	->addText( 'section_title' )
	->addRepeater( 'testimonies' )
	->addTextarea( 'testimonial' )
	->addImage(
		'image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Card Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimensions: 1:1 (Square)',
		]
	)
	->addText( 'name' )
	->addText( 'job_title' )
	->endRepeater()
	->setLocation( 'block', '==', 'acf/testimonies-section' );

return $testimonies;
