<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package firstfold
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-barba="wrapper">
	<?php wp_body_open(); ?>
	<div id="page" class="site relative">
		<a class="skip-link screen-reader-text"
			href="#primary"><?php esc_html_e( 'Skip to content', 'firstfold' ); ?></a>
		<header id="masthead" class="site-header fixed left-0 top-0 z-50 w-full border-b bg-white px-6 py-3 md:px-8 lg:px-10">
			<div class="ff-c-container m-auto flex flex-row justify-between">
				<div class="site-branding size-10 lg:size-16">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation my-auto hidden lg:flex">
					<?php if ( ! is_user_logged_in() ) : ?>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'class'          => 'my-auto',
								'menu_class'     => 'primary-menu flex justify-between gap-x-5 my-auto',
							)
						);
						?>
					<?php else : ?>
						<div class="button-container ff-button-primary">
							<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="logout-btn font-geova font-medium uppercase text-white">Log out</a>
						</div>
					<?php endif; ?>
				</nav><!-- #site-navigation -->

				<!-- Burger Button (mobile only) -->
				<button type="button" class="primary-burger my-auto flex flex-col gap-1 lg:hidden">
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-burger-icon.svg' ); ?>"/>
				</button>
			</div>
		</header><!-- #masthead -->

		<!-- Mobile Nav Dropdown -->
		<div class="mobile-nav-wrapper fixed inset-0 z-[9999999] hidden flex-col items-center justify-start opacity-0 transition-all duration-300">
			<div class="mobile-nav-content relative w-full -translate-y-full transform flex-col rounded-b-[8px] bg-white shadow-lg transition-transform duration-300 ease-in-out">
				<div class="absolute bottom-2 left-1/2 h-1 w-12 w-[50px] -translate-x-1/2 rounded-[100px] bg-ada_grey-20 md:hidden"></div>
				<nav class="flex flex-col gap-6 px-6 pb-10 pt-12">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_class'     => 'primary-menu w-full flex flex-col gap-4 text-lg font-medium',
						)
					);
					?>
				</nav>
			</div>
		</div>
