/* global jQuery*/
( function( $ ) {
	const initializeFAQ = function() {
		const faqQuestion = document.querySelector( '.ff-faq-section' );
		if ( faqQuestion ) {
			$( '.question-container button' ).on( 'click', function () {
				const $question = $( this ).closest( '.question' );
				const $answer = $question.find('.answer-container');
				$question.siblings().addClass( 'faq-inactive' ).removeClass( 'faq-active' );
				$question.siblings().find('.answer-container').stop().slideUp();
				$question.siblings().find( '.plus-icon' ).removeClass( 'hidden' );
				$question.siblings().find( '.minus-icon' ).addClass( 'hidden' );
				$question.find( '.plus-icon' ).toggleClass( 'hidden' );
				$question.find( '.minus-icon' ).toggleClass( 'hidden' );
				$question.toggleClass( 'faq-active' ).toggleClass( 'faq-inactive' );
				$answer.stop().slideToggle();
			} );
		}
	};

	$( document ).ready( function() {
		initializeFAQ();
	} );

	if ( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=faq_section', initializeFAQ );
	}
}( jQuery ) );
