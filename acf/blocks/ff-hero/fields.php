<?php
/**
 * ACF Greydient Lab Hero Section.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package firstfold
 */

$ff_hero = new StoutLogic\AcfBuilder\FieldsBuilder( 'ff_hero' );
$ff_hero
	->addSelect(
		'hero_style',
		array(
			'default_value' => 'full',
		)
	)
	->addChoices(
		[
			'full'  => 'Main Hero',
			'image' => 'Full With Image',
		]
	)
	->addTrueFalse(
		'use_video', 
		[
			'label'         => 'Use Background Video Instead?',
			'default_value' => 0,
		] 
	)
	->conditional( 'hero_style', '==', 'full' )
	->addFile(
		'video_file',
		[
			'label'         => 'Upload Video',
			'instructions'  => 'Recommended Dimension: 1920 x 1080',
			'return_format' => 'url',
			'mime_types'    => 'mp4,webm,ogg,mov',
		]
	)
	->conditional( 'use_video', '==', 1 )

	->addImage(
		'hero_background_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Background Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 1440 x 700',
		] 
	)
	->conditional( 'use_video', '==', 0 )

	->addTextarea(
		'hero_caption',
		[
			'label'        => 'Title',
		] 
	)
	->conditional( 'hero_style', '==', 'full' )

	->addTextarea(
		'hero_description',
		[
			'label'        => 'Description',
		] 
	)
	->conditional( 'hero_style', '==', 'full' )
	->addLink( 'link' )
	->conditional( 'hero_style', '==', 'full' )

	// Full Width Image Fields.
	->addGroup( 'full_with_image_layout' )
	->conditional( 'hero_style', '==', 'image' )
	->addImage(
		'background_image_dt',
		[
			'preview_size'  => 'full',
			'label'         => __( 'Background Image (Desktop)', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 1440 x 550',
		] 
	)

	->addImage(
		'background_image_tb',
		[
			'preview_size'  => 'full',
			'label'         => __( 'Background Image (Tablet)', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 768 x 650',
		] 
	)

	->addImage(
		'background_image_mb',
		[
			'preview_size'  => 'full',
			'label'         => __( 'Background Image (Tablet)', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 375 x 450',
		] 
	)

	->addTextarea(
		'caption',
		[
			'label'        => 'Title',
		] 
	)

	->addTextarea(
		'description',
		[
			'label'        => 'Description',
		] 
	)
	->endGroup()
	->setLocation( 'block', '==', 'acf/ff-hero' );

return $ff_hero;
