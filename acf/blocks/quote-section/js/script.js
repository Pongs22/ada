/* global jQuery gsap SplitType ScrollTrigger*/
( function( $ ) {
	const initializeQuoteSection = function() {
		const target = document.querySelector( '.ff-b-quote-block' );

		if ( target ) {
			initSplitType();
			initScrollAnimation();
		}

		function initSplitType() {
			new SplitType( '.ff-b-quote-block h1', { types: 'lines, words, chars' } );
			let previousWidth = $( window ).width();
			$( window ).on( 'resize', function() {
				const currentWidth = $( window ).width();
				if ( currentWidth !== previousWidth ) {
					previousWidth = currentWidth;
					new SplitType( '.ff-b-quote-block h1', { types: 'lines, words, chars' } );
					initScrollAnimation();
				}
			} );
		}

		function initScrollAnimation() {
			gsap.set( '.ff-b-quote-block .char', { color: '#E07176' } );
			const colorTransition = gsap.fromTo(
				'.ff-b-quote-block .char',
				{ color: '#E07176' },
				{
					color: '#ffffff',
					stagger: { each: 0.1 },
					ease: 'linear',
				}
			);
			ScrollTrigger.create( {
				animation: colorTransition,
				trigger: '.ff-b-quote-block',
				start: 'top 75%',
				end: 'bottom 75%',
				scrub: 2,
			} );
		}
	};

	$( document ).ready( function() {
		initializeQuoteSection();
	} );

	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=quote_section', initializeQuoteSection );
	}
}( jQuery ) );
