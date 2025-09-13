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
<div class="footer-anim-trigger z-0 h-[409px] md:h-[282px] lg:h-[395px]"></div>
<footer id="colophon" class="fixed bottom-0 left-0 z-10 w-full">
	<div class="relative flex h-[409px] flex-col justify-between bg-ada_red-70 leading-6 text-gray-600 md:h-[282px] lg:h-[395px]">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-bg-dt.jpg' ); ?>" class="absolute left-0 top-0 hidden h-full w-full object-cover object-right-top lg:block">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-bg-tb.png' ); ?>" class="absolute left-0 top-0 hidden h-full w-full object-cover object-right-top md:block lg:hidden">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-footer-bg-mb.jpg' ); ?>" class="absolute left-0 top-0 h-full w-full object-cover object-bottom md:hidden">
		<div class="px-6 md:px-8 lg:px-10 xl:px-20">
			<div class="ff-c-container relative z-10 flex flex-col gap-y-5 py-10 md:py-8 lg:gap-y-10 lg:py-10">
				<div class="site-branding footer-logo mx-auto size-[100px] opacity-0 md:mx-0 lg:size-[160px]">
					<?php
					the_custom_logo();
					?>
				</div>
				<p class="ada-opacity footer-address mx-auto max-w-[296px] text-center text-base text-white md:mx-0 md:text-start">9 Straits View, Marina One West Tower, Singapore 018937</p>
				<nav id="social-menu" class="relative z-50 mx-auto my-auto text-white md:hidden">
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
		<div class="relative z-10 bg-[#d6d6d6]/10 px-6 py-2 md:px-8 lg:px-10 lg:py-3 xl:px-20">
			<div class="ff-c-container footer-bottom ada-opacity flex flex-row justify-between">
				<p class="my-auto max-w-[180px] text-xs text-white md:max-w-full lg:text-base lg:leading-[120%]">© 2025 Apex Digital Academy. All rights reserved.</p>
				<div class="flex">
					<nav id="privacy-menu" class="relative z-50 my-auto mr-2 text-white">
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
						class="my-auto mr-6 hidden md:block" />
					<nav id="social-menu" class="relative z-50 my-auto hidden text-white md:block">
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
<div class="watch-previous-course-popup-wrapper fixed left-1/2 top-1/2 z-[9999999] hidden w-full -translate-x-1/2 -translate-y-1/2 px-6 opacity-0 transition-all duration-300 sm:max-w-[400px] sm:px-0">
	<div class="relative flex flex-col gap-y-6 overflow-hidden rounded-lg bg-white p-6">
		<p class="font-geova font-medium">To ensure a coherent learning progression, it is advisable to review the earlier course before beginning this material</p>
		<div class="options-container flex flex-row justify-end gap-x-6">
			<button class="wpc-continue-btn font-geova font-medium text-ada_red-50">Got It</button>
		</div>
	</div>
</div>
<div
	class="login-popup-wrapper fixed inset-0 z-[9999999] flex hidden items-center justify-center opacity-0 transition-all duration-300 md:left-1/2 md:top-1/2 md:-translate-x-1/2 md:-translate-y-1/2">
	<div class="login-popup-content relative mt-auto flex w-full translate-y-full transform flex-col rounded-t-[8px] bg-white px-6 py-10 transition-transform duration-300 ease-in-out md:mt-0 md:max-w-[550px] md:translate-y-0 md:rounded-lg md:p-8">
		<div class="absolute left-1/2 top-2 h-1 w-12 -translate-x-1/2 rounded-[100px] bg-ada_grey-20 md:hidden"></div>
		<button class="login-close-button hidden justify-end md:flex">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-close-button.svg' ); ?>"
				alt="Close" />
		</button>
		<h4
			class="mb-5 text-[20px] font-medium capitalize leading-[24px] text-ada_red-50 md:mb-6 md:text-[36px] md:leading-[43.2px]">
			Welcome Back
		</h4>
		<form id="loginPopup">
			<div class="login-form mb-8 space-y-5 md:mb-10 md:space-y-8">
				<div class="email-field flex flex-col gap-[2px] md:gap-[6px]">
					<label class="font-geova text-[14px] font-normal capitalize leading-[21px] text-ada_gray-90">Email
						address</label>
					<input placeholder="JohnDoe@gmail.com"
						class="rounded border-ada_gray-30 bg-ada_grey-10 p-2 px-4 pb-[9px] pt-3" type="email" autocomplete="username"
						name="login-email">
				</div>
				<div class="password-field flex flex-col gap-[6px]">
					<label
						class="font-geova text-[14px] font-normal capitalize leading-[21px] text-ada_gray-90">Password</label>
					<input 
						class="rounded border border-ada_gray-30 bg-ada_grey-10 p-2 px-4 pb-[9px] pt-3" type="password"  autocomplete="current-password"
						name="login-password">
				</div>
			</div>

			<div class="login-button ff-button-primary">
				<button type="submit"
					class="block w-full text-center font-geova text-lg font-medium uppercase leading-[21.6px]">
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
