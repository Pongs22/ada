<?php
/**
 * Plan Section
 *
 * @package firstfold
 */

$section_title    = get_field( 'section_title' );
$plan_cards       = get_field( 'plan_card' );
$background_image = get_field( 'background_image' );
?>

<section
	class="ff-plan-section relative overflow-hidden aspect-[1440/704] h-full px-6 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-20">
	<?php if ( $background_image ) : ?>
		<?php
		echo wp_get_attachment_image(
			$background_image,
			'full',
			false,
			[
				'class' => 'absolute inset-0 w-full h-full object-cover object-center -z-10',
			]
		);
		?>
	<?php endif; ?>
	<article class="ff-c-container mx-auto z-20">
		<h2 class="ff-section-title text-center mb-[72px] text-white"><?php echo esc_html( $section_title ); ?></h2>
		<div class="ff-plan-cards flex gap-[24px] justify-center">
			<?php if ( $plan_cards ) : ?>
				<?php foreach ( $plan_cards as $card ) : ?>
					<div
						class="ff-plan-card p-12 border first:bg-white/10 first:backdrop-blur-[10px] first:text-white last:bg-white  border-gray-200 rounded-lg max-w-[410px] min-h-[432px]">
						<h3 class="ff-plan-card-title font-medium text-[32px] leading-[40px] tracking-[-0.25px]">
							<?php echo esc_html( $card['plan_type'] ); ?>
						</h3>
						<p
							class="ff-plan-card-description mb-12 text-lg font-normal leading-[21.6px] <?php echo ( end( $plan_cards ) === $card ) ? 'text-ada_gray-50' : 'text-ada_gray-20'; ?>">
							<?php echo esc_html( $card['plan_description'] ); ?>
						</p>
						<ul class="ff-course-list space-y-3">
							<?php if ( $card['course_list'] ) : ?>
								<?php foreach ( $card['course_list'] as $course ) : ?>
									<li class="flex items-center gap-3">
										<img src="<?php echo esc_url( ff_get_block_asset( 'plan-section', ( end( $plan_cards ) === $card ) ? 'ada-advance-check-icon.svg' : 'ada-basic-check-icon.svg' ) ); ?>"
											alt="" class="size-6 flex-shrink-0" />
										<span class="leading-[22.4px]"><?php echo esc_html( $course['course_details'] ); ?></span>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</article>

</section>
