<?php
/**
 * Value Section with overlapping cards.
 *
 * @package firstfold
 */

$heading          = get_field( 'section_heading' );
$intro_text       = get_field( 'intro_text' );
$tiles            = get_field( 'value_tiles' );
$background_image = get_field( 'background_image' );
$value_logo       = get_field( 'value_logo' );
?>

<div class="values-section m-0 p-0">
	<header class="values-header relative text-white py-20 text-center min-h-[480px] overflow-hidden">
		<?php if ( $background_image ) : ?>
			<?php
			echo wp_get_attachment_image(
				$background_image,
				'full',
				false,
				[
					'class' => 'absolute inset-0 w-full h-full object-cover object-center',
				]
			);
			?>
		<?php endif; ?>

		<div class="header-content relative mx-auto max-w-[600px]">
			<?php if ( $value_logo ) : ?>
				<?php echo wp_get_attachment_image( $value_logo, 'full', false, [ 'class' => 'pb-6 mx-auto' ] ); ?>
			<?php endif; ?>

			<?php if ( $heading ) : ?>
				<h2 class="mb-4 text-[32px] uppercase font-medium leading-[40px] tracking-[-0.25px]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $intro_text ) : ?>
				<p class="intro-text text-[18px]">
					<?php echo wp_kses_post( $intro_text ); ?>
				</p>
			<?php endif; ?>
		</div>
	</header>

	<?php if ( $tiles ) : ?>
		<section class="tiles-container relative pb-20 min-h-[320px]">
			<div class="tiles flex md:flex-row flex-col justify-center -mt-[140px] gap-6 mx-auto max-w-[844px]">
				<?php foreach ( $tiles as $tile ) : ?>
					<div
						class="tile flex flex-col gap-10 text-center bg-white rounded-lg p-10 shadow-[0_10px_16px_rgba(0,0,0,0.1)]">
						<div class="tile-circle mx-auto w-[150px] h-[150px] rounded-full"
							style="background: linear-gradient(53deg, #CB131B 14.65%, #FFC000 85.12%);"></div>

						<div class="tile-content flex flex-col gap-4 leading-[1.6]">
							<h3 class="text-[#d32f2f] uppercase text-[1.3rem] m-0">
								<?php echo esc_html( $tile['tile_heading'] ); ?>
							</h3>

							<div class="prose"><?php echo wp_kses_post( $tile['tile_content'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</div>
