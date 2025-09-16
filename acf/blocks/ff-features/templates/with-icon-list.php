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

<div class="with-icon-list bg-white p-0 md:px-8 md:py-[60px] lg:px-20 lg:py-10">
	<div class="ff-c-container flex flex-col gap-6 rounded-[20px] bg-[#f5f5f5] px-6 py-10 md:gap-10 md:px-6 md:py-8 lg:flex-row lg:gap-x-10 lg:p-10 xl:p-20">
		<div class="information-container flex w-full flex-col justify-between lg:flex-1">
			<header class="mb-6 lg:mb-12">
				<h2 class="text-ada_red-50 md:max-w-[400px] lg:max-w-[540px]"><?php echo esc_html( $with_icon_list['title'] ); ?></h2>
				<p class="mt-3 max-w-[475px] text-sm leading-6 text-ada_gray-90 md:text-base lg:max-w-[540px] lg:text-lg lg:leading-[140%]"><?php echo esc_html( $with_icon_list['description'] ?: '' ); ?></p>
				<?php if ( $wic_link ) : ?>
				<div class="link-container my-auto mt-6 flex">
					<a class="block rounded-sm border-[1.5px] border-ada_red-50 px-4 pb-3 pt-[14px] font-geova text-lg font-medium uppercase text-ada_red-50" href="<?php echo esc_url( $wic_link['url'] ?? '#' ); ?>" target="<?php echo esc_attr( $wic_link['target'] ?? '' ); ?>"> <?php echo esc_html( $wic_link['title'] ?? '' ); ?></a>
				</div>
				<?php endif; ?>
			</header>

			<?php if ( ! empty( $with_icon_list['icon_list'] ) ) : ?>
				<ul class="icon-list-wrapper hidden flex-col gap-6 lg:flex 2xl:flex-row">
					<?php foreach ( $with_icon_list['icon_list'] as $list ) : ?>
					<li class="list-container">
						<?php if ( $list['icon'] ) : ?>
							<?php echo wp_get_attachment_image( $list['icon'], 'full', '', [ 'class' => 'size-16 ' ] ); ?>
					<?php elseif ( $is_preview ) : ?>
						<img src="<?php echo esc_url( ff_get_block_asset( 'ff-features', 'gl-c-arrow-left.svg' ) ); ?>" alt="icon"> 
					<?php endif; ?>
					<h4 class="mt-5 text-lg !capitalize text-ada_red-50 lg:text-xl"><?php echo esc_html( $list['title'] ); ?></h4>
					<div class="mt-1 w-full max-w-[438px] text-sm leading-6 text-ada_gray-90 md:text-base lg:text-lg"><?php echo wp_kses_post( $list['description'] ); ?></div>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="content-section flex flex-col gap-6 md:flex-row"> 
			<div class="image-container order-1 w-full md:order-2 md:flex-1 lg:max-w-[519px]">
				<?php echo wp_get_attachment_image( $with_icon_list['image'], 'full', false, array( 'class' => 'w-full shadow-lg object-cover object-center rounded-[8px]' ) ); ?>
			</div>
			<?php if ( ! empty( $with_icon_list['icon_list'] ) ) : ?>
				<ul class="icon-list-wrapper order-2 mt-auto flex flex-col gap-8 md:order-1 md:flex-1 md:pr-6 lg:hidden">
					<?php foreach ( $with_icon_list['icon_list'] as $list ) : ?>
					<li class="list-container">
						<?php if ( $list['icon'] ) : ?>
							<?php echo wp_get_attachment_image( $list['icon'], 'full', '', [ 'class' => 'size-10 md:size-12' ] ); ?>
					<?php elseif ( $is_preview ) : ?>
						<img src="<?php echo esc_url( ff_get_block_asset( 'ff-features', 'gl-c-arrow-left.svg' ) ); ?>" alt="icon"> 
					<?php endif; ?>
					<h4 class="mt-4 text-lg !capitalize text-ada_red-50 lg:text-xl"><?php echo esc_html( $list['title'] ); ?></h4>
					<div class="mt-1 w-full max-w-[438px] text-sm leading-6 text-ada_gray-90 lg:text-lg"><?php echo wp_kses_post( $list['description'] ); ?></div>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
