<?php
/**
 * Card Molecule
 *
 * Usage:
 * add use Lean\Load; at the start of the php file then
 * Load::molecule( 'cards/card', array('key' => 'value') );
 *
 * @package firstfold
 */

$class       = $args['class'] ?? '';
$img         = $args['image_url'] ?? get_template_directory_uri() . '/frontend/components/molecules/cards/img/image-placeholder.jpg';
$card_title  = $args['title'] ?? 'Your Title Here';
$description = $args['description'] ?? 'Your Description Here';
$card_link   = $args['link'] ?? false;
?>
<?php if ( $link ) : ?>
	<a class="ff-card-link" href="<?php echo esc_url( $card_link ); ?>">
<?php endif; ?>

<div class="ff-card">
	<img src="<?php echo esc_url( $img ); ?>" alt="Card">

	<div class="card-body">
		<p class="title"><?php echo esc_html( $card_title ); ?></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
</div>

<?php if ( $link ) : ?>
	</a>
<?php endif; ?>
