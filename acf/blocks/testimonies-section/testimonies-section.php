<?php
/**
 * Testimonies Section
 *
 * @package firstfold
 */

$section     = get_field( 'section_title' );
$testimonies = get_field( 'testimonies' );

?>
<section class="ff-plan-section overflow-hidden px-6 py-10 md:px-8 md:py-[60px] lg:px-10 xl:px-20 lg:py-20 bg-white">
	<article class="ff-c-container">
		<h3 class="ff-section-title max-w-[519px] text-ada_red-50 mb-12">
			<?php echo esc_html( $section ); ?>
		</h3>

		<?php if ( $testimonies ) : ?>
			<div class="flex gap-6 justify-center">
				<?php foreach ( $testimonies as $testimonial ) : ?>
					<div class="flex-1 p-6 bg-ada_grey-30 max-w-[628px]">
						<div class="flex flex-col h-full justify-between">
							<div class="ff-testimonial-quote mb-4">
								<p class="max-w-[568px] text-lg mb-10">
									<?php echo esc_html( $testimonial['testimonial'] ); ?>
								</p>
							</div>
							<div class="ff-testimonial-author flex gap-3 items-center">
								<div class="size-[64px]">
									<?php if ( $testimonial['image'] ) : ?>
										<?php echo wp_get_attachment_image( $testimonial['image'], 'full', '', [ 'class' => 'w-full h-full rounded-full object-cover object-center' ] ); ?>
									<?php else : ?>
										<div class="rounded-full bg-gray-500 w-full h-full">

										</div>
									<?php endif; ?>
								</div>
								<div>
									<h4 class="text-ada_red-50 capitalize">
										<?php echo esc_html( $testimonial['name'] ); ?>
									</h4>
									<p><?php echo esc_html( $testimonial['job_title'] ); ?></p>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="mt-12 flex justify-center" >
				<img src="<?php echo esc_url( ff_get_block_asset( 'testimonies-section', 'ada-swiper-dots.svg' ) ); ?>"
											alt="" class="flex-shrink-0" />

			</div>
		<?php endif; ?>
	</article>
</section>
