/* global jQuery gsap*/
( function( $ ) {
	const initializeMainVideo = function() {
		const mainVideo = document.querySelector( '.ada-main-hero' );
		if ( mainVideo ) {
			const $heroVideoId = '';
			function heroVideoFunction() {
				const videoWrapper = document.querySelectorAll( '.ada-main-hero .player-container' );
				if ( videoWrapper.length > 0 ) {
					if ( window.ytPlayer ) {
						window.ytPlayer.destroy();
					}
					setTimeout( () => {
						$( videoWrapper ).html( `<div id="player" class="transition-all" data-id="${ $heroVideoId }"></div>` );
						gsap.to( videoWrapper, {
							opacity: 1,
							scrollTrigger: {
								trigger: videoWrapper,
								start: 'top-=100% 80%',
								end: 'top-=100% 80%',
								markers: true,
							},
						} );
					}, 10 );
				}
			}

			function playVideo() {
				const videoPlayer = document.querySelector( '.ada-main-hero video' );
				if ( videoPlayer ) {
					setTimeout( () => {
						videoPlayer.play().then( () => {
							heroCoverChange();
						} );
					}, 500 );
				}
			}

			playVideo();
			heroVideoFunction();

			function heroCoverChange() {
				const curtainBar = document.querySelectorAll( '.ada-main-hero .bar-container .bars' );
				const curtainArray = Array.from( curtainBar );

				// Reverse so animation starts from rightmost bar
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
