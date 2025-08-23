<?php
/**
 * FAQ Section.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package turigma
 */

$faq_section = new StoutLogic\AcfBuilder\FieldsBuilder( 'faq_section' );
$faq_section
	->addText( 'title' )
	->addTextarea( 'description' )
	->addRepeater(
		'questions',
		[
			'label'        => 'Question',
			'button_label' => 'Add Question',
			'layout'       => 'block',
		]
	)

	->addText( 'question' )
	->addTextarea( 'answer' )
	->endRepeater()
	->setLocation( 'block', '==', 'acf/faq-section' );

return $faq_section;
