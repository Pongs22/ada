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
		'disable_animation',
		[
			'label'         => 'Disable rectangle animation?',
			'default_value' => 0,
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

	->addTrueFalse(
		'dark_version', 
		[
			'label'         => 'Use Dark Version?',
			'default_value' => 0,
		] 
	)
	->conditional( 'hero_style', '==', 'image' )

	->addImage(
		'background_image',
		[
			'preview_size'  => 'medium',
			'label'         => __( 'Background Image', 'firstfold' ),
			'return_format' => 'id',
			'instructions'  => 'Recommended Dimension : 1376 x 450',
		] 
	)
	->conditional( 'hero_style', '==', 'image' )

	->addTextarea(
		'caption',
		[
			'label'        => 'Title',
		] 
	)
	->conditional( 'hero_style', '==', 'image' )

	->addTextarea(
		'description',
		[
			'label'        => 'Description',
		] 
	)
	->conditional( 'hero_style', '==', 'image' )

	->addTrueFalse(
		'hide_extra', 
		[
			'label'         => 'Hide extra container?',
			'default_value' => 1,
		]
	)
	->conditional( 'hero_style', '==', 'image' )
	->addText( 'extra_title', [ 'label' => 'Title' ] )
	->conditional( 'hide_extra', '==', 0 )
	->addTextarea(
		'extra_description',
		[
			'label'     => 'Description',
			'new_lines' => 'br',
		]
	)
	->conditional( 'hide_extra', '==', 0 )
	->setLocation( 'block', '==', 'acf/ff-hero' );

return $ff_hero;
