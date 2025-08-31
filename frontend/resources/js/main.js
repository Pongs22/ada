/* global jQuery Vimeo ajaxVar Lenis*/

jQuery( function( $ ) {
	if ( ! localStorage.getItem( 'openModal' ) ) {
		localStorage.setItem( 'openModal', true );
	}

	$( '.ff-site-header .menu-item-has-children' ).click( function( e ) {
		e.preventDefault();
		$( '.sub-menu', this ).toggleClass( 'show-sub-menu' );
	} );

	/* --- LENIS CONFIG --- */
	const lenis = new Lenis( {
		duration: 0.55,
		easing: ( t ) => Math.sin( ( t * Math.PI ) / 2 ),
		smoothWheel: true,
		smoothTouch: true,
	} );

	function raf( time ) {
		lenis.raf( time );
		requestAnimationFrame( raf );
	}
	requestAnimationFrame( raf );
	/* ! --- LENIS CONFIG --- */

	// Popup Modal For Locked Courses
	$( '.course-button-locked' ).click( function() {
		$( '.modal-wrapper' ).removeClass( 'hidden' );
		$( '.unlock-next-tier-popup-wrapper' ).removeClass( 'hidden' );
		$( 'html, body' ).addClass( 'overflow-hidden' );
		lenis.stop();
		setTimeout( function() {
			$( '.modal-wrapper' ).removeClass( 'opacity-0' );
			$( '.unlock-next-tier-popup-wrapper' ).removeClass( 'opacity-0' );
		}, 10 );
	} );

	$( '.unt-close' ).click( function() {
		$( '.modal-wrapper' ).addClass( 'opacity-0' );
		$( '.unlock-next-tier-popup-wrapper' ).addClass( 'opacity-0' );
		$( 'html, body' ).removeClass( 'overflow-hidden' );
		setTimeout( function() {
			$( '.modal-wrapper' ).addClass( 'hidden' );
			$( '.unlock-next-tier-popup-wrapper' ).addClass( 'hidden' );
		}, 300 );
	} );

	$( '.primary-login' ).click( function( e ) {
		e.preventDefault();
		$( '.modal-wrapper' ).removeClass( 'hidden' );
		$( '.login-popup-wrapper' ).removeClass( 'hidden' );
		$( 'html, body' ).addClass( 'overflow-hidden' );
		lenis.stop();
		setTimeout( function() {
			$( '.modal-wrapper' ).removeClass( 'opacity-0' );
			$( '.login-popup-wrapper' ).removeClass( 'opacity-0' );
		}, 10 );
	} );

	$( '.login-close-button' ).click( function() {
		$( '.modal-wrapper' ).addClass( 'opacity-0' );
		$( '.login-popup-wrapper' ).addClass( 'opacity-0' );
		$( 'html, body' ).removeClass( 'overflow-hidden' );
		lenis.start();
		setTimeout( function() {
			$( '.modal-wrapper' ).addClass( 'hidden' );
			$( '.login-popup-wrapper' ).addClass( 'hidden' );
		}, 300 );
	} );

	const courseInfoButton = $( '.course-information-button' ).find( 'li button' );

	$( courseInfoButton ).click( function() {
		$( '.course-information-button li button' ).removeClass( 'information-active' );
		$( this ).addClass( 'information-active' );
	} );

	// Video Functions

	let lastSaved = 0;
	let iframe; // Declare iframe variable
	let player; // Declare player variable
	const getUserId = $( '.course-dashboard' ).data( 'user' );
	const getCourseId = $( '.course-dashboard' ).data( 'course' );
	const courseStatus = $( '.course-dashboard' ).data( 'status' );
	const timeProgress = $( '.course-dashboard' ).data( 'progress' );
	const continueWatching = $( '.continue-watching-popup-wrapper' );
	const videoId = $( '.embed-container' ).data( 'video' );
	const seekTime = timeStringToSeconds( timeProgress );

	function createVideoIframe() {
		return `<iframe id="vimeoPlayer" class="!rounded-none lg:!rounded-xl" type="text/html" width="1123" height="650" src="https://player.vimeo.com/video/${ videoId }?badge=0&autopause=0&muted=0&player_id=0&app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"></iframe>`;
	}

	if ( timeProgress && timeProgress !== '0:00' ) {
		if ( localStorage.getItem( 'openModal' ) === 'true' ) {
			$( '.modal-wrapper' ).removeClass( 'hidden' );
			$( continueWatching ).removeClass( 'hidden' );
			$( continueWatching ).find( '.time-progress' ).html( timeProgress );
			$( 'html, body' ).addClass( 'overflow-hidden' );
			$( '.video-container' ).html( createVideoIframe() );
			lenis.stop();
			setTimeout( function() {
				$( '.modal-wrapper' ).removeClass( 'opacity-0' );
				$( continueWatching ).removeClass( 'opacity-0' );
				iframe = $( '#vimeoPlayer' )[ 0 ];
				player = new Vimeo.Player( iframe );
				player.ready().then( function() {
					addPlayerEventListeners();
				} );
				localStorage.setItem( 'openModal', 'false' );
			}, 10 );
		} else {
			$( '.video-container' ).html( createVideoIframe() );
			setTimeout( function() {
				iframe = $( '#vimeoPlayer' )[ 0 ];
				player = new Vimeo.Player( iframe );
				player.ready().then( function() {
					addPlayerEventListeners();
				} );
				if ( player ) {
					player.ready().then( function() {
						return player.setCurrentTime( seekTime );
					} ).then( function() {
						return player.play();
					} );
				}
			}, 10 );
		}
	} else {
		$( '.video-container' ).html( createVideoIframe() );
		iframe = $( '#vimeoPlayer' )[ 0 ];
		player = new Vimeo.Player( iframe );
		player.ready().then( function() {
			addPlayerEventListeners();
		} );
		$( '.course-thumbnail' ).click( function() {
			player.play();
		} );
	}

	$( continueWatching ).find( '.start-over-btn' ).click( function() {
		$( '.modal-wrapper' ).addClass( 'opacity-0' );
		$( continueWatching ).addClass( 'opacity-0' );
		$( 'html, body' ).removeClass( 'overflow-hidden' );
		lenis.start();
		setTimeout( function() {
			$( '.modal-wrapper' ).addClass( 'hidden' );
			$( continueWatching ).addClass( 'hidden' );
		}, 300 );
		$( '.course-thumbnail' ).addClass( 'hidden' );

		if ( player ) {
			player.ready().then( function() {
				player.play();
			} );
		}
	} );

	$( continueWatching ).find( '.continue-btn' ).click( function() {
		$( '.modal-wrapper' ).addClass( 'opacity-0' );
		$( continueWatching ).addClass( 'opacity-0' );
		$( 'html, body' ).removeClass( 'overflow-hidden' );
		lenis.start();
		setTimeout( function() {
			$( '.modal-wrapper' ).addClass( 'hidden' );
			$( continueWatching ).addClass( 'hidden' );
			$( '.course-thumbnail' ).addClass( 'opacity-0' );
		}, 300 );
		$( '.course-thumbnail' ).addClass( 'hidden' );

		if ( player ) {
			player.ready().then( function() {
				return player.setCurrentTime( seekTime );
			} ).then( function() {
				return player.play();
			} );
		}
	} );

	function addPlayerEventListeners() {
		if ( ! player ) {
			return;
		}
		player.on( 'play', function() {
			setTimeout( function() {
				$( '.course-thumbnail' ).addClass( 'hidden' );
			}, 500 );
		} );
		player.on( 'timeupdate', function( data ) {
			if ( data.seconds - lastSaved >= 5 ) {
				lastSaved = data.seconds;
				if ( courseStatus === 'completed' ) {
					return;
				}
				updateCourseTimeProgress( getUserId, getCourseId, formatTime( data.seconds ) );
			}
		} );

		player.on( 'ended', function() {
			updateCourseStatus( getUserId, getCourseId );
		} );
	}

	function updateCourseStatus( userId, courseId ) {
		$.ajax( {
			url: ajaxVar.ajaxUrl,
			type: 'post',
			data: {
				userId,
				courseId,
				action: 'update_course_status',
				nonce: ajaxVar.nonce,
			},
		} );
	}

	function updateCourseTimeProgress( userId, courseId, interval ) {
		$.ajax( {
			url: ajaxVar.ajaxUrl,
			type: 'post',
			data: {
				userId,
				courseId,
				interval,
				action: 'update_course_time_progress',
				nonce: ajaxVar.nonce,
			},
		} );
	}

	function formatTime( seconds ) {
		seconds = Math.floor( seconds );
		const hrs = Math.floor( seconds / 3600 );
		const mins = Math.floor( ( seconds % 3600 ) / 60 );
		const secs = seconds % 60;

		if ( hrs > 0 ) {
			return (
				String( hrs ).padStart( 2, '0' ) + ':' +
				String( mins ).padStart( 2, '0' ) + ':' +
				String( secs ).padStart( 2, '0' )
			);
		}

		return (
			String( mins ).padStart( 2, '0' ) + ':' +
			String( secs ).padStart( 2, '0' )
		);
	}

	function timeStringToSeconds( timeStr ) {
		const parts = timeStr.split( ':' ).map( Number );
		let seconds = 0;

		if ( parts.length === 3 ) {
			seconds = ( parts[ 0 ] * 3600 ) + ( parts[ 1 ] * 60 ) + parts[ 2 ];
		} else if ( parts.length === 2 ) {
			seconds = ( parts[ 0 ] * 60 ) + parts[ 1 ];
		} else if ( parts.length === 1 ) {
			seconds = parts[ 0 ];
		}
		return seconds;
	}
} );
