/* global jQuery gsap Vimeo*/
( function( $ ) {
	const initializeMainVideo = function() {
		const mainVideo = document.querySelector( '.ada-main-hero' );
		if ( mainVideo ) {
			const $heroVideoId = $( '#heroVideoContainer' ).data( 'id' );
			function heroVideoFunction() {
				const videoWrapper = document.querySelector( '#heroVideoContainer' );
				if ( videoWrapper ) {
					setTimeout( () => {
						$( videoWrapper ).html( `<iframe id="vimeoPlayer" class="scale-[3.5] md:scale-[2.25] lg:scale-[1.2]" width="100%" height="100%"src="https://player.vimeo.com/video/${ $heroVideoId }?autoplay=1&muted=1&loop=1&badge=0&autopause=0&player_id=0&app_id=58479"frameborder="0" allow="autoplay; fullscreen; picture-in-picture"></iframe>` );
						const iframe = document.getElementById( 'vimeoPlayer' );
						const player = new Vimeo.Player( iframe );
						player.on( 'play', () => {
							heroCoverChange();
						} );
					}, 50 );
				}
			}
			heroVideoFunction();

			function heroCoverChange() {
				const curtainBar = document.querySelectorAll( '.ada-main-hero .bar-container .bars' );
				const curtainArray = Array.from( curtainBar );
				const reversedBars = curtainArray.reverse();

				reversedBars.forEach( ( bar, i ) => {
					gsap.to( bar, {
						height: 0,
						duration: 0.75,
						delay: 0.08 * i,
						ease: 'power1.inOut',
					} );
				} );
			}
		}
	};

	$( document ).ready( function() {
		initializeMainVideo();
	} );

	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=ff_hero', initializeMainVideo );
	}
}( jQuery ) );
