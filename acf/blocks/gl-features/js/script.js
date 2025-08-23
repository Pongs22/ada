/* global jQuery Swiper*/
( function( $ ) {
// all functions is equivalent to each template. You can just copy the specific function based on your needs.
	const initializeWithExpandingImage = function() {
		const withExpandingImage = document.querySelector( '.with-expanding-images' );
		if ( withExpandingImage ) {
			$( '.with-expanding-images' ).on( 'mouseenter', '.wei-repeater-images', function() {
				const siblings = $( this ).siblings();
				$( siblings ).removeClass( 'flex-[50%]' ).addClass( 'flex-[25%]' );
				$( this ).addClass( 'flex-[50%]' ).removeClass( 'flex-[25%]' );
			} );
			const prevButton = $( '.ff-b-features-section ' ).find( '.with-expanding-images .button-container .button-prev' ).get( 0 );
			const nextButton = $( '.ff-b-features-section ' ).find( '.with-expanding-images .button-container .button-next' ).get( 0 );
			const weiSwiper = new Swiper( '.swiper', {
				loop: false,
				slidesPerView: 'auto',
				centeredSlides: false,
				allowTouchMove: true,
				spaceBetween: 16,
				speed: 300,
				navigation: {
					nextEl: [ nextButton ],
					prevEl: [ prevButton ],
				},
			} );

			$( '.li-button-container .cursor-pointer' ).on( 'click', function() {
				$( this ).siblings().removeClass( 'bg-indigo-500' ).addClass( 'bg-gray-200' );
				$( this ).addClass( 'bg-indigo-500' ).removeClass( 'bg-gray-200' );
				const imageID = $( this ).data( 'id' );
				weiSwiper.slideTo( imageID );
			} );

			function changeListState( button ) {
				$( button ).on( 'click', function() {
					const activeImage = $( '.with-expanding-images .swiper-slide-active' ).data( 'id' );
					const listbutton = $( '.li-button-container .cursor-pointer' );
					$( listbutton ).removeClass( 'bg-indigo-500' ).addClass( 'bg-gray-200' );
					$( listbutton[ activeImage - 1 ] ).addClass( 'bg-indigo-500' ).removeClass( 'bg-gray-200' );
				} );
			}
			changeListState( prevButton );
			changeListState( nextButton );
		}
	};

	$( document ).ready( function() {
		initializeWithExpandingImage();
	} );

	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=ff_features', initializeWithExpandingImage );
	}
}( jQuery ) );
