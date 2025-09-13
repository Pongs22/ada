<?php
/**
 * Testimonies Section
 *
 * @package firstfold
 */

$section     = get_field( 'section_title' );
$testimonies = get_field( 'testimonies' );

?>
<section class="ff-testimonies-section overflow-hidden bg-white px-6 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-20 xl:px-20">
	<article class="ff-c-container relative">
		<h3 class="ff-section-title mb-12 max-w-[519px] text-ada_red-50">
			<?php echo esc_html( $section ); ?>
		</h3>
		<?php if ( $testimonies ) : ?>
			<div class="swiper rounded-lg">
				<div class="swiper-wrapper items-stretch">
					<?php foreach ( $testimonies as $testimonial ) : ?>
						<div class="swiper-slide !h-auto rounded-lg bg-ada_grey-30 p-6">
							<div class="flex h-full flex-col justify-between">
								<div class="ff-testimonial-quote mb-4">
									<p class="mb-10 max-w-[568px] text-sm font-medium md:text-base lg:text-lg">
										<?php echo esc_html( $testimonial['testimonial'] ); ?>
									</p>
								</div>
								<div class="ff-testimonial-author flex items-center gap-3">
									<div class="size-10 md:size-12 lg:size-[64px]">
										<?php if ( $testimonial['image'] ) : ?>
											<?php echo wp_get_attachment_image( $testimonial['image'], 'full', '', [ 'class' => 'w-full h-full rounded-full object-cover object-center' ] ); ?>
										<?php else : ?>
											<div class="h-full w-full rounded-full bg-gray-500">
											</div>
										<?php endif; ?>
									</div>
									<div>
										<h4 class="font-semibold capitalize text-ada_red-50">
											<?php echo esc_html( $testimonial['name'] ); ?>
										</h4>
										<p class="text-xs text-ada_gray-50 md:text-sm lg:text-base"><?php echo esc_html( $testimonial['job_title'] ); ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="relative mt-12 h-[10px]">
				<div class="swiper-pagination flex justify-center"></div>
			</div>
		<?php endif; ?>
	</article>
</section>
