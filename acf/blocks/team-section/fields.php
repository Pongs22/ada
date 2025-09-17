<?php
/**
 * Team Section
 *
 * @package firstfold
 */

$team = new StoutLogic\AcfBuilder\FieldsBuilder( 'team-section' );
$team
	->addText( 'section_heading' )
	->addText( 'section_text' )
	->addRepeater(
		'team_cards',
		[
			'label'        => 'Team Cards',
			'button_label' => 'Add Card',
			'layout'       => 'block',
		]
	)
	->addText( 'card_heading' )
	->addRepeater(
		'card_content',
		[
			'label'        => 'Card Content',
			'button_label' => 'Add Content',
			'layout'       => 'block',
		]
	)
	->addImage(
		'card_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Card Image', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addText( 'card_name' )
	->addText( 'card_title' )
	->addRepeater(
		'team_socials'
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
	->setLocation( 'block', '==', 'acf/team-section' );

return $team;
