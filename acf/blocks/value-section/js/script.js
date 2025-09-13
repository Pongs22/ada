/* global jQuery gsap ScrollTrigger */

jQuery( function( $ ) {
	gsap.registerPlugin( ScrollTrigger );

	$( '.value-section' ).each( function( index, section ) {
		gsap.from( $( section ).find( '.header-content' ), {
			scrollTrigger: {
				trigger: section,
				start: 'top 80%',
				toggleActions: 'play none none none',
			},
			opacity: 0,
			y: -30,
			duration: 0.6,
			ease: 'power2.out',
		} );

		gsap.from( $( section ).find( '.tiles-content .tiles' ), {
			scrollTrigger: {
				trigger: section,
				start: 'top 75%',
				toggleActions: 'play none none none',
			},
			opacity: 0,
			duration: 0.4,
			stagger: 0.2,
			ease: 'power2.out',
		} );
	} );

	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=value-section', function() {
			ScrollTrigger.refresh();
		} );
	}
} );
