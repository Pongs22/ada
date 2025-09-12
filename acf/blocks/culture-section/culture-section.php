<?php
/**
 * Culture Section
 *
 * @package firstfold
 */

$heading      = get_field( 'section_heading' );
$culture_rows = get_field( 'culture_rows' );
?>
<section class="culture-section relative xl:px-20 lg:px-10 md:px-8 px-6 py-[100px]">
	<div class="culture-rows grid grid-cols-1 lg:grid-cols-2 lg:gap-x-6 w-full">
		<?php if ( $heading ) : ?>
			<header class="culture-section-header w-full">
				<h2 class="lg:text-[32px] font-medium uppercase lg:leading-[40px] lg:tracking-[-0.25px] md:text-[24px] md:leading-[31px] text-[20px] leading-[28px] text-ada_red-50">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</header>
		<?php endif; ?>

		<?php if ( ! empty( $culture_rows ) && is_array( $culture_rows ) ) : ?>
			<div class="culture-rows lg:grid lg:grid-cols-1 md:grid md:grid-cols-2 md:gap-x-6 divide-y w-full">
				<?php
				foreach ( $culture_rows as $row ) : 
					$row_image       = $row['row_image'] ? $row['row_image'] : null;
					$row_title       = $row['row_title'] ? $row['row_title'] : '';
					$row_description = $row['row_description'] ? $row['row_description'] : '';
					?>
					<div class="culture-card lg:first:pt-0 lg:py-10 py-8 flex gap-4 w-full">
						<?php if ( $row_image ) : ?>
							<div class="card-image mb-4 lg:mb-0 lg:shrink-0 size-[40px] md:size-[48px] lg:size-[64px]">
								<?php echo wp_get_attachment_image( $row_image, 'full', false, [ 'class' => 'w-full h-full object-cover object-center rounded-full' ] ); ?>
							</div>
						<?php else : ?>
							<div class="tile-circle size-[40px] md:size-[48px] lg:size-[64px] aspect-square"
							style="background: linear-gradient(180deg, #CB131B 0%, #FFC000 100%);"></div>	
						<?php endif; ?>

						<div class="card-content">
							<?php if ( $row_title ) : ?>
								<h3 class="lg:text-[24px] font-medium lg:leading-[31px] md:text-[20px] md:leading-[28px] text-[18px] leading-[21.6px]">
									<?php echo esc_html( $row_title ); ?>
								</h3>
							<?php endif; ?>

							<?php if ( $row_description ) : ?>
								<p class="lg:mt-[6px] lg:text-[18px] md:text-[16px] text-[14px] lg:leading-[25.2px] md:leading-[22.4px] leading-[19.6px] font-normal">
									<?php echo esc_html( $row_description ); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
