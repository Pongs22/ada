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
	->addImage( 'card_image' )
	->addText( 'card_name' )
	->addText( 'card_title' )
	->endRepeater()
	->endRepeater()
	->setLocation( 'block', '==', 'acf/team-section' );

return $team;
