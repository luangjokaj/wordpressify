jQuery( function ( $ ) {
	var mshotRemovalTimer = null;
	var mshotSecondTryTimer = null
	var mshotThirdTryTimer = null
	
	$('.akismet-status').each(function () {
		var thisId = $(this).attr('commentid');
		$(this).prependTo('#comment-' + thisId + ' .column-comment');
	});
	$('.akismet-user-comment-count').each(function () {
		var thisId = $(this).attr('commentid');
		$(this).insertAfter('#comment-' + thisId + ' .author strong:first').show();
	});

	akismet_enable_comment_author_url_removal();
	
	$( '#the-comment-list' ).on( 'click', '.akismet_remove_url', function () {
		var thisId = $(this).attr('commentid');
		var data = {
			action: 'comment_author_deurl',
			_wpnonce: WPAkismet.comment_author_url_nonce,
			id: thisId
		};
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: data,
			beforeSend: function () {
				// Removes "x" link
				$("a[commentid='"+ thisId +"']").hide();
				// Show temp status
				$("#author_comment_url_"+ thisId).html( $( '<span/>' ).text( WPAkismet.strings['Removing...'] ) );
			},
			success: function (response) {
				if (response) {
					// Show status/undo link
					$("#author_comment_url_"+ thisId)
						.attr('cid', thisId)
						.addClass('akismet_undo_link_removal')
						.html(
							$( '<span/>' ).text( WPAkismet.strings['URL removed'] )
						)
						.append( ' ' )
						.append(
							$( '<span/>' )
								.text( WPAkismet.strings['(undo)'] )
								.addClass( 'akismet-span-link' )
						);
				}
			}
		});

		return false;
	}).on( 'click', '.akismet_undo_link_removal', function () {
		var thisId = $(this).attr('cid');
		var thisUrl = $(this).attr('href');
		var data = {
			action: 'comment_author_reurl',
			_wpnonce: WPAkismet.comment_author_url_nonce,
			id: thisId,
			url: thisUrl
		};
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: data,
			beforeSend: function () {
				// Show temp status
				$("#author_comment_url_"+ thisId).html( $( '<span/>' ).text( WPAkismet.strings['Re-adding...'] ) );
			},
			success: function (response) {
				if (response) {
					// Add "x" link
					$("a[commentid='"+ thisId +"']").show();
					// Show link. Core strips leading http://, so let's do that too.
					$("#author_comment_url_"+ thisId).removeClass('akismet_undo_link_removal').text( thisUrl.replace( /^http:\/\/(www\.)?/ig, '' ) );
				}
			}
		});

		return false;
	});

	// Show a preview image of the hovered URL. Applies to author URLs and URLs inside the comments.
	$( '#the-comment-list' ).on( 'mouseover', 'a[id^="author_comment_url"], tr.pingback td.column-author a:first-of-type, td.comment p a', function () {
		clearTimeout( mshotRemovalTimer );

		if ( $( '.akismet-mshot' ).length > 0 ) {
			if ( $( '.akismet-mshot:first' ).data( 'link' ) == this ) {
				// The preview is already showing for this link.
				return;
			}
			else {
				// A new link is being hovered, so remove the old preview.
				$( '.akismet-mshot' ).remove();
			}
		}

		clearTimeout( mshotSecondTryTimer );
		clearTimeout( mshotThirdTryTimer );

		var thisHref = encodeURIComponent( $( this ).attr( 'href' ) );

		var mShot = $( '<div class="akismet-mshot mshot-container"><div class="mshot-arrow"></div><img src="//s0.wordpress.com/mshots/v1/' + thisHref + '?w=450" width="450" height="338" class="mshot-image" /></div>' );
		mShot.data( 'link', this );

		var offset = $( this ).offset();

		mShot.offset( {
			left : Math.min( $( window ).width() - 475, offset.left + $( this ).width() + 10 ), // Keep it on the screen if the link is near the edge of the window.
			top: offset.top + ( $( this ).height() / 2 ) - 101 // 101 = top offset of the arrow plus the top border thickness
		} );

		mshotSecondTryTimer = setTimeout( function () {
			mShot.find( '.mshot-image' ).attr( 'src', '//s0.wordpress.com/mshots/v1/'+thisHref+'?w=450&r=2' );
		}, 6000 );

		mshotThirdTryTimer = setTimeout( function () {
			mShot.find( '.mshot-image' ).attr( 'src', '//s0.wordpress.com/mshots/v1/'+thisHref+'?w=450&r=3' );
		}, 12000 );

		$( 'body' ).append( mShot );
	} ).on( 'mouseout', 'a[id^="author_comment_url"], tr.pingback td.column-author a:first-of-type, td.comment p a', function () {
		mshotRemovalTimer = setTimeout( function () {
			clearTimeout( mshotSecondTryTimer );
			clearTimeout( mshotThirdTryTimer );

			$( '.akismet-mshot' ).remove();
		}, 200 );
	} );

	$('.checkforspam:not(.button-disabled)').click( function(e) {
		e.preventDefault();

		$('.checkforspam:not(.button-disabled)').addClass('button-disabled');
		$('.checkforspam-spinner').addClass( 'spinner' ).addClass( 'is-active' );

		// Update the label on the "Check for Spam" button to use the active "Checking for Spam" language.
		$( '.checkforspam .akismet-label' ).text( $( '.checkforspam' ).data( 'active-label' ) );

		akismet_check_for_spam(0, 100);
	});

	var spam_count = 0;
	var recheck_count = 0;

	function akismet_check_for_spam(offset, limit) {
		// Update the progress counter on the "Check for Spam" button.
		$( '.checkforspam-progress' ).text( $( '.checkforspam' ).data( 'progress-label-format' ).replace( '%1$s', offset ) );

		$.post(
			ajaxurl,
			{
				'action': 'akismet_recheck_queue',
				'offset': offset,
				'limit': limit
			},
			function(result) {
				recheck_count += result.counts.processed;
				spam_count += result.counts.spam;
				
				if (result.counts.processed < limit) {
					window.location.href = $( '.checkforspam' ).data( 'success-url' ).replace( '__recheck_count__', recheck_count ).replace( '__spam_count__', spam_count );
				}
				else {
					// Account for comments that were caught as spam and moved out of the queue.
					akismet_check_for_spam(offset + limit - result.counts.spam, limit);
				}
			}
		);
	}
	
	if ( "start_recheck" in WPAkismet && WPAkismet.start_recheck ) {
		$( '.checkforspam' ).click();
	}
	
	if ( typeof MutationObserver !== 'undefined' ) {
		// Dynamically add the "X" next the the author URL links when a comment is quick-edited.
		var comment_list_container = document.getElementById( 'the-comment-list' );

		if ( comment_list_container ) {
			var observer = new MutationObserver( function ( mutations ) {
				for ( var i = 0, _len = mutations.length; i < _len; i++ ) {
					if ( mutations[i].addedNodes.length > 0 ) {
						akismet_enable_comment_author_url_removal();
						
						// Once we know that we'll have to check for new author links, skip the rest of the mutations.
						break;
					}
				}
			} );
			
			observer.observe( comment_list_container, { attributes: true, childList: true, characterData: true } );
		}
	}

	function akismet_enable_comment_author_url_removal() {
		$( '#the-comment-list' )
			.find( 'tr.comment, tr[id ^= "comment-"]' )
			.find( '.column-author a[href^="http"]:first' ) // Ignore mailto: links, which would be the comment author's email.
			.each(function () {
				if ( $( this ).parent().find( '.akismet_remove_url' ).length > 0 ) {
					return;
				}
			
			var linkHref = $(this).attr( 'href' );
		
			// Ignore any links to the current domain, which are diagnostic tools, like the IP address link
			// or any other links another plugin might add.
			var currentHostParts = document.location.href.split( '/' );
			var currentHost = currentHostParts[0] + '//' + currentHostParts[2] + '/';
		
			if ( linkHref.indexOf( currentHost ) != 0 ) {
				var thisCommentId = $(this).parents('tr:first').attr('id').split("-");

				$(this)
					.attr("id", "author_comment_url_"+ thisCommentId[1])
					.after(
						$( '<a href="#" class="akismet_remove_url">x</a>' )
							.attr( 'commentid', thisCommentId[1] )
							.attr( 'title', WPAkismet.strings['Remove this URL'] )
					);
			}
		});
	}
});