<?php

/**
 * With Expanding Image Templates.
 *
 * @package firstfold
 */

?>
<?php
$with_icon_list = get_field( 'with_icon_list_layout' );
$wic_link       = $with_icon_list['link'] ?: '';
?>

<div class="with-icon-list bg-white px-5 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-20">
	<div class="ff-c-container grid grid-cols-1 gap-x-6 gap-y-12 2xl:container lg:grid-cols-12">
		<div class="information-container flex flex-col justify-between gap-y-12 lg:col-span-7">
			<header>
				<h2 class="text-ada_red-50 md:max-w-[400px] lg:max-w-[540px]"><?php echo esc_html( $with_icon_list['title'] ); ?></h3>
				<p class="mt-3 max-w-[475px] text-base leading-6 text-ada_gray-90 lg:max-w-[540px] lg:text-lg lg:leading-[140%]"><?php echo esc_html( $with_icon_list['description'] ?: '' ); ?></p>
			</header>
			<?php if ( ! empty( $with_icon_list['icon_list'] ) ) : ?>
				<ul class="icon-list-wrapper grid grid-cols-1 gap-6 md:grid-cols-2">
					<?php
					foreach ( $with_icon_list['icon_list'] as $list ) :
						$list_icon        = $list['icon'];
						$list_title       = $list['title'];
						$list_description = $list['description'];
						?>
						<li class="list-container">
							<?php echo wp_get_attachment_image( $list_icon, 'full', '', [ 'class' => 'size-10' ] ); ?>
							<h4 class="mt-5 !capitalize text-ada_red-50"><?php echo esc_html( $list_title ); ?></h4>
							<div class="mt-1 text-lg leading-6 text-ada_gray-90"><?php echo wp_kses_post( $list_description ); ?></div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="image-container lg:col-span-5">
			<?php echo wp_get_attachment_image( $with_icon_list['image'], 'full', false, array( 'class' => 'h-full w-full shadow-lg' ) ); ?>
		</div>
	</div>
</div>
