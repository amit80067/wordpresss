<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php
 	if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		if( $post_Style == 'breadcrumb-fixed' ): ?>
			<div class="comment-wrap"><?php
				comments_popup_link(
					'<i class="fas fa-comment"> </i> 0',
					'<i class="fas fa-comment"> </i> 1',
					'<i class="fas fa-comment"> </i> %',
					'',
					'<span class="comment-off">'.__( 'Comments Off','augury' ).'</span>'
				); ?>
			</div><?php
		else:
			comments_popup_link(
				'<i class="fas fa-comment"> </i> 0',
				'<i class="fas fa-comment"> </i> 1',
				'<i class="fas fa-comment"> </i> %',
				'',
				'<span class="comment-off">'.__( 'Comments Off','augury' ).'</span>'
			);
		endif;
	}?>