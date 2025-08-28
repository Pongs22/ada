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

<main id="primary" class="site-main">
	<div class="mt-[72px] flex flex-row">
		<div class="flex h-screen w-full max-w-[270px] flex-col divide-y divide-ada_gray-20 border-r border-ada_gray-20">
			<?php
			$levels = [ 'basic', 'advance' ];
			foreach ( $levels as $level ) :
				$args = array(
					'post_type'      => 'course',
					'posts_per_page' => -1,             // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
					'orderby'        => 'date',
					'order'          => 'ASC',
					// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
					'tax_query'      => array(
						array(
							'taxonomy' => 'course-type', 
							'field'    => 'slug',
							'terms'    => $level,
						),
					),
				);

				$courses = new WP_Query( $args );

				if ( $courses->have_posts() ) :
					?>
					<?php
					while ( $courses->have_posts() ) :
						$courses->the_post();
						$active_class = ( get_the_ID() === get_queried_object_id() ) ? 'course-active' : '';
						?>
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $active_class ); ?> course-button-container relative flex w-full flex-row gap-x-2 px-4 pb-[14px] pt-[18px]">
							<div class="size-6 shrink-0"></div>
							<p class="font-geova text-lg font-medium leading-[120%] text-ada_gray-90">
								<?php the_title(); ?>
							</p>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;

			endforeach;
			?>
		</div>
		<div class="flex w-full flex-col p-6">
			<div class="mx-auto flex w-full max-w-[1122px] flex-col">
				<?php
				$about             = get_field( 'about', get_the_ID() );
				$professor_name    = get_field( 'professor_name', get_the_ID() );
				$professor_details = get_field( 'professor_details', get_the_ID() );
				?>
				<div class="embed-container relative my-auto w-full overflow-hidden pt-[56.25%]">
					<?php // phpcs:ignore WPThemeReview.ThouShallNotUse.ForbiddenIframe.Found ?>
					<iframe id="player" allow="autoplay" class="!rounded-none lg:!rounded-xl" type="text/html" width="1123" height="650" src="https://www.youtube.com/embed/ucRVDoFkcxc?enablejsapi=1&ref=0&color=white&autoplay=1" frameborder="0"></iframe>
				</div>
				<div class="information-container mt-12 flex flex-col">
					<h2 class="font-medium text-ada_red-50"><?php echo esc_html( get_the_title() ); ?></h2>
					<ul class="mt-12 flex flex-row divide-x divide-[#f5f5f5] bg-[#fafafa]">
						<?php if ( $about ) : ?>
							<li>
								<button class="information-active px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%]">About</button>
							</li>
						<?php endif; ?>
						<?php if ( have_rows( 'skills_gained' ) ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%]">Skills Gained</button>
							</li>
						<?php endif; ?>
						<?php if ( $professor_name && $professor_details ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%]">Professor</button>
							</li>
						<?php endif; ?>
						<?php if ( have_rows( 'downloadable_materials' ) ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%]">Downloadable Materials</button>
							</li>
						<?php endif; ?>
					</ul>
					<div class="info-dynamic-content-container mt-5">
						<p class="text-lg"><?php echo wp_kses_post( $about ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->
</div>
<?php
get_sidebar();
get_footer();
