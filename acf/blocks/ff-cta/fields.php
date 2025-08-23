<?php
/**
 * ACF Greydient Lab Features Section.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

$ff_cta = new StoutLogic\AcfBuilder\FieldsBuilder( 'ff_cta' );
$ff_cta
	->addSelect(
		'cta_style',
		array(
			'default_value' => 'simple',
		)
	)
	->addChoices(
		[
			'simple' => 'Simple CTA',
		]
	)
	/* -- Simple CTA -- */
	->addGroup( 'simple_cta_layout' )
	->conditional( 'cta_style', '==', 'simple' )
	->addText( 'title' )
	->addTextarea( 'description' )
	->addLink( 'link' )
	->endGroup()

	->setLocation( 'block', '==', 'acf/ff-cta' );

return $ff_cta;
