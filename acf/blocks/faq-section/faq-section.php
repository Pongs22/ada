<?php
/**
 * FAQ Section.
 *
 * @package circles_x
 */

?>
<div class="ff-faq-section overflow-hidden bg-white px-6 py-10 md:px-8 md:py-[60px] lg:px-10 lg:py-20">
	<div class="ff-c-container mx-auto grid grid-cols-1 gap-x-4 gap-y-10 lg:grid-cols-12 lg:gap-y-0">
		<div class="flex flex-col gap-y-2 lg:col-span-5">
			<h3 class="text-center text-ada_red-50 md:mb-0 lg:text-start"><?php echo esc_html( get_field( 'title' ) ); ?></h3>
			<p class="mx-auto max-w-[411px] text-center text-sm text-ada_gray-90 md:text-base lg:mx-0 lg:text-start lg:text-lg"><?php echo esc_html( get_field( 'description' ) ); ?></p>
		</div>
		<div class="faq-container flex flex-col lg:col-span-7">
			<?php if ( have_rows( 'questions' ) ) : ?>
				<?php
				while ( have_rows( 'questions' ) ) :
					the_row();
					?>
					<div class="question border-y  relative -mt-[1px] <?php echo esc_html( 1 === get_row_index() ? 'faq-active' : 'faq-inactive' ); ?>">
						<div class="question-container">
							<button class="relative flex w-full flex-row justify-between gap-x-5 pb-3 pt-5 text-start md:px-5 lg:py-5">
								<h4 class="!capitalize text-ada_gray-90"><?php echo esc_html( get_sub_field( 'question' ) ); ?></h4>
								<img class="plus-icon size-5 md:size-6 <?php echo esc_html( 1 === get_row_index() ? 'hidden' : '' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/frontend/resources/img/ada-plus-icon.svg' ); ?>" width="20" height="20" loading="lazy" alt="Plus">
								<img class="minus-icon size-5 md:size-6 <?php echo esc_html( 1 === get_row_index() ? '' : 'hidden' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/frontend/resources/img/ada-minus-icon.svg' ); ?>" width="20" height="20" loading="lazy" alt="Minus">
							</button>
						</div>
						<div class="answer-container md:px-5 pb-5 -mt-3 <?php echo esc_html( 1 === get_row_index() ? '' : 'hidden' ); ?>">
							<p class="text-sm text-ada_gray-90 md:text-base lg:text-lg"><?php echo esc_html( get_sub_field( 'answer' ) ); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>
		</div>
	</div>
</div>
