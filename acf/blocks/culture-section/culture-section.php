<?php
/**
 * Culture Section
 *
 * @package firstfold
 */

$heading      = get_field( 'section_heading' );
$culture_rows = get_field( 'culture_rows' );
?>
<section class="culture-section relative px-6 lg:py-20 md:py-[60px] py-10 md:px-8 lg:px-10 xl:px-20">
	<div class="culture-rows grid w-full grid-cols-1 lg:grid-cols-2 lg:gap-x-6">
		<?php if ( $heading ) : ?>
			<header class="culture-section-header w-full">
				<h2 class="text-[20px] font-medium uppercase leading-[28px] text-ada_red-50 md:text-[24px] md:leading-[31px] lg:text-[32px] lg:leading-[40px] lg:tracking-[-0.25px]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</header>
		<?php endif; ?>

		<?php if ( ! empty( $culture_rows ) && is_array( $culture_rows ) ) : ?>
			<div class="culture-rows w-full md:grid md:grid-cols-2 md:gap-x-6 lg:grid lg:grid-cols-1">
				<?php
				foreach ( $culture_rows as $row ) : 
					$row_image       = $row['row_image'] ? $row['row_image'] : null;
					$row_title       = $row['row_title'] ? $row['row_title'] : '';
					$row_description = $row['row_description'] ? $row['row_description'] : '';
					?>
					<div class="culture-card flex w-full gap-4 py-8 lg:py-16 lg:first:pt-0">
						<?php if ( $row_image ) : ?>
							<div class="card-image mb-4 size-[40px] shrink-0 md:size-[48px] lg:mb-0 lg:size-[64px]">
								<?php echo wp_get_attachment_image( $row_image, 'full', false, [ 'class' => 'w-full h-full object-cover object-center rounded-full' ] ); ?>
							</div>
						<?php else : ?>
							<div class="tile-circle aspect-square size-[40px] md:size-[48px] lg:size-[64px]"
							style="background: linear-gradient(180deg, #CB131B 0%, #FFC000 100%);"></div>	
						<?php endif; ?>

						<div class="card-content">
							<?php if ( $row_title ) : ?>
								<h3 class="text-[18px] font-medium leading-[21.6px] md:text-[20px] md:leading-[28px] lg:text-[24px] lg:leading-[31px]">
									<?php echo esc_html( $row_title ); ?>
								</h3>
							<?php endif; ?>

							<?php if ( $row_description ) : ?>
								<p class="text-[14px] font-normal leading-[19.6px] md:text-[16px] md:leading-[22.4px] lg:mt-[6px] lg:text-[18px] lg:leading-[25.2px]">
									<?php echo esc_html( $row_description ); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				<div class="block !h-[1px] bg-ada_gray-20 last:hidden md:hidden lg:block"></div>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
