<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'dt-sc-overlay-ii-style' || $post_Style == 'dt-sc-minimal-style' || $post_Style == 'dt-sc-classic-style' || $post_Style == 'dt-sc-classic-ii-style' ):
		the_tags( esc_html__('Tags ', 'augury'), ' ', '');
	elseif( $post_Style == 'dt-sc-date-left-modern-style' ):
		the_tags( '<span>'.esc_html__('Tags ', 'augury').'</span>', ' ', '');
	else:
		the_tags('<i class="fas fa-bookmark"> </i> ', ' ', '');
	endif; ?>