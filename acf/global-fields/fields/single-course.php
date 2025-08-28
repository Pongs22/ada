<?php
/**
 * Course Theme Option.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package greydientlab
 */

$course = new StoutLogic\AcfBuilder\FieldsBuilder( 'course', array( 'position' => 'side' ) );
$course
	->addText(
		'youtube_id',
		[
			'instructions' => 'paste the youtube id here',
		]
	)
	->addTextarea(
		'about',
		[
			'label'        => 'About Fields',
			'instructions' => 'Hello World', 
		]
	)
	->addRepeater( 'skills_gained' )
	->addText( 'skills' )
	->endRepeater()
	->addText( 'professor_name' )
	->addTextarea( 'professor_details' )
	->addRepeater( 'downloadable_materials' )
	->addText( 'link' )
	->endRepeater()
	->setLocation( 'post_type', '==', 'course' );
return $course;
