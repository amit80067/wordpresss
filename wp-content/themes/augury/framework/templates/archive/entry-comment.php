<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
 	if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		if( $post_Style == 'dt-sc-simple-style' || $post_Style == 'dt-sc-simple-withbg-style' || $post_Style == 'dt-sc-overflow-style' ):
			comments_popup_link( esc_html__('Add Comment', 'augury'), esc_html__('1 Comment', 'augury'), esc_html__('% Comments', 'augury'), '', esc_html__('Comments Off', 'augury'));
		elseif( $post_Style == 'dt-sc-classic-style' || $post_Style == 'dt-sc-classic-ii-style' ):
			comments_popup_link('<i class="pe-icon pe-chat"> </i> 0', '<i class="pe-icon pe-chat"> </i> 1', '<i class="pe-icon pe-chat"> </i> %', '', '<i class="pe-icon pe-chat"> </i> 0');
		else:
			comments_popup_link('<i class="fas fa-comment"> </i> 0', '<i class="fas fa-comment"> </i> 1', '<i class="fas fa-comment"> </i> %', '', '<i class="fas fa-comment"> </i> 0');
		endif;
	}?>