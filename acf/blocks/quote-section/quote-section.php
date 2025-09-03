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
		<h1 class="w-full max-w-[1000px] text-[40px] tracking-[-1%] text-red-400"><?php echo esc_html( $quote ); ?></h1>
	</div>
</div>
