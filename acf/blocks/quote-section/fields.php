<?php
/**
 * ACF Quote Section.
 *
 * @link https://github.com/StoutLogic/acf-builder/wiki
 *
 * @package greydientlab
 */

$quote_section = new StoutLogic\AcfBuilder\FieldsBuilder( 'quote_section' );
$quote_section
	->addTextarea( 'quote' )
	->setLocation( 'block', '==', 'acf/quote-section' );

return $quote_section;
