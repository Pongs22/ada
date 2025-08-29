<?php
/**
 * Greydient Lab Hero Section.
 * This section is not based on the Tailwind UI.
 * This file is similar to the hero block, but this one is more independent and organized.
 * All fields are separately to each other for better access and avoid confusion.
 * 
 * @package firstfold
 */

$ff_hero = get_field( 'hero_style' );
$style   = isset( $block['className'] ) ? $block['className'] : '';
?>
<div class="ff-b-hero-section">
	<?php if ( 'full' === $ff_hero ) : ?>
		<?php require ff_get_custom_block_template( 'ff-hero', 'full-height-background-image.php' ); ?>
	<?php endif; ?>
	<?php if ( 'image' === $ff_hero ) : ?>
		<?php require ff_get_custom_block_template( 'ff-hero', 'full-width-image.php' ); ?>
	<?php endif; ?>
</div>
