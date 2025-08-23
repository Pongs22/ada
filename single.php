<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package firstfold
 */

get_header();
?>

<main id="primary" class="site-main ">

	<div class="single-article-container">
		<div class="entry-content">
			<?php
			$blocks       = parse_blocks( $post->post_content );
			$block_length = count( $blocks );
			$count        = 1;
			$loop_count   = 1;
			?>

			<?php foreach ( $blocks as $block ) : ?>
				<?php if ( 2 === $count ) : ?>
					<div class="border-t">
						<div class="container mx-auto py-16 ">
							<div class="grid lg:grid-cols-12 mx-auto lg:gap-x-8 ">
								<div class="hidden lg:block lg:col-span-3  relative">
									<div class="table-wrapper sticky top-10 px-4 py-6 bg-gray-100/50 rounded-xl text-lg">
										<p class="label text-lg font-semibold">Table of contents</p>
										<ul class="text-gray-600 gap-y-2 flex flex-col text-base mt-6">
											<?php foreach ( $blocks as $header ) : ?>
												<?php if ( 'core/heading' === $header['blockName'] ) : ?>
												<li><a class="<?php echo esc_attr( 1 === $loop_count ? 'text-gray-900 font-medium' : '' ); ?>" href="#<?php echo esc_html( wp_strip_all_tags( $header['innerContent'][0] ) ); ?>"><?php echo esc_html( wp_strip_all_tags( $header['innerContent'][0] ) ); ?></a></li>
													<?php $loop_count++; ?>
											<?php endif ?>
										<?php endforeach; ?>
										</ul>
									</div>
								</div>
								<div class="lg:col-span-9 post-content">
								<?php endif ?>

								<?php echo wp_kses_post( render_block( $block ) ); ?>

								<?php if ( $count >= $block_length ) : ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>

				<?php $count++; ?>
			<?php endforeach; ?>
		</div>
	</div>
</main><!-- #main -->
</div>
<?php
get_sidebar();
get_footer();
