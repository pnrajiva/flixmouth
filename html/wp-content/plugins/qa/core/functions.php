<?php

/**
 * The following functions abstract away various implementation details of the plugin.
 * They never echo anything.
 */

/**
 * Check if we're on a certain type of question page
 *
 * @param string $type The type of page
 * @return bool
 */
function is_qa_page( $type = '' ) {
	static $flags;

	if ( !$flags ) {
		$flags = array(
			'ask' => (bool) get_query_var( 'qa_ask' ),
			'unanswered' => (bool) get_query_var( 'qa_unanswered' ),
			'edit' => (bool) get_query_var( 'qa_edit' ),
			'user' => 'question' == get_query_var( 'post_type' ) && get_query_var( 'author_name' ),
			'single' => is_singular( 'question' ),
			'archive' => is_post_type_archive( 'question' ),
			'tag' => is_tax( 'question_tag' )
		);
	}

	// Check if any flags are true
	if ( empty( $type ) )
		return in_array( true, $flags );

	return isset( $flags[ $type ] ) && $flags[ $type ];
}

/**
 * Get the URL to a certain type of question page
 *
 * @param string $type The type of URL
 * @param int (optional) $id A question or tag id, depending on the type
 * @return string
 */
function qa_get_url( $type, $id = 0 ) {
	$base = get_post_type_archive_link( 'question' );

	switch ( $type ) {
		case 'ask':
		case 'unanswered':
			return trailingslashit( $base ) . user_trailingslashit( $type );
			break;
		case 'edit':
			$post = get_post( $id );
			if ( $post ) {
				return trailingslashit( $base ) . user_trailingslashit( 'edit/' . $post->ID );
			}
			break;
		case 'delete':
			$post = get_post( $id );
			if ( $post ) {
				return add_query_arg( array(
					'qa_delete' => $post->ID,
					'_wpnonce' => wp_create_nonce( 'qa_delete' )
				), $base );
			}
			break;
		case 'user':
			if ( !$id ) {
				$id = get_current_user_id();
			}
			$user = get_userdata( $id );
			if ( $user ) {
				return trailingslashit( $base ) . user_trailingslashit( 'user/' . $user->user_nicename );
			}
			break;
		case 'single':
			return get_permalink( $id );
			break;
		case 'archive':
			return get_post_type_archive_link( 'question' );
			break;
		case 'tag':
			return get_term_link( $id, 'question_tag' );
			break;
	}

	return '';
}

function is_question_answered( $question_id = 0, $type = 'any' ) {
	if ( !$question_id )
		$question_id = get_the_ID();

	if ( 'accepted' == $type ) {
		return get_post_meta( $question_id, 'accepted_answer', true );
	} else {
		return get_answer_count( $question_id ) > 0;
	}
}

function get_answer_count( $question_id ) {
	return (int) get_post_meta( $question_id, '_answer_count', true );
}


/* Reputation API */

function qa_get_votes( $id ) {
	return $GLOBALS['_qa_votes']->get( $id );
}

function qa_add_vote( $id, $vote ) {
	return $GLOBALS['_qa_votes']->add( $id, $vote );
}

function qa_remove_vote( $id ) {
	return $GLOBALS['_qa_votes']->remove( $id );
}

function qa_get_user_rep( $user_id ) {
	return (int) get_user_meta( $user_id, '_qa_rep', true );
}

/* = Private API (the following functions may vanish at any point)
-------------------------------------------------------------- */

/**
 * Minimalist HTML framework.
 *
 * Usage:
 *
 * html( 'p', 'Hello world!' );
 * html( 'a', array( 'href' => 'http://example.com' ), 'A link' );
 * html( 'img', array( 'src' => 'http://example.com/f.jpg' ) );
 * html( 'ul', html( 'li', 'a' ), html( 'li', 'b' ) );
 *
 * @return string An HTML tag
 */
function _qa_html( $tag ) {
	$args = func_get_args();

	$tag = array_shift( $args );

	if ( is_array( $args[0] ) ) {
		$closing = $tag;
		$attributes = array_shift( $args );
		foreach ( $attributes as $key => $value ) {
			$tag .= ' ' . $key . '="' . htmlspecialchars( $value, ENT_QUOTES ) . '"';
		}
	} else {
		list( $closing ) = explode( ' ', $tag, 2 );
	}

	if ( in_array( $closing, array( 'area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta' ) ) ) {
		return "<{$tag} />";
	}

	$content = implode( '', $args );

	return "<{$tag}>{$content}</{$closing}>";
}

