<?php
/**
 * GL Hero Section - Full Height Background Layout.
 *
 * @package greydientlab
 */

?>
<?php
$full_width_image = get_field( 'full_with_image_layout' );
$main_title       = $full_width_image['caption'];
$description      = $full_width_image['description'];
$bg_image_dt      = $full_width_image['background_image_dt'];
$bg_image_tb      = $full_width_image['background_image_tb'];
$bg_image_mb      = $full_width_image['background_image_mb'];

?>
<div class="ada-main-hero relative mt-[65px] overflow-hidden lg:mt-[88px]">
	<?php echo wp_get_attachment_image( $bg_image_dt, 'full', false, array( 'class' => 'absolute hidden lg:block top-0 left-0 w-full aspect-[1440/550] z-10' ) ); ?>
	<?php echo wp_get_attachment_image( $bg_image_tb, 'full', false, array( 'class' => 'absolute top-0 hidden sm:block lg:hidden left-0 w-full aspect-[768/650] z-10' ) ); ?>
	<?php echo wp_get_attachment_image( $bg_image_mb, 'full', false, array( 'class' => 'absolute top-0 sm:hidden left-0 w-full aspect-[375/450] z-10' ) ); ?>
	<div class="relative z-10 flex aspect-[375/450] sm:aspect-[768/650] sm:p-8 lg:aspect-[1440/550] lg:p-10 xl:p-20">
		<div class="ff-c-container my-auto flex w-full">
			<div class="card-container mt-auto w-full bg-ada_red-70/70 p-4 backdrop-blur-[20px] sm:my-auto sm:max-w-[391px] sm:rounded-lg sm:p-6 lg:max-w-[517px] lg:p-8">
				<h1 class="!font-medium text-white"><?php echo esc_html( $main_title ); ?></h1>
				<p class="mt-1 text-sm text-white sm:text-base lg:text-lg"><?php echo wp_kses_post( $description ); ?></p>
			</div>
		</div>
	</div>
</div>
