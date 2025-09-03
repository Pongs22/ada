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

<section class="leadership-section px-6 md:px-8 lg:px-10 xl:px-20">
	<div class="mb-10">
		<h2 class="font-medium uppercase leading-[40px] tracking-[-0.25px] text-ada_red-50">
			<?php if ( $section_title ) : ?>
				<?php echo esc_html( $section_title ); ?>
			<?php endif; ?>
		</h2>
		<div class="section-text max-w-[595px] text-[18px] font-normal leading-[25.2px]">
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
				<div class="team-card flex flex-col gap-[24px] py-10 lg:flex-row lg:justify-between lg:gap-0">
					<div class="max-w-[302px]">
						<h2 class="text-[24px] font-medium uppercase leading-[31px] text-ada_red-50">
							<?php if ( $card_heading ) : ?>
								<?php echo esc_html( $card_heading ); ?>
							<?php endif; ?>
						</h2>
					</div>

					<?php if ( ! empty( $card_content ) ) : ?>

						<div class="-mr-6 md:-mr-8 lg:-mr-0">
							<div class="no-scrollbar overflow-x-auto">
								<div class="flex gap-x-3 md:gap-x-4 lg:grid lg:grid-cols-3 lg:gap-x-6">
									<?php
									foreach ( $card_content as $content_row ) :

										$row_image = $content_row['card_image'] ? $content_row['card_image'] : null;
										$row_name  = $content_row['card_name'] ? $content_row['card_name'] : '';
										$row_title = $content_row['card_title'] ? $content_row['card_title'] : '';
										?>
										<div class="max-w-[224px] flex-shrink-0 md:max-w-[249px] lg:max-w-[302px]">
											<div
												class="card-image relative mb-4 aspect-[224/264] md:mb-6 md:aspect-[249/293] lg:mb-5 lg:aspect-[302/357]">
												<?php if ( $row_image ) : ?>
													<div class="relative h-full w-full">
														<?php echo wp_get_attachment_image( $row_image, 'full', '', [ 'class' => 'w-full h-full object-cover object-center' ] ); ?>
														<div class="card-icon absolute bottom-2.5 right-2.5">
															<img class="size-4 md:size-6 lg:size-8"
																src="<?php echo esc_url( ff_get_block_asset( 'team-section', 'ada-social-icon.png' ) ); ?>"
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
													<h4 class="text-[20px] font-medium !capitalize leading-[28px]">
														<?php echo esc_html( $row_name ); ?>
													</h4>
												</div>
											<?php endif; ?>

											<?php if ( $row_title ) : ?>
												<div class="card-title">
													<p class="font-normal leading-[22.4px] text-[#5C5C5C]">
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
