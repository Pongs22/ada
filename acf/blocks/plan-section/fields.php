<?php
/**
 * Plan Section
 *
 * @package firstfold
 */

$plan = new StoutLogic\AcfBuilder\FieldsBuilder( 'plan-section' );

$plan
	->addImage(
		'background_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Background Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 1440 x 704',
		] 
	)
	->addText( 'section_title' )
	->addRepeater( 'plan_card' )
		->addText( 'plan_type' )
		->addTextarea( 'plan_description' )
		->addRepeater( 'course_list' )
			->addText( 'course_details' )
		->endRepeater()
	->endRepeater()
	->setLocation( 'block', '==', 'acf/plan-section' );

return $plan;
