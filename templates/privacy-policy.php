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
 * Template Name: Privacy Policy
 *
 * @package firstfold
 */

get_header();
?>

<main id="primary" class="site-main ">

	<div class="privacy-hero">
		<div class="privacy-hero-content">
			<p>Current as of <?php echo get_the_date( 'F Y' ); ?></p>
			<h1><?php the_title(); ?></h1>
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
	<div class="privacy-template">
		<div class="privacy-content">
			<?php
			the_content();
			?>
		</div>
	</div>
</main>

<?php

get_footer();
