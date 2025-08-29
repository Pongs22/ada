<?php
/**
 * Leadership Section
 *
 * @package firstfold
 */

$section_title    = get_field( 'section_title' );
$background_image = get_field( 'background_image' );
$leader_name      = get_field( 'leader_name' );
$leader_title     = get_field( 'leader_title' );
$leader_bio       = get_field( 'leader_bio' );
$leader_socials   = get_field( 'leader_socials' );
?>

<section class="leadership-section ff-c-container py-10 px-20">
	<h2 class="font-medium leading-[40px] tracking-[-0.25px] text-ada_red-50 mb-[48px] uppercase">
		<?php if ( $section_title ) : ?>
			<?php echo esc_html( $section_title ); ?>
		<?php endif; ?>
	</h2>

	<article class="leadership-item">
		<div class="p-20  mb-[48px]  rounded-[20px] relative overflow-hidden">

			<?php if ( $background_image ) : ?>
				<?php echo wp_get_attachment_image( $background_image, 'full', false, [ 'class' => 'absolute inset-0 w-full h-full object-cover object-center' ] ); ?>
			<?php endif; ?>

			<div class="relative z-10 max-w-[663px]">
				<?php if ( $leader_name ) : ?>
					<h1 class="leadership-name text-[40px] text-white leading-[48px] tracking-[-0.4px]">
						<?php echo esc_html( $leader_name ); ?>
					</h1>
				<?php endif; ?>

				<?php if ( $leader_title ) : ?>
					<h3 class="leadership-title text-[24px] mb-[52px] font-semibold leading-[31px] text-ada_yellow-50">
						<?php echo esc_html( $leader_title ); ?>
					</h3>
				<?php endif; ?>

				<?php if ( $leader_bio ) : ?>
					<div class="max-w-[612px] text-[18px] leading-[25.2px] text-white font-normal">
						<p class="leadership-bio">
							<?php echo wp_kses_post( $leader_bio ); ?>
						</p>
					</div>
				<?php endif; ?>
				<?php if ( $leader_socials ) : ?>
					<div class="socials-container flex gap-6 mt-10">
						<?php
						foreach ( $leader_socials as $social ) :
							$social_icon = $social['icon'];
							$social_link = $social['link'];
							?>
							<div class="social-item">
								<?php if ( $social['icon'] ) : ?>
									<div>
										<?php echo wp_get_attachment_image( $social_icon, 'full', false, [ 'class' => 'social-icon' ] ); ?>
									</div>
								<?php endif; ?>
								<?php if ( $social_link ) : ?>
									<a href="<?php echo esc_url( $social_link['url'] ); ?>" class="social-link">
										<?php echo esc_html( $social_link['title'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</article>
</section>
