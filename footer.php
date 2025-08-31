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
	<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-bg-dt.jpg' ); ?>"
		class="absolute left-0 top-0 h-full w-full object-cover object-right-top">
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
			<div class="flex">
				<nav id="privacy-menu" class="relative z-50 my-auto mr-2 px-4 text-white">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'privacy-menu',
							'menu_id'        => 'privacy-menu',

						)
					);
					?>
				</nav>
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-divider.svg' ); ?>"
					class="my-auto mr-6" />
				<nav id="social-menu" class="relative z-50 my-auto text-white">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'social-menu',
							'menu_id'        => 'social-menu',
							'menu_class'     => 'flex gap-4',
						)
					);
					?>
				</nav>
			</div>


		</div>
	</div>
</footer><!-- #colophon -->

<div class="modal-wrapper fixed left-0 top-0 z-[999999] hidden h-[100svh] h-screen w-screen bg-black/60 opacity-0 transition-all duration-300"></div>
<div class="unlock-next-tier-popup-wrapper fixed left-1/2 top-1/2 z-[9999999] hidden w-full -translate-x-1/2 -translate-y-1/2 px-6 opacity-0 transition-all duration-300 sm:max-w-[500px] sm:px-0">
	<div class="relative flex flex-col overflow-hidden rounded-lg bg-white sm:flex-row">
		<button class="unt-close absolute right-5 top-5 text-ada_gray-90">Close</button>
		<div class="image-container h-full w-full">
			<div class="h-[313px] w-full bg-ada_gray-20"></div>
		</div>
		<div class="information-container max-[272px] w-full p-6">
			<h4 class="font-medium text-ada_red-50">Upgrade your career with this advance course.</h4>
			<ul class="mt-4 flex flex-col gap-y-2">
				<li class="text-sm">Unlock current and upcoming courses. </li>
				<li class="text-sm">Unlock current and upcoming courses. </li>
			</ul>
			<div class="link-container my-auto mt-5 flex">
				<a class="block w-full rounded-sm border-[1.5px] border-ada_red-50 px-4 pb-3 pt-[14px] text-center font-geova text-lg font-medium uppercase text-ada_red-50" href="#">Upgrade Now</a>
			</div>
		</div>
	</div>
</div>
<div class="continue-watching-popup-wrapper fixed left-1/2 top-1/2 z-[9999999] hidden w-full -translate-x-1/2 -translate-y-1/2 px-6 opacity-0 transition-all duration-300 sm:max-w-[400px] sm:px-0">
	<div class="relative flex flex-col gap-y-8 overflow-hidden rounded-lg bg-white p-6">
		<p class="font-geova font-medium">Continue watching at <span class="time-progress inline-block font-montserrat font-medium text-ada_red-50"> 0:35 </span>?</p>
		<div class="options-container flex flex-row justify-end gap-x-6">
			<button class="start-over-btn font-geova font-medium text-ada_gray-90">Start Over</button>
			<button class="continue-btn font-geova font-medium text-ada_red-50">Continue</button>
		</div>
	</div>
</div>
<div
	class="login-popup-wrapper fixed inset-0 hidden opacity-0 z-[9999999] flex items-center justify-center md:left-1/2 md:top-1/2 md:-translate-x-1/2 md:-translate-y-1/2">
	<div class="login-popup-content relative flex flex-col w-full md:max-w-[550px] bg-white md:p-8 px-6 py-10 transform translate-y-full md:translate-y-0 ease-in-out transition-transform duration-300 
		md:rounded-lg rounded-t-[8px] mt-auto md:mt-0">
		<div class="absolute top-2 left-1/2 -translate-x-1/2 w-12 h-1 rounded-[100px] bg-ada_grey-20 md:hidden"></div>
		<button class="login-close-button hidden md:flex justify-end">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-close-button.svg' ); ?>"
				alt="Close" />
		</button>
		<h4
			class="font-medium text-[20px] md:text-[36px] md:leading-[43.2px] leading-[24px] text-ada_red-50 md:mb-6 mb-5 capitalize">
			Welcome Back
		</h4>
		<form>
			<div class="login-form md:space-y-8 space-y-5 md:mb-10 mb-8">
				<div class="email-field flex flex-col md:gap-[6px] gap-[2px]">
					<label class="capitalize font-geova leading-[21px] text-[14px] font-normal text-ada_gray-90">Email
						address</label>
					<input placeholder="JohnDoe@gmail.com"
						class="bg-ada_grey-10 px-4 pt-3 pb-[9px] border-ada_gray-30 p-2 rounded" type="email"
						name="login-email">
				</div>
				<div class="password-field flex flex-col gap-[6px]">
					<label
						class="capitalize font-geova leading-[21px] text-[14px] font-normal text-ada_gray-90">Password</label>
					<input placeholder="JohnDoe@gmail.com"
						class="bg-ada_grey-10 px-4 pt-3 pb-[9px] border border-ada_gray-30 p-2 rounded" type="password"
						name="login-password">
				</div>
			</div>

			<div class="login-button">
				<button type="submit"
					class="block w-full rounded-[2px] border-ada_red-50 bg-ada_red-50 px-4 md:pt-[14px] pt-3 md:pb-3 pb-[8px] text-white text-center text-[14px] md:text-[18px] font-medium uppercase leading-[21.6px]">
					Log in
				</button>
			</div>
		</form>
	</div>
</div>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
