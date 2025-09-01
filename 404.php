<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package firstfold
 */

get_header();
?>

<main id="primary" class="site-main page-404 mt-[73px]">
	<section class="error-404 not-found">
		<div class="flex items-center justify-center min-h-[calc(100vh-73px)]">
			<div
				class="lg:aspect-[1400/900] md:aspect-[768/1024] h-screen px-6 md:px-0 w-full flex flex-col items-center justify-center relative overflow-hidden">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/frontend/resources/img/ada-404-bg.png' ); ?>"
					alt="404 background" class="absolute inset-0 w-full h-full object-cover -z-10" />
				<div class="max-w-[557px] mx-auto text-center relative z-10">
					<span
						class="text-ada_yellow-60 font-medium lg:text-[80px] lg:leading-[96px] md:text-[48px] md:leading-[57.6px] text-[32px] leading-[40px] tracking-[-0.25px]">404</span>
					<h3
						class="uppercase text-white lg:text-[64px] lg:tracking-[-0.64px] md:text-[48px] md:tracking-[-0.48px] text-[32px] leading-[40px] tracking-[-0.25px] w-full font-medium leading-normal">
						Page not found
					</h3>
					<p class="text-white mb-8 md:text-lg text-[16px] font-normal md:leading-[27px] leading-[24px]">
						Sorry, the page you were looking for might be renamed, removed, or might not exist on the
						website.
					</p>

					<?php
					use Lean\Load;

					Load::atom(
						'buttons/button',
						array(
							'ff_btn_size'   => 'btn-md',
							'ff_btn_type'   => 'btn-secondary',
							'ff_btn_text'   => 'Back to home',
							'ff_btn_click'  => home_url( '/' ),
							'ff_is_rounded' => false,
						)
					);
					?>
				</div>

				<div class="absolute bottom-[40px] md:bottom-[80px] left-1/2 -translate-x-1/2 z-10">
					<p class="text-white font-normal md:leading-[27px] md:text-lg text-[16px] leading-[24px]">
						Returning Home in <span class="text-ada_yellow-50 font-bold countdown-404">10</span>
					</p>
				</div>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();
