<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	$number = get_comments_number( $post_ID );

 	if( ! post_password_required() ) {
		if( $post_Style == 'breadcrumb-fixed' ): ?>
			<div class="comment-wrap"><?php
				echo '<a href="';
						if ( 0 == $number ) {
							$respond_link = get_permalink($post_ID) . '#respond';
							echo apply_filters( 'respond_link', $respond_link, $post_ID );
						} else {
							echo get_comments_link($post_ID);
						}
						echo '"';
				echo '>';
					echo '<i class="fas fa-comment"> </i> ';
					echo esc_html($number);
				echo '</a>'; ?>
			</div><?php
		else:
			echo '<a href="';
					if ( 0 == $number ) {
						$respond_link = get_permalink($post_ID) . '#respond';
						echo apply_filters( 'respond_link', $respond_link, $post_ID );
					} else {
						echo get_comments_link($post_ID);
					}
					echo '"';
			echo '>';
				echo '<i class="fas fa-comment"> </i> ';
				echo esc_html($number);
			echo '</a>';
		endif;
	} else {
		if( $post_Style == 'breadcrumb-fixed' ): ?>
			<div class="comment-wrap"><?php
				echo '<i class="fas fa-ban"> </i>'.esc_html__('Enter your password to view comments.', 'augury'); ?>
            </div><?php
		else:
			echo '<i class="fas fa-ban"> </i>'.esc_html__('Enter your password to view comments.', 'augury');
		endif;
	}?>