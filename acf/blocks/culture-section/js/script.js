/* global jQuery gsap ScrollTrigger */

jQuery( function( $ ) {
	gsap.registerPlugin( ScrollTrigger );

	if ( window.innerWidth >= 1024 ) {
		$( '.culture-card' ).each( function() {
			const card = $( this );

			ScrollTrigger.create( {
				trigger: card,
				start: 'top center+=1',
				end: 'bottom center-=1',
				onEnter: () => setActive( card ),
				onEnterBack: () => setActive( card ),
			} );
		} );

		function setActive( activeCard ) {
			gsap.to( '.culture-card', { opacity: 0.3, duration: 0.4, overwrite: true } );
			gsap.to( activeCard, { opacity: 1, duration: 0.4, overwrite: true } );
		}

		gsap.set( '.culture-card', { opacity: 0.3 } );
	}
	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=culture-section', function() {
			ScrollTrigger.refresh();
		} );
	}
} );
