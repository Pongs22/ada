<?php
/**
 * Greydient Lab Features Section.
 * This section is not based on the Tailwind UI.
 * This file is similar to the features block, but this one is more independent and organized.
 * All fields are separately to each other for better access and avoid confusion.
 * 
 * @package firstfold
 */

$ff_cta = get_field( 'cta_style' );
$style       = $block['className'] ?? '';
?>
<div class="ff-b-cta-section">
	<?php if ( 'simple' === $ff_cta ) : ?>
		<?php require ff_get_custom_block_template( 'ff-cta', 'simple.php' ); ?>
	<?php endif; ?>
</div>
