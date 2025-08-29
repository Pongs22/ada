<?php
/**
 * Leadership Section
 *
 * @package firstfold
 */

$leadership = new StoutLogic\AcfBuilder\FieldsBuilder( 'leadership-section' );

$leadership
	->addText( 'section_title' )
	->addImage(
		'background_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Image', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addText( 'leader_name' )
	->addText( 'leader_title' )
	->addTextarea( 'leader_bio' )
	->addRepeater(
		'leader_socials'
	)
	->addImage(
		'icon',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Icon', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addLink( 'link' )
	->endRepeater()
	->setLocation( 'block', '==', 'acf/leadership-section' );

return $leadership;
