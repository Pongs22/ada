<?php
/**
 * Greydient Lab Quote Block.
 * 
 * @package circles_x
 */

$quote = get_field( 'quote' );
$style = $block['className'] ?? '';
?>
<div class="ff-b-quote-block bg-ada_red-50 px-6 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-20 xl:px-20">
	<div class="ff-c-container">
		<h1 class="w-full text-[24px] leading-[125%] tracking-[-1%] text-red-400 md:text-[32px] md:leading-[125%] lg:max-w-[1000px] lg:text-[40px] lg:leading-[125%]"><?php echo esc_html( $quote ); ?></h1>
	</div>
</div>
