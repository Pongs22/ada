<?php
/**
 * With Expanding Image Templates.
 *
 * @package firstfold
 */

?>
<?php
$simple_cta  = get_field( 'simple_cta_layout' );
$simple_link = $simple_cta['link'] ?: '';
?>

<div class="simple-cta-layout bg-[#fafafa] px-6 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-10 xl:px-20">
	<div class="ff-c-container flex flex-row justify-between gap-x-6 gap-y-12">
		<header class="w-full max-w-[517px]">
			<h3 class="text-ada_red-50 md:max-w-[400px] lg:max-w-[540px]"><?php echo esc_html( $simple_cta['title'] ); ?></h3>
			<p class="mt-1 text-base leading-6 text-ada_gray-90 lg:text-lg lg:leading-[140%]"><?php echo esc_html( $simple_cta['description'] ?: '' ); ?></p>
		</header>

		<?php if ( $simple_link ) : ?>
			<div class="link-container ff-button-secondary my-auto flex">
				<a class="block rounded-sm border-[1.5px] border-ada_red-50 px-4 pb-3 pt-[14px] font-geova text-lg font-medium uppercase text-ada_red-50" href="<?php echo esc_url( $simple_link['url'] ?? '#' ); ?>" target="<?php echo esc_attr( $simple_link['target'] ?? '' ); ?>"> <?php echo esc_html( $simple_link['title'] ?? '' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</div>
