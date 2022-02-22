<?php 
/**
 * This template for displaying comments
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
 
/* radon author */
Business_Responsiveness_author_detail();

 if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'business-responsiveness' ), esc_attr( get_the_title() ) );
				} else {
					printf(
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'business-responsiveness'
						),
						number_format_i18n( $comments_number ),
						esc_attr( get_the_title() )
					);
				}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'business-responsiveness' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>',
		) );
	?>

</div><!-- .comments-area -->
