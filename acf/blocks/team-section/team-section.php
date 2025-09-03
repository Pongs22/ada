<?php
/**
 * Team Section 
 *
 * @package firstfold
 */

$section_title = get_field( 'section_heading' );
$section_text  = get_field( 'section_text' );
$team_cards    = get_field( 'team_cards' );
?>

<section class="leadership-section lg:px-10 md:px-8 px-6">
	<div class="mb-10">
		<h2 class="font-medium leading-[40px] tracking-[-0.25px] text-ada_red-50 uppercase">
			<?php if ( $section_title ) : ?>
				<?php echo esc_html( $section_title ); ?>
			<?php endif; ?>
		</h2>
		<div class="section-text text-[18px] font-normal leading-[25.2px] max-w-[595px] ">
			<?php if ( $section_text ) : ?>
				<?php echo esc_html( $section_text ); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="team-cards divide-y-2">
		<?php if ( ! empty( $team_cards ) && is_array( $team_cards ) ) : ?>
			<?php
			foreach ( $team_cards as $card ) :
				$card_heading = $card['card_heading'];
				$card_content = $card['card_content'];
				?>
				<div class="team-card flex flex-col lg:flex-row gap-[24px] lg:gap-0 lg:justify-between py-[44px]">
					<div class="max-w-[302px]">
						<h2 class="font-medium text-[24px] leading-[31px] text-ada_red-50 uppercase">
							<?php if ( $card_heading ) : ?>
								<?php echo esc_html( $card_heading ); ?>
							<?php endif; ?>
						</h2>
					</div>

					<?php if ( ! empty( $card_content ) ) : ?>

						<div class="-mr-6 md:-mr-8 lg:-mr-0">
							<div class="overflow-x-auto no-scrollbar">
								<div class="flex lg:grid lg:grid-cols-3 md:gap-x-6 gap-x-4">
									<?php
									foreach ( $card_content as $content_row ) :

										$row_image = $content_row['card_image'] ? $content_row['card_image'] : null;
										$row_name  = $content_row['card_name'] ? $content_row['card_name'] : '';
										$row_title = $content_row['card_title'] ? $content_row['card_title'] : '';
										?>
										<div class="flex-shrink-0 lg:max-w-[302px] md:max-w-[249px] max-w-[224px]">
											<div
												class="card-image lg:aspect-[302/357] md:aspect-[249/293] aspect-[224/264] relative lg:mb-5 md:mb-6 mb-4">
												<?php if ( $row_image ) : ?>
													<div class="relative w-full h-full">
														<?php echo wp_get_attachment_image( $row_image, 'full', '', [ 'class' => 'w-full h-full object-cover object-center' ] ); ?>
														<div class="card-icon absolute bottom-2.5 right-2.5">
															<img class="lg:size-8 md:size-6 size-4"
																src="<?php echo esc_url( ff_get_block_asset( 'team-section', 'ada-social-icon.svg' ) ); ?>"
																alt="social icon" />
														</div>
													</div>
												<?php else : ?>
													<img src="<?php echo esc_url( ff_get_block_asset( 'team-section', 'ada-team-placeholder.png' ) ); ?>"
														alt="placeholder" />
												<?php endif; ?>
											</div>

											<?php if ( $row_name ) : ?>
												<div class="card-name">
													<h4 class="!capitalize font-medium text-[20px] leading-[28px]">
														<?php echo esc_html( $row_name ); ?>
													</h4>
												</div>
											<?php endif; ?>

											<?php if ( $row_title ) : ?>
												<div class="card-title">
													<p class="text-[#5C5C5C] font-normal leading-[22.4px]">
														<?php echo esc_html( $row_title ); ?>
													</p>
												</div>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>




					<?php endif; ?>

				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>
