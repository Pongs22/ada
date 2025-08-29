/* global jQuery Vimeo ajaxVar*/

jQuery( function( $ ) {
	$( '.ff-site-header .menu-item-has-children' ).click( function( e ) {
		e.preventDefault();
		$( '.sub-menu', this ).toggleClass( 'show-sub-menu' );
	} );

	// Popup Modal For Locked Courses
	$( '.course-button-locked' ).click( function() {
		$( '.modal-wrapper' ).removeClass( 'hidden' );
		$( '.unlock-next-tier-popup-wrapper' ).removeClass( 'hidden' );
		$( 'html, body' ).addClass( 'overflow-hidden' );
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

	const courseInfoButton = $( '.course-information-button' ).find( 'li button' );

	$( courseInfoButton ).click( function() {
		$( '.course-information-button li button' ).removeClass( 'information-active' );
		$( this ).addClass( 'information-active' );
	} );

	// Video Functions
	const iframe = $( '#vimeoPlayer' );

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

	let lastSaved = 0;
	const getUserId = $( '.course-dashboard' ).data( 'user' );
	const getCourseId = $( '.course-dashboard' ).data( 'course' );
	const courseStatus = $( '.course-dashboard' ).data( 'status' );
	const player = new Vimeo.Player( iframe );

	player.ready().then( function() {
		player.on( 'loaded', function() {
			player.play();
		} );
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
} );
