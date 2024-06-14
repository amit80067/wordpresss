<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

	if( $post_Style == 'breadcrumb-fixed' ):
		echo get_the_tag_list( '<div class="tag-wrap"><span>'.esc_html__('A story about', 'augury').'</span><p>', ' ', '</p></div>', $post_ID );
	elseif( $post_Style == 'overlay' ):
		echo get_the_tag_list( '<span>'.esc_html__('Tags : ', 'augury').'</span>', ', ', '', $post_ID );
	elseif( $post_Style == 'overlap' ):
		echo get_the_tag_list( '', ' ', '', $post_ID );
	else:
		echo get_the_tag_list( '<i class="fas fa-bookmark"> </i> ', ' ', '', $post_ID );
	endif; ?>