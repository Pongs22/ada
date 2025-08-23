<?php
/**
 * ACF Greydient Lab Features Section.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

$ff_features = new StoutLogic\AcfBuilder\FieldsBuilder( 'ff_features' );
$ff_features
	->addSelect(
		'features_style',
		array(
			'default_value' => 'with-icon-list',
		)
	)
	->addChoices(
		[
			'with-icon-list' => 'With Icon List',
		]
	)
	/* -- With Icon List -- */
	->addGroup( 'with_icon_list_layout' )
	->conditional( 'features_style', '==', 'with-icon-list' )
	->addText( 'title' )
	->addTextarea( 'description' )
	->addLink( 'link' )
	->addImage(
		'image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Featured Image', 'firstfold' ),
			'return_format' => 'id',
		]
	)
	->addRepeater(
		'icon_list',
		[
			'layout' => 'block',
		]
	)
		->addImage(
			'icon',
			[
				'preview_size'  => 'medium',
				'label'         => __( 'Icon', 'firstfold' ),
				'return_format' => 'id',
			]
		)
	->addText( 'title' )
	->addTextarea( 'description' )
	->endRepeater()
	->endGroup()
	/* -- With Stats -- */

	->setLocation( 'block', '==', 'acf/ff-features' );

return $ff_features;
