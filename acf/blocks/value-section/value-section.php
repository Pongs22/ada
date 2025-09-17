<?php
/**
 * Value Section About Us.
 *
 * @package firstfold
 */

$heading          = get_field( 'section_heading' );
$intro_text       = get_field( 'intro_text' );
$tiles            = get_field( 'value_tiles' );
$background_image = get_field( 'background_image' );
$value_logo       = get_field( 'value_logo' );
?>

<div class="values-section m-0 flex flex-col p-0 text-center">

	<div class="relative overflow-hidden bg-white">
		<?php if ( $background_image ) : ?>
			<div class="absolute inset-0 w-full">
				<?php
				echo wp_get_attachment_image(
					$background_image,
					'full',
					false,
					[ 'class' => 'w-full lg:h-[585px] md:h-[556px] h-[75vh]  object-cover object-center' ]
				);
				?>
			</div>
		<?php endif; ?>

		<div class="relative z-10 mx-auto px-6 pb-10 pt-10 text-white md:max-w-[600px] md:px-0 md:pb-[60px] md:pt-[60px] lg:max-w-[924px] lg:pb-[51px] lg:pt-[80px]">
			<?php if ( $value_logo ) : ?>
				<?php echo wp_get_attachment_image( $value_logo, 'full', false, [ 'class' => 'pb-6 mx-auto' ] ); ?>
			<?php endif; ?>

			<?php if ( $heading ) : ?>
				<h2 class="mb-4 text-[20px] font-medium uppercase leading-[28px] md:text-[24px] md:leading-[31px] lg:text-[32px] lg:leading-[40px] lg:tracking-[-0.25px]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $intro_text ) : ?>
				<p class="intro-text text-[14px] font-normal leading-[19.6px] md:text-[16px] md:leading-[22.4px] lg:text-[18px] lg:leading-[25.2px]">
					<?php echo wp_kses_post( $intro_text ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="tiles relative z-10 mx-auto mb-10 flex flex-col justify-center gap-6 px-6 md:flex-row md:px-8 lg:max-w-[924px] lg:px-0">
				<?php foreach ( $tiles as $tile ) : ?>
					<div class="tile flex w-full flex-col gap-10 rounded-lg bg-white p-6 text-center shadow-[0_10px_16px_rgba(0,0,0,0.1)] lg:p-10">
						<div class="tile-circle mx-auto size-[100px] lg:size-[150px]">
							<?php if ( ! empty( $tile['tile_image'] ) ) : ?>
								<?php echo wp_get_attachment_image( $tile['tile_image'], 'full', false, [ 'class' => 'w-full h-full object-cover object-center' ] ); ?>
							<?php else : ?>
								<div class="tile-circle mx-auto size-[100px] rounded-full lg:size-[150px]"
									style="background: linear-gradient(53deg, #CB131B 14.65%, #FFC000 85.12%);"></div>
							<?php endif; ?>
						</div>

						<div class="tile-content flex flex-col gap-2 lg:gap-3 lg:gap-4">
							<h3 class="text-[24px] font-medium uppercase leading-[31px] text-ada_red-50">
								<?php echo esc_html( $tile['tile_heading'] ); ?>
							</h3>

							<div class="prose text-[14px] font-normal leading-[19.6px] lg:text-[18px] lg:leading-[25.2px]">
								<?php echo wp_kses_post( $tile['tile_content'] ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
	</div>
</div>
