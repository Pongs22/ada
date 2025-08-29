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

<section class="leadership-section p-20">
	<div class="mb-20">
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

	<div class="team-cards space-y-[40px]">
		<?php if ( ! empty( $team_cards ) && is_array( $team_cards ) ) : ?>
			<?php
			foreach ( $team_cards as $card ) :
				$card_heading = $card['card_heading'];
				$card_content = $card['card_content'];
				?>
				<div class="team-card flex justify-between">
					<div class="max-w-[302px]">
						<h2 class="font-medium text-[24px] leading-[31px] text-ada_red-50 uppercase">
							<?php if ( $card_heading ) : ?>
								<?php echo esc_html( $card_heading ); ?>
							<?php endif; ?>
						</h2>
					</div>

					<?php if ( ! empty( $card_conten ) ) : ?>
						<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[24px]">
							<?php
							foreach ( $card_content as $content_row ) :

								$row_image = $content_row['card_image'] ? $content_row['card_image'] : null;
								$row_name  = $content_row['card_name'] ? $content_row['card_name'] : '';
								$row_title = $content_row['card_title'] ? $content_row['card_title'] : '';

								?>
								<div class="max-w-[303px]">
									<div class="card-image min-h-[373px]">
										<?php if ( $row_image ) : ?>
											<img src="<?php echo wp_get_attachment_image( $row_image, 'full', '', [ 'class' => 'mx-auto w-full h-full object-cover object-center' ] ); ?>"
												alt="<?php echo esc_attr( $row_name ?: $card_heading ); ?>">
										<?php else : ?>
											<img src="<?php ff_get_block_asset( 'team-section', 'ada-team-placeholder.png' ); ?>" />
										<?php endif; ?>

									</div>

									<?php if ( $row_name ) : ?>
										<div class="card-name">
											<h4 class="!capitalize font-medium text-[20px]  leading-[28px]">
												<?php echo esc_html( $row_name ); ?>
											</h4>
										</div>
									<?php endif; ?>

									<?php if ( $row_title ) : ?>
										<div class="card-title ">
											<p class="text-[#5C5C5C] font-normal leading-[22.4px]"><?php echo esc_html( $row_title ); ?></p>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>
