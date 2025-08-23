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

<<<<<<< HEAD
		<header id="masthead"
			class="site-header sticky left-0 top-0 z-50 w-full border-b bg-white px-6 py-3 md:px-8 lg:px-10">
			<div class="ff-c-container m-auto flex flex-row justify-between">
				<div class="site-branding size-[64px]">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->
=======
	<header id="masthead" class="site-header fixed left-0 top-0 z-50 w-full border-b bg-white px-6 py-3 md:px-8 lg:px-10">
		<div class="ff-c-container m-auto flex flex-row justify-between">
			<div class="site-branding my-auto flex size-12">
				<?php
				the_custom_logo();
				?>
			</div><!-- .site-branding -->
>>>>>>> 4601fff8d0a5615369683849ca2225395d1956e7

				<nav id="site-navigation" class="main-navigation my-auto flex">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'class'          => 'my-auto',
							'menu_class'     => 'flex justify-between  gap-x-5 my-auto',
							'add_li_class'   => '',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->
