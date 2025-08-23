<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Template Name: Page Transition
 *
 * @package firstfold
 */

get_header();
?>
<ul class="transition-container pointer-events-none fixed left-0 top-0 z-[99999] m-0 grid h-screen w-screen grid-rows-10">
	<?php for ( $i = 0; $i < 10; $i++ ) : ?>
		<li class='box-colors flex w-full flex-row transition-all'>
			<?php for ( $j = 0; $j < 4; $j++ ) : ?>
				<div class="random-colors relative">
					<div class="color-contain absolute right-0 top-0 h-full w-0"></div>
				</div>
			<?php endfor; ?>
		</li>
	<?php endfor; ?>
</ul>
<ul class="cascade-transition pointer-events-none absolute left-0 top-0 z-[99999] m-0 grid h-screen w-screen grid-cols-6">
	<?php for ( $i = 0; $i < 6; $i++ ) : ?>
		<li class="relative h-full">
			<div class="curtain absolute left-0 top-0 h-full w-0 bg-indigo-700"></div>
		</li>
	<?php endfor; ?>
</ul>
<div class="dissolve-transition pointer-events-none absolute left-0 top-0 z-[99999] m-0 h-screen w-screen bg-white opacity-0"></div>
<div class="scale-transition pointer-events-none absolute left-0 top-0 z-[99999] m-0 h-screen w-screen bg-indigo-700 opacity-0">
	<div class="relative h-full w-full">
		<div class="scale-wrapper h-full w-full bg-white"></div>
		<div class="text-wrapper absolute left-1/2 top-1/2 flex -translate-x-1/2 -translate-y-1/2 overflow-hidden">
			<h1 class="dynamic-text"><?php echo esc_attr( get_the_title() ); ?></h1>
		</div>
	</div>
</div>
<div class="blinds-transition blinds-wrapper pointer-events-none absolute left-0 top-0 z-[99999] m-0 h-screen w-screen">
	<?php for ( $l = 0; $l < 25; $l++ ) : ?>
		<div class="relative h-full w-full">
			<div class="curtain absolute left-0 top-0 h-0 w-full bg-indigo-700"></div>
		</div>
	<?php endfor; ?>
</div>
<div class="round-swipe-transition pointer-events-none absolute left-0 top-0 z-[99999] m-0 h-screen w-screen overflow-hidden">
	<div class="circle absolute left-1/2 h-[400vw] w-[400vw] -translate-x-1/2 rounded-full bg-indigo-700 opacity-0"></div>
	<div class="text-wrapper absolute left-1/2 top-1/2 flex -translate-x-1/2 -translate-y-1/2 overflow-hidden">
		<h1 class="dynamic-text text-white opacity-0"><?php echo esc_attr( get_the_title() ); ?></h1>
	</div>
</div>
<div class="square-transition pointer-events-none fixed left-0 top-0 z-[99999] m-0 grid h-screen w-full grid-cols-12">
	<?php for ( $ba = 0; $ba < 72; $ba++ ) : ?>
		<div class="box-color h-full w-full opacity-0 transition-all"></div>
	<?php endfor; ?>
</div>
<div class="stagger-blocks-transition pointer-events-none fixed left-0 top-0 z-[99999] m-0 grid h-screen w-full grid-cols-7">
	<?php for ( $blocks = 0; $blocks < 7; $blocks++ ) : ?>
		<div class="relative h-full w-full">
			<div class="curtain absolute bottom-0 left-0 h-0 w-full bg-indigo-700"></div>
		</div>
	<?php endfor; ?>
</div>
<main id="primary" class="site-main rounded-lg border" data-barba="container" data-barba-namespace="<?php echo esc_attr( get_the_title() ); ?>">
	<header class="site-header border-b py-2">
		<div class="container m-auto flex items-center justify-center">
			<nav id="site-navigation" class="main-navigation flex">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'page-transition-nav',
						'menu_id'        => 'page-transition-nav',
						'menu_class'     => 'flex justify-between px-12 gap-x-6',
						'add_li_class'   => '',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
