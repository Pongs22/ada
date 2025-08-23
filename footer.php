<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package firstfold
 */

?>

<footer id="colophon" class="relative bg-ada_red-70 leading-6 text-gray-600">
	<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-bg-dt.jpg' ); ?>" class="absolute left-0 top-0 h-full w-full object-cover object-right-top">
	<div class="ff-c-container relative z-10 flex flex-col gap-y-10 py-10">
			<div class="site-branding size-[160px]">
				<?php
				the_custom_logo();
				?>
			</div>
		<p class="max-w-[296px] text-base text-white">9 Straits View, Marina One West Tower, Singapore 018937</p>
	</div>
	<div class="relative z-10 bg-[#d6d6d6]/10 px-8 py-3">
		<div class="ff-c-container flex flex-row justify-between">
			<p class="my-auto text-base leading-[120%] text-white">© 2025 Apex Digital Academy. All rights reserved.</p>
			<div class="h-12"></div>
		</div>
	</div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
