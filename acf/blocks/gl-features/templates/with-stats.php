<?php
/**
 * With Stats.
 *
 * @package firstfold
 */

?>

<?php
$label          = get_field( 'with_stats_subtext' );
$main_title     = get_field( 'with_stats_title' ) ?: 'Your Title Here';
$description    = get_field( 'with_stats_description' ) ?: 'Your Description Here';
$featured_image = get_field( 'with_stats_image' );

?>

<div class="with-stats mx-auto max-w-7xl py-12 sm:py-12">
	<div class="mx-auto grid grid-cols-1 gap-y-10 px-6 md:grid-cols-2 md:gap-x-10 lg:gap-x-[64px] lg:px-8">
		<div class="image-container overflow-hidden rounded-md">
			<?php echo wp_get_attachment_image( $featured_image, 'full', '', array( 'class' => ' w-full h-full aspect-[553/500] object-cover object-center' ) ); ?>
		</div>
		<div class="text-container flex flex-col justify-between">
			<div class="text-container">
				<?php if ( $label ) : ?>
					<p class="mb-2 text-base font-semibold leading-7 text-indigo-600"><?php echo esc_html( $label ); ?></p>
				<?php endif; ?>
				<h2 class="mb-5 text-3xl font-bold tracking-tight lg:text-4xl"><?php echo esc_html( $main_title ); ?></h2>
				<p class="text-lg leading-8 md:mt-7"><?php echo wp_kses_post( $description ); ?></p>
			</div>
			<?php if ( have_rows( 'with_stats_repeater' ) ) : ?>
				<ul class="mt-6 flex flex-row gap-x-8 lg:mt-[64px]">
					<?php 
					while ( have_rows( 'with_stats_repeater' ) ) :
						the_row();
						$value       = get_sub_field( 'value' ) ?: '000';
						$suffix      = get_sub_field( 'suffix' ) ?: '%';
						$description = get_sub_field( 'description' ) ?: 'Your Description Here';
						?>
						<li>
							<h1 class="value mb-3 text-3xl text-indigo-500 lg:text-4xl"><?php echo esc_html( $value ); ?><?php echo esc_html( $suffix ); ?></h1>
							<p class="description font-semibold"><?php echo wp_kses_post( $description ); ?></p>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
