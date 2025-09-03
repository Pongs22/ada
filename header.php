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
				<div class="site-branding size-16">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation my-auto flex">
					<?php if ( ! is_user_logged_in() ) : ?>
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
					<?php else : ?>
						<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="logout-btn rounded-[2px] bg-ada_red-50 px-4 pb-3 pt-[14px] font-geova font-medium uppercase text-white">Log out</a>
					<?php endif; ?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->
