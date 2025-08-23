<?php
/**
 * GL Wysiwyg Template.
 *
 * @package firstfold
 */

$style            = '';
$background_color = $block['backgroundColor'] ?? null;
$class_name       = $block['className'] ?? '';

if ( $background_color ) {
	$style = 'background-color: var(--wp--preset--color--' . $background_color . ');';
}

$paragraph = empty( get_field( 'paragraph' ) ) ? 'Your Paragraph Here...' : get_field( 'paragraph' );
?>
<div class="ff-b-wysiwyg <?php echo esc_attr( $class_name ); ?> container m-auto" style="<?php echo esc_attr( $style ); ?>">
	<div class="grid grid-cols-1">
		<div><?php echo wp_kses_post( $paragraph ); ?></div>
	</div>
</div>
