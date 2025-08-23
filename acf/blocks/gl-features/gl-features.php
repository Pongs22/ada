<?php
/**
 * Greydient Lab Features Section.
 * This section is not based on the Tailwind UI.
 * This file is similar to the features block, but this one is more independent and organized.
 * All fields are separately to each other for better access and avoid confusion.
 * 
 * @package firstfold
 */

$ff_features = get_field( 'features_style' );
$style       = $block['className'] ?? '';
?>
<div class="ff-b-features-section">
	<?php if ( 'with-expanding-image' === $ff_features ) : ?>
		<?php require ff_get_custom_block_template( 'ff-features', 'with-expanding-image.php' ); ?>
	<?php endif; ?>
	<?php if ( 'with-stats' === $ff_features ) : ?>
		<?php require ff_get_custom_block_template( 'ff-features', 'with-stats.php' ); ?>
	<?php endif; ?>
</div>
