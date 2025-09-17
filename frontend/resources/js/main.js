/* global jQuery Vimeo ajaxVar Lenis gsap ScrollTrigger*/

jQuery( function( $ ) {
	if ( ! sessionStorage.getItem( 'openModal' ) ) {
		sessionStorage.setItem( 'openModal', true );
	}

	$( '.logout-btn' ).click( function() {
		sessionStorage.removeItem( 'openModal' );
	} );

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

	const courseInfoButton = $( '.course-information-button' ).find( 'li button' );

	$( courseInfoButton ).click( function() {
		$( '.course-information-button li button' ).removeClass( 'information-active' );
		$( this ).addClass( 'information-active' );
	} );

	/* --- VIDEO CONFIGURATIONS --- */
	let lastSaved = 0;
	let iframe;
	let player;
	const getUserId = $( '.course-dashboard' ).data( 'user' );
	const getCourseId = $( '.course-dashboard' ).data( 'course' );
	const courseStatus = $( '.course-dashboard' ).data( 'status' );
	const timeProgress = $( '.course-dashboard' ).data( 'progress' );
	const continueWatching = $( '.continue-watching-popup-wrapper' );
	const videoId = $( '.embed-container' ).data( 'video' );
	const seekTime = timeStringToSeconds( timeProgress );
	const videoContainer = document.querySelector( '#videoContainer' );

	function createVideoIframe() {
		return `<iframe id="vimeoPlayer" class="!rounded-none lg:!rounded-xl" type="text/html" width="1123" height="650" src="https://player.vimeo.com/video/${ videoId }?badge=0&autopause=0&muted=0&player_id=0&app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"></iframe>`;
	}

	if ( timeProgress && timeProgress !== '0:00' ) {
		if ( sessionStorage.getItem( 'openModal' ) === 'true' ) {
			$( continueWatching ).find( '.time-progress' ).html( timeProgress );
			$( videoContainer ).html( createVideoIframe() );
			popupModalFadeIn( continueWatching );
			setTimeout( function() {
				iframe = $( '#vimeoPlayer' )[ 0 ];
				player = new Vimeo.Player( iframe );
				player.ready().then( function() {
					addPlayerEventListeners();
				} );
				sessionStorage.setItem( 'openModal', 'false' );
			}, 10 );
		} else {
			$( videoContainer ).html( createVideoIframe() );
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
	} else if ( videoContainer ) {
		$( videoContainer ).html( createVideoIframe() );
		iframe = $( '#vimeoPlayer' )[ 0 ];
		player = new Vimeo.Player( iframe );
		player.ready().then( function() {
			addPlayerEventListeners();
		} );
		$( '.course-thumbnail' ).click( function() {
			player.play();
			$( '.course-thumbnail' ).addClass( 'opacity-0' );
			setTimeout( function() {
				$( '.course-thumbnail' ).addClass( 'hidden' );
			}, 500 );
		} );
	} else {
		$( '.course-thumbnail-locked' ).click( function() {
			popupModalFadeIn( '.watch-previous-course-popup-wrapper' );
		} );
		$( '.wpc-continue-btn' ).click( function() {
			popupModalFadeOut( '.watch-previous-course-popup-wrapper' );
		} );
	}

	function addPlayerEventListeners() {
		if ( ! player ) {
			return;
		}
		player.on( 'play', function() {
			$( '.course-thumbnail' ).addClass( 'opacity-0' );
			const curtainBar = document.querySelectorAll( '.bar-container .bars' );
			const curtainArray = Array.from( curtainBar );
			const reversedBars = curtainArray.reverse();
			reversedBars.forEach( ( bar, i ) => {
				gsap.to( bar, {
					height: 0,
					duration: 0.3,
					delay: 0.05 * i,
					ease: 'power1.inOut',
				} );
			} );
			setTimeout( function() {
				$( '.course-thumbnail' ).addClass( 'hidden' );
				$( '.bar-container' ).addClass( 'hidden' );
			}, 1000 );
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
		if ( ! timeStr ) {
			return;
		}

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
	/* --- VIDEO CONFIGURATIONS --- */
	/* --- POPUP CONFIGURATIONS --- */
	//Pop up animations.
	function popupModalFadeIn( modal ) {
		$( '.modal-wrapper' ).removeClass( 'hidden' );
		$( modal ).removeClass( 'hidden' ).addClass( 'is-open' );
		$( 'html, body' ).addClass( 'overflow-hidden' );
		lenis.stop();
		setTimeout( function() {
			$( '.modal-wrapper' ).removeClass( 'opacity-0' );
			$( modal ).removeClass( 'opacity-0' );
		}, 10 );
	}

	function popupModalFadeOut( modal ) {
		$( '.modal-wrapper' ).addClass( 'opacity-0' );
		$( modal ).addClass( 'opacity-0' ).removeClass( 'is-open' );
		$( 'html, body' ).removeClass( 'overflow-hidden' );
		lenis.start();
		setTimeout( function() {
			$( '.modal-wrapper' ).addClass( 'hidden' );
			$( modal ).addClass( 'hidden' );
		}, 300 );
	}

	function closeSpecificModal( modal ) {
		$( modal ).addClass( 'opacity-0' ).removeClass( 'is-open' );

		setTimeout( () => {
			$( modal ).addClass( 'hidden' );

			// Check if any other modals are still open
			const openModals = $(
				'.login-popup-wrapper.is-open, .continue-watching-popup-wrapper.is-open, .unlock-next-tier-popup-wrapper.is-open, .watch-previous-course-popup-wrapper.is-open, .mobile-nav-wrapper.is-open' );

			// Only hide backdrop and restore scroll if no other modals are open
			if ( openModals.length === 0 ) {
				$( '.modal-wrapper' ).addClass( 'opacity-0' );
				$( 'html, body' ).removeClass( 'overflow-hidden' );
				lenis.start();

				setTimeout( () => {
					$( '.modal-wrapper' ).addClass( 'hidden' );
				}, 300 );
			}
		}, 300 );
	}

	$( '.course-button-locked' ).click( function() {
		popupModalFadeIn( '.unlock-next-tier-popup-wrapper' );
	} );

	$( '.unt-close' ).click( function() {
		popupModalFadeOut( '.unlock-next-tier-popup-wrapper' );
	} );

	$( '.primary-login' ).click( function( e ) {
		e.preventDefault();
		resetLoginErrors();
		popupModalFadeIn( '.login-popup-wrapper' );
		setTimeout( function() {
			$( '.login-popup-content' ).css( 'transform', '' ).removeClass( 'translate-y-full' ).addClass( 'translate-y-0' );
		}, 10 );
	} );

	function closeLoginPopup() {
		popupModalFadeOut( '.login-popup-wrapper' );
		$( '.login-popup-content' ).removeClass( 'translate-y-0' ).addClass( 'translate-y-full' );
		resetLoginErrors();
	}
	$( '.login-close-button' ).click( closeLoginPopup );

	$( window ).on( 'resize', function() {
		if ( $( '.login-popup-wrapper' ).hasClass( 'is-open' ) ) {
			$( '.modal-wrapper' ).removeClass( 'hidden opacity-0' );
			$( '.login-popup-wrapper' ).removeClass( 'hidden opacity-0' );
			$( '.login-popup-content' ).css( 'transform', '' ).removeClass( 'translate-y-full' ).addClass( 'translate-y-0' );
		}
	} );

	let startY = 0;
	let currentY = 0;
	let isDragging = false;

	$( '.login-popup-content' ).on( 'touchstart', function( e ) {
		startY = e.touches[ 0 ].clientY;
		isDragging = true;
		$( this ).css( 'transition', 'none' );
	} );

	$( '.login-popup-content' ).on( 'touchmove', function( e ) {
		if ( ! isDragging ) {
			return;
		}
		currentY = e.touches[ 0 ].clientY - startY;
		if ( currentY > 0 ) {
			$( this ).css( 'transform', `translateY(${ currentY }px)` );
		}
	} );

	$( '.login-popup-content' ).on( 'touchend', function() {
		isDragging = false;
		$( this ).css( 'transition', 'transform 0.3s ease-in-out' );

		if ( currentY > 100 ) {
			closeLoginPopup();
		} else {
			$( this ).css( 'transform', 'translateY(0)' );
		}

		startY = 0;
		currentY = 0;
	} );

	$( continueWatching ).find( '.start-over-btn' ).click( function() {
		popupModalFadeOut( continueWatching );
		$( '.course-thumbnail' ).addClass( 'opacity-0' );
		setTimeout( function() {
			$( '.course-thumbnail' ).addClass( 'hidden' );
		}, 500 );
		if ( player ) {
			player.ready().then( function() {
				player.play();
			} );
		}
	} );

	$( continueWatching ).find( '.continue-btn' ).click( function() {
		popupModalFadeOut( continueWatching );
		$( '.course-thumbnail' ).addClass( 'opacity-0' );
		setTimeout( function() {
			$( '.course-thumbnail' ).addClass( 'hidden' );
		}, 500 );
		if ( player ) {
			player.ready().then( function() {
				return player.setCurrentTime( seekTime );
			} ).then( function() {
				return player.play();
			} );
		}
	} );
	/* --- POPUP CONFIGURATIONS --- */
	/* --- LOGIN CONFIGURATIONS --- */

	function resetLoginErrors() {
		const $form = $( '#loginPopup' );
		const $email = $form.find( 'input[name="login-email"]' );
		const $password = $form.find( 'input[name="login-password"]' );
		const $emailLabel = $form.find( 'label[for="login-email"]' );
		const $passwordLabel = $form.find( 'label[for="login-password"]' );

		// Remove error messages
		$form.find( '.login-error' ).remove();

		// Reset input styles
		$email.removeClass( 'border-red-500' );
		$password.removeClass( 'border-red-500' );
		$emailLabel.removeClass( 'text-red-500' );
		$passwordLabel.removeClass( 'text-red-500' );
	}

	$( '#loginPopup' ).on( 'submit', function( e ) {
		e.preventDefault();
		const $form = $( this );
		const $email = $form.find( 'input[name="login-email"]' );
		const $password = $form.find( 'input[name="login-password"]' );
		const $emailLabel = $form.find( 'label[for="login-email"]' );
		const $passwordLabel = $form.find( 'label[for="login-password"]' );
		const $btn = $form.find( 'button[type="submit"]' );
		const $error = $form.find( '.login-error' );
		const $btnText = $btn.find( '.login-btn' );
		const $loader = $btn.find( '.loader' );

		$error.remove();
		$email.removeClass( 'border-red-500' );
		$password.removeClass( 'border-red-500' );
		$emailLabel.removeClass( 'text-red-500' );
		$passwordLabel.removeClass( 'text-red-500' );

		const emailVal = $email.val().trim();
		const passwordVal = $password.val();

		if ( ! /^[^@]+@[^@]+\.[^@]+$/.test( emailVal ) ) {
			$email.addClass( 'border-red-500' );
			$emailLabel.addClass( 'text-red-500' );
			$email.after( '<div class="login-error mt-1 text-sm text-red-500">Please enter a valid email address.</div>' );
			return;
		}

		if ( ! passwordVal ) {
			$password.addClass( 'border-red-500' );
			$passwordLabel.addClass( 'text-red-500' );
			$password.after( '<div class="login-error mt-1 text-sm text-red-500">Please enter your password.</div>' );
			return;
		}

		$btn.prop( 'disabled', true );
		$btnText.addClass( 'hidden' );
		$loader.removeClass( 'hidden' );

		loginFunction( emailVal, passwordVal, function( errorType, errorMsg ) {
			$btn.prop( 'disabled', false );
			$btnText.removeClass( 'hidden' );
			$loader.addClass( 'hidden' );
			if ( errorType === 'user' ) {
				$email.addClass( 'border-red-500' );
				$emailLabel.addClass( 'text-red-500' );
				$email.after( '<div class="login-error mt-1 text-sm text-red-500">' + errorMsg + '</div>' );
			} else if ( errorType === 'password' ) {
				$password.addClass( 'border-red-500' );
				$passwordLabel.addClass( 'text-red-500' );
				$password.after( '<div class="login-error mt-1 text-sm text-red-500">' + errorMsg + '</div>' );
			}
		}, $btn, $btnText, $loader );
	} );
	function loginFunction( username, password, errorCallback, $btn ) {
		// TODO: add loading animation in the button
		$.ajax( {
			url: ajaxVar.ajaxUrl,
			type: 'post',
			data: {
				action: 'custom_login_function',
				nonce: ajaxVar.nonce,
				username,
				password,
			},
			success( response ) {
				$btn.prop( 'disabled', false );

				if ( response.success ) {
					window.location.href = '/course/testimonies/';
				} else {
					errorCallback( response.data.type, response.data.message );
				}
			},
			error( ) {
				errorCallback( 'user', 'An error occurred. Please try again.' );
			},
		} );
	}

	/* --- LOGIN CONFIGURATIONS --- */

	/* --- Footer Animation --- */
	gsap.registerPlugin( ScrollTrigger );

	const footerTl = gsap.timeline( {
		scrollTrigger: {
			trigger: '.footer-anim-trigger',
			start: 'top 80%',
			end: 'top 80%',
			toggleActions: 'play none none none',
		},
	} );

	footerTl
		.to( '.footer-logo', { opacity: 1, duration: 0.4 } )
		.to( '.footer-address', { opacity: 1, duration: 0.2 }, '+=0.05' )
		.to( '.footer-bottom', { opacity: 1, duration: 0.2 }, '+=0.1' );

	// 404 Page Countdown
	if ( $( 'body' ).hasClass( 'error404' ) ) {
		let countdownTime = 10;
		const $countdown = $( '.countdown-404' );
		$countdown.text( countdownTime );

		const interval = setInterval( function() {
			countdownTime--;
			$countdown.text( countdownTime );

			if ( countdownTime <= 0 ) {
				clearInterval( interval );
				window.location.href = '/';
			}
		}, 1000 );
	}

	//Navbar popdown
	$( '.primary-burger' ).click( function( e ) {
		e.preventDefault();
		popupModalFadeIn( '.mobile-nav-wrapper' );
		setTimeout( function() {
			$( '.mobile-nav-content' )
				.css( 'transform', '' )
				.removeClass( '-translate-y-full' )
				.addClass( 'translate-y-0' );
		}, 10 );
	} );

	function closeMobileNav() {
		closeSpecificModal( '.mobile-nav-wrapper' );
		$( '.mobile-nav-content' ).removeClass( 'translate-y-0' ).addClass( '-translate-y-full' );
	}

	// Close on click outside
	$( '.mobile-nav-wrapper' ).click( function( e ) {
		if ( $( e.target ).closest( '.mobile-nav-content' ).length === 0 ) {
			closeMobileNav();
		}
	} );

	// Touch drag handling
	$( '.mobile-nav-content' ).on( 'touchstart', function( e ) {
		startY = e.touches[ 0 ].clientY;
		isDragging = true;
		$( this ).css( 'transition', 'none' );
	} );

	$( window ).on( 'resize', function() {
		if ( window.innerWidth >= 768 ) {
			if ( $( '.mobile-nav-wrapper' ).hasClass( 'is-open' ) ) {
				closeSpecificModal( '.mobile-nav-wrapper' );
				$( '.mobile-nav-content' )
					.removeClass( 'translate-y-0' )
					.addClass( '-translate-y-full' );
			}
		}
	} );

	$( '.mobile-nav-content .menu-item' ).click( function() {
		closeSpecificModal( '.mobile-nav-wrapper' );
		$( '.mobile-nav-content' ).removeClass( 'translate-y-0' ).addClass( '-translate-y-full' );
	} );

	$( '.mobile-nav-content' ).on( 'touchmove', function( e ) {
		if ( ! isDragging ) {
			return;
		}

		currentY = e.touches[ 0 ].clientY - startY;

		if ( currentY < 0 ) {
			$( this ).css( 'transform', `translateY(${ currentY }px)` );
		}
	} );

	$( '.mobile-nav-content' ).on( 'touchend', function() {
		isDragging = false;
		$( this ).css( 'transition', 'transform 0.3s ease-in-out' );

		if ( currentY < -100 ) {
			closeMobileNav();
		} else {
			$( this ).css( 'transform', 'translateY(0)' );
		}

		startY = 0;
		currentY = 0;
	} );

	const $sidebar = $( '.sidebar-content' );
	let scrollTimeout;

	$sidebar.on( 'wheel', function( e ) {
		const atTop = this.scrollTop === 0;
		const atBottom = this.scrollHeight - this.scrollTop === this.clientHeight;
		if ( ! ( ( e.originalEvent.deltaY < 0 && atTop ) || ( e.originalEvent.deltaY > 0 && atBottom ) ) ) {
			e.stopPropagation();
		}
	} );

	$sidebar.on( 'scroll', function() {
		$sidebar.addClass( 'scrolling' );
		clearTimeout( scrollTimeout );
		scrollTimeout = setTimeout( () => {
			$sidebar.removeClass( 'scrolling' );
		}, 500 );
	} );
} );
