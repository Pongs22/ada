<?php
/**
 * GL Hero Section - Full Height Background Layout.
 *
 * @package greydientlab
 */

?>
<?php
$hero_background_image = get_field( 'hero_background_image' );
$hero_caption          = get_field( 'hero_caption' );
$hero_description      = get_field( 'hero_description' );
$hero_link             = get_field( 'link' );
$video                 = get_field( 'video_id' ) ?: '';
$is_video              = get_field( 'use_video' );

?>
<div class="ada-main-hero relative overflow-x-clip">
	<div class="mx-auto h-full lg:p-0">
		<div class="bg-primary10 relative flex aspect-[375/600] h-full flex-col flex-wrap overflow-hidden md:aspect-square md:px-8 md:py-8 lg:aspect-[1440/700] lg:px-10">
			<div class="ff-c-container relative z-20 !mt-auto flex w-full md:!my-auto">
				<div class="absolute bottom-0 left-0 mr-auto flex w-full transform flex-col gap-y-1 bg-ada_red-70/70 p-4 backdrop-blur-[40px] md:static md:my-0 md:max-w-[473px] md:translate-x-0 md:translate-y-0 md:rounded-lg md:p-5 lg:max-w-[597px] lg:p-8">
					<?php if ( $hero_caption ) : ?>
						<h1 class="gl-fadein text-white"><?php echo esc_html( $hero_caption ); ?></h1>
					<?php elseif ( $is_preview ) : ?>
						<h1 class="gl-fadein text-white">Your Title Here</h1>
					<?php endif; ?>
					<?php if ( $hero_description ) : ?>
						<p class="gl-fadein text-sm font-normal leading-[140%] text-white md:text-base md:leading-[150%] lg:text-lg lg:leading-[150%]"><?php echo esc_html( $hero_description ); ?></p>
					<?php elseif ( $is_preview ) : ?>
						<p class="gl-fadein font-normal leading-[140%] text-white md:text-base md:leading-[150%] lg:text-lg lg:leading-[150%]">Your Description Here</p>
					<?php endif; ?>
					<?php if ( $hero_link ) : ?>
						<div class="button-container gl-fadein flex">
							<a href="<?php echo esc_url( $hero_link['url'] ?: '#' ); ?>" target="<?php echo esc_attr( $hero_link['target'] ?: '' ); ?>" class="gl-a-button bg-primary50 w-auto text-lg uppercase text-white">
								<div class="a-wrapper relative z-10 flex w-auto flex-row gap-x-2 px-4 py-2.5">
									<p class="text-sm leading-4 text-white md:text-base md:leading-5 lg:text-lg lg:leading-6"><?php echo esc_attr( $hero_link['title'] ?: 'Button Text' ); ?></p>
									<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/metabit-img-placeholder.png' ); ?>" class="relative z-10 my-auto size-4">
								</div>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $is_video && $video ) : ?>
				<div class="hero-video-container absolute left-0 top-0 h-full w-full" id="heroVideoContainer" data-id="<?php echo esc_attr( $video ); ?>"></div>
				<div class="bar-container absolute left-0 top-0 z-[11] flex h-full w-full flex-row">
					<?php for ( $bar = 0; $bar < 8; $bar++ ) : ?>
						<div class="relative h-full  w-full <?php echo esc_attr( $bar < 12 ? '' : 'hidden md:block' ); ?>">
							<div class="bars absolute bottom-0 left-0 h-full w-full bg-ada_red-60" style="transition: cubic-bezier(0.71, 0.00, 0.43, 1.00);" ></div>
						</div>
					<?php endfor; ?>
				</div>
			<?php else : ?>
				<div class="absolute left-0 top-0 h-screen w-screen">
					<?php echo wp_get_attachment_image( $hero_background_image, 'full', false, array( 'class' => 'mx-auto w-full h-full object-cover object-center' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
