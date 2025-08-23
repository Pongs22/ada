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
			'default_value' => 'with-expanding-image',
		)
	)
	->addChoices(
		[
			'with-expanding-image' => 'With Expanding Image',
			'with-stats'           => 'With Stats',
		]
	)
	/* -- With Expanding Image Fields -- */
	->addText(
		'with_expanding_image_subtext',
		[
			'label' => 'Subtext',
		] 
	)
	->conditional( 'features_style', '==', 'with-expanding-image' )
	->addText(
		'with_expanding_image_title',
		[
			'label' => 'Title',
		] 
	)
	->conditional( 'features_style', '==', 'with-expanding-image' )
	->addTextarea(
		'with_expanding_image_description',
		[
			'label'     => 'Description',
			'new_lines' => 'br',
		] 
	)
	->conditional( 'features_style', '==', 'with-expanding-image' )
	->addRepeater(
		'with_expanding_image_repeater',
		[
			'label'        => 'Images',
			'button_label' => 'Add Image',
			'max'          => 3,
			'min'          => 3,
		] 
	)
	->conditional( 'features_style', '==', 'with-expanding-image' )
	->addImage(
		'image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Featured Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : ',
		] 
	)
	->endRepeater()
	/* -- With Expanding Image Fields -- */

	/* -- With Stats -- */
	->addText(
		'with_stats_subtext',
		[
			'label' => 'Subtext',
		] 
	)
	->conditional( 'features_style', '==', 'with-stats' )
	->addText(
		'with_stats_title',
		[
			'label' => 'Title',
		] 
	)
	->conditional( 'features_style', '==', 'with-stats' )
	->addTextarea(
		'with_stats_description',
		[
			'label'     => 'Description',
			'new_lines' => 'br',
		] 
	)
	->conditional( 'features_style', '==', 'with-stats' )
	->addImage(
		'with_stats_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Featured Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : ',
		] 
	)
	->conditional( 'features_style', '==', 'with-stats' )
	->addRepeater(
		'with_stats_repeater',
		[
			'label'        => 'Stats',
			'button_label' => 'Add Stats',
			'max'          => 2,
		] 
	)
	->conditional( 'features_style', '==', 'with-stats' )
	->addText( 'value' )
	->addText( 'suffix' )
	->addText(
		'description',
		[
			'new_lines' => 'br',
		] 
	)
	->endRepeater()
	/* -- With Stats -- */

	->setLocation( 'block', '==', 'acf/ff-features' );

return $ff_features;
