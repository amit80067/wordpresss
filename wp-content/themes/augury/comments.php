<?php
if ( post_password_required() ) {
	return;
}?>

<div id="comments" class="comments-area"><?php
	if ( have_comments() ) : ?>

	    <h3><?php comments_number(esc_html__('No Comments','augury'), esc_html__('Comments ( 1 )','augury'), esc_html__('Comments ( % )','augury') );?></h3>

		<?php the_comments_navigation(); ?>

        <ul class="commentlist">
     		<?php wp_list_comments( array( 'avatar_size' => 50 ) ); ?>
        </ul>

        <?php the_comments_navigation();

    endif;

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.','augury'); ?></p><?php
	endif;
	
	$args = array ();
	if( augury_get_option('privacy-commentform') != "true" ) {
		$args = array (
			'title_reply' 	=> esc_html__( 'Leave a Comment', 'augury' ),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_attr__('Comment', 'augury').'"></textarea></p>',
			'fields' => array(
				'author' => '<p class="comment-form-author">' . ( $req ? '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_attr__('Name *', 'augury').'" />' : '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_attr__('Name', 'augury').'" />' ) . '</p>',
				'email' => '<p class="comment-form-email">' . ( $req ? '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="'.esc_attr__('Email *', 'augury').'" />' : '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="'.esc_attr__('Email', 'augury').'" />' ) . '</p>',
				'url' => '<p class="comment-form-url">' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.esc_attr__('Website', 'augury').'" /></p>',
			),
		);
	}

	comment_form($args); ?></div><!-- .comments-area -->