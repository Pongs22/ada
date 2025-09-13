/* global jQuery Swiper*/
( function( $ ) {
	const initializeTestimonies = function() {
		const testimoniesSection = document.querySelector( '.ff-testimonies-section' );
		if ( testimoniesSection ) {
			// eslint-disable-next-line no-unused-vars
			const swiper = new Swiper( '.ff-testimonies-section .swiper', {
				loop: false,
				spaceBetween: 24,
				slidesPerView: 1,
				direction: 'horizontal',
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				breakpoints: {
					1024: {
						slidesPerView: 2,
					},
				},
			} );
		}
	};
	$( document ).ready( function() {
		initializeTestimonies();
	} );
	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=testimonies_section', initializeTestimonies );
	}
}( jQuery ) );
