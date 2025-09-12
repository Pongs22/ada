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

<div class="values-section m-0 p-0 lg:pb-10 md:pb-0 pb-[180px]">
	<header class="values-header relative text-white lg:py-20 md:py-[60px] py-10 text-center lg:min-h-[585px] md:min-h-[483px] overflow-hidden px-6 md:px-8 lg:px-10 xl:px-20	">
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

		<div class="header-content relative mx-auto lg:max-w-[924px] md:max-w-[600px]">
			<?php if ( $value_logo ) : ?>
				<?php echo wp_get_attachment_image( $value_logo, 'full', false, [ 'class' => 'pb-6 mx-auto' ] ); ?>
			<?php endif; ?>

			<?php if ( $heading ) : ?>
				<h2 class="mb-4 lg:text-[32px] uppercase font-medium lg:leading-[40px] lg:tracking-[-0.25px] md:text-[24px] md:leading-[31px] text-[20px] leading-[28px] ">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $intro_text ) : ?>
				<p class="intro-text md:text-[18px] font-normal md:leading-[25.2px] text-[14px] leading-[19.6px]">
					<?php echo wp_kses_post( $intro_text ); ?>
				</p>
			<?php endif; ?>
		</div>
	</header>

	<?php if ( $tiles ) : ?>
		<section class="tiles-container relative max-h-[467px] h-full px-6 md:px-8 lg:px-10 xl:px-20">
			<div
				class="tiles flex md:flex-row flex-col justify-center md:pt-[60px] lg:-mt-[280px] md:-mt-[175px] mt-0 gap-6 mx-auto lg:max-w-[924px]">
				<?php foreach ( $tiles as $tile ) : ?>
					<div
						class="w-full tile flex flex-col gap-10 text-center bg-white rounded-lg lg:p-10 p-6 shadow-[0_10px_16px_rgba(0,0,0,0.1)]">
						<div class="tile-circle mx-auto lg:size-[150px] size-[100px]">
							<?php if ( ! empty( $tile['tile_image'] ) ) : ?>
								<?php echo wp_get_attachment_image( $tile['tile_image'], 'full', false, [ 'class' => 'w-full h-full object-cover object-center' ] ); ?>
							<?php else : ?>
								<div class="tile-circle mx-auto lg:size-[150px] size-[100px] rounded-full"
									style="background: linear-gradient(53deg, #CB131B 14.65%, #FFC000 85.12%);"></div>
							<?php endif; ?>
						</div>

						<div class="tile-content flex flex-col lg:gap-4 gap-3">
							<h3 class="text-ada_red-50 uppercase text-[24px] font-medium leading-[31px]">
								<?php echo esc_html( $tile['tile_heading'] ); ?>
							</h3>

							<div class="prose font-normal lg:leading-[25.2px] leading-[19.6px] lg:text-[18px] text-[14px]">
								<?php echo wp_kses_post( $tile['tile_content'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</div>
