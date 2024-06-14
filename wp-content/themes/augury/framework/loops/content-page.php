	<!-- #post-<?php the_ID(); ?> -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_content(); 
	  wp_link_pages( array(	
	  	'before'	=>	'<div class="page-link">',
	  	'after'		=>	'</div>',
	  	'link_before'	=>	'<span>',
	  	'link_after'	=>	'</span>',
	  	'next_or_number' =>	'number',
	  	'pagelink' =>	'%',
		'echo'	=>	1 ) );
		
		edit_post_link( esc_html__( ' Edit ','augury' ) );?>
</div><!-- #post-<?php the_ID(); ?> -->
<?php
#Page Comments
$page_comment = augury_get_option( 'show-pagecomments' );
if( $page_comment ):?>
	<div class="dt-sc-hr"></div>
	<div class="dt-sc-clear"></div>
	<!-- ** Comment Entries ** --><?php
	$comment_style_opt = augury_get_option( 'post-comments-list-style' );
	$comment_Style = isset( $comment_Style ) ? $comment_Style : $comment_style_opt; ?>
	<section class="commententries <?php echo esc_attr($comment_Style); ?>">
		<?php  comments_template('', true); ?>
	</section>
<?php endif;?>