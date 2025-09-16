<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package firstfold
 */

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url() );
	exit;
}
get_header();
?>

<?php
global $wpdb;
$user_id       = get_current_user_id();
$course_id     = get_the_ID();
$course_status = '';

if ( $user_id ) {
	$table     = $wpdb->prefix . 'course_progress';
	$cache_key = 'course_status_' . $user_id . '_' . $course_id;
	$course    = wp_cache_get( $cache_key );
	$table     = esc_sql( $table );

	if ( false === $course ) {
		// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared
		$query = $wpdb->prepare( "SELECT * FROM `{$table}` WHERE user_id = %d  AND course_id = %d", $user_id, $course_id );

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared
		$course = $wpdb->get_row( $query, ARRAY_A );

		// phpcs:ignore WordPress.DB.CacheUsage
		wp_cache_set( $cache_key, $course, '', 3600 );
	}
}
?>
<main id="primary" class="site-main course-dashboard" data-user="<?php echo esc_attr( get_current_user_id() ); ?>" data-course="<?php echo esc_attr( get_the_ID() ); ?>" data-progress="<?php echo esc_attr( $course['progress_time'] ?? '' ); ?>" data-status="<?php echo esc_attr( $course['status'] ?? '' ); ?>">
	<div class="mt-[72px] flex flex-row">
		<div class="flex h-screen w-full max-w-[270px] flex-col divide-y divide-ada_gray-20">
			<?php
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
						'terms'    => 'basic',
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
					$courses_id   = get_the_ID();
					global $wpdb;
					$table = $wpdb->prefix . 'course_progress';
					// phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared
					$check_status = $wpdb->get_var( $wpdb->prepare( "SELECT status FROM {$table} WHERE user_id = %d AND course_id = %d", $user_id, $courses_id ) );
					if ( null === $check_status ) {
						$check_status = 'not_started';
					}

					switch ( $check_status ) {
						case 'completed':
							$status_image = '/frontend/resources/img/ada-check-icon.svg';
							break;
						case 'in_progress':
							$status_image = '/frontend/resources/img/ada-inprogress-icon.svg';
							break;
						default:
							$status_image = '';
							break;
					}
					?>
					<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $active_class ); ?> course-button-container relative flex w-full flex-row gap-x-2 px-4 pb-[14px] pt-[18px]">
						<div class="size-6 shrink-0">
							<?php if ( $status_image ) : ?>
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() . $status_image ); ?>" class="h-full w-full">
							<?php endif; ?>
						</div>
						<p class="font-geova text-lg font-medium leading-[120%] text-ada_gray-90">
							<?php the_title(); ?>
						</p>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
			<?php
			$args = array(
				'post_type'          => 'course',
				'posts_per_page'     => -1,             // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_posts_per_page
				'orderby'            => 'date',
				'order'              => 'ASC',
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'tax_query'          => array(
					array(
						'taxonomy' => 'course-type',
						'field'    => 'slug',
						'terms'    => 'advanced',
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
					$courses_id   = get_the_ID();
					global $wpdb;
					$table = $wpdb->prefix . 'course_progress';
					// phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.NotPrepared
					$check_status = $wpdb->get_var( $wpdb->prepare( "SELECT status FROM {$table} WHERE user_id = %d AND course_id = %d", $user_id, $courses_id ) );

					if ( null === $check_status ) {
						$check_status = 'not_started';
					}

					switch ( $check_status ) {
						case 'completed':
							$status_image = '/frontend/resources/img/ada-check-icon.svg';
							break;
						case 'in_progress':
							$status_image = '/frontend/resources/img/ada-inprogress-icon.svg';
							break;
						default:
							$status_image = '';
							break;
					}
					?>
					<?php if ( current_user_can( 'basic' ) ) : ?>
						<button href="<?php the_permalink(); ?>" class="course-button-locked relative flex w-full flex-row gap-x-2 bg-ada_gray-20 px-4 pb-[14px] pt-[18px] opacity-60">
							<div class="check-progress size-6 shrink-0">
									<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-advance-icon.svg' ); ?>" class="h-full w-full">
							</div>
							<p class="font-geova text-lg font-medium leading-[120%] text-ada_gray-90">
								<?php the_title(); ?>
							</p>
						</button>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $active_class ); ?> course-button-container relative flex w-full flex-row gap-x-2 px-4 pb-[14px] pt-[18px]">
							<div class="size-6 shrink-0"></div>
							<p class="font-geova text-lg font-medium leading-[120%] text-ada_gray-90">
								<?php the_title(); ?>
							</p>
						</a>
					<?php endif; ?>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<div class="flex w-full flex-col border-l border-ada_gray-20 p-6">
			<div class="mx-auto flex w-full max-w-[1122px] flex-col">
				<?php
				$vimeo_id          = get_field( 'vimeo_id', get_the_ID() );
				$about             = get_field( 'about', get_the_ID() );
				$professor_name    = get_field( 'professor_name', get_the_ID() );
				$professor_details = get_field( 'professor_details', get_the_ID() );
				$featured_image    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				?>
				<div class="embed-container relative my-auto w-full overflow-hidden rounded-lg pt-[56.25%]" data-video="<?php echo esc_attr( $vimeo_id ); ?>">
					<?php // phpcs:ignore WPThemeReview.ThouShallNotUse.ForbiddenIframe.Found ?>
					<?php if ( ! empty( $course['status'] ) ) : ?>
						<div class="video-container" id="videoContainer"></div>
					<?php endif; ?>
					<div class="bar-container absolute left-0 top-0 z-[5] flex h-full w-full flex-row">
						<?php for ( $bar = 0; $bar < 8; $bar++ ) : ?>
							<div class="relative h-full  w-full <?php echo esc_attr( $bar < 12 ? '' : 'hidden md:block' ); ?>">
								<div class="bars absolute bottom-0 left-0 h-full w-full bg-ada_red-60" style="transition: cubic-bezier(0.71, 0.00, 0.43, 1.00);" ></div>
							</div>
						<?php endfor; ?>
					</div>
					<div class=" <?php echo esc_attr( empty( $course['status'] ) ? 'course-thumbnail-locked' : 'course-thumbnail' ); ?> group absolute left-0 top-0 z-[10] h-full cursor-pointer overflow-hidden rounded-[10px] transition-all duration-300">
						<?php if ( $featured_image ) : ?>
							<img src="<?php echo esc_url( $featured_image ); ?>" class="relative z-[5] h-full w-full object-cover object-center transition-all duration-300 group-hover:brightness-75">
						<?php else : ?>
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-course-thumbnail-placeholder.png' ); ?>" class="relative z-[5] h-full w-full object-cover object-center transition-all duration-300 group-hover:brightness-75">
						<?php endif; ?>
						<div class="absolute left-1/2 top-1/2 z-20 flex size-[150px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10 transition-all duration-300 group-hover:bg-white/60">
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-play-button.svg' ); ?>" alt="Close" class="m-auto w-full max-w-[40px]"/>
						</div>
					</div>
				</div>
				<div class="information-container mt-12 flex flex-col">
					<h2 class="font-medium text-ada_red-50"><?php echo esc_html( get_the_title() ); ?></h2>
					<ul class="course-information-button mt-12 flex flex-row divide-x divide-[#f5f5f5] bg-[#fafafa]">
						<?php if ( $about ) : ?>
							<li>
								<button class="information-active px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%] transition-all duration-300">About</button>
							</li>
						<?php endif; ?>
						<?php if ( have_rows( 'skills_gained' ) ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%] transition-all duration-300">Skills Gained</button>
							</li>
						<?php endif; ?>
						<?php if ( $professor_name && $professor_details ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%] transition-all duration-300">Professor</button>
							</li>
						<?php endif; ?>
						<?php if ( have_rows( 'downloadable_materials' ) ) : ?>
							<li>
								<button class="px-4 pb-[14.5px] pt-[16.5px] font-geova text-[14px] font-medium uppercase leading-[120%] transition-all duration-300">Materials</button>
							</li>
						<?php endif; ?>
					</ul>
					<div class="info-dynamic-content-container mt-5 h-full w-full transition-all">
						<div class="about-info-container">
							<p class="text-lg"><?php echo wp_kses_post( $about ); ?></p>
						</div>
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
