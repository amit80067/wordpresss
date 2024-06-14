<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $post_Style == 'dt-sc-overlay-ii-style' || $post_Style == 'dt-sc-minimal-style' || $post_Style == 'dt-sc-classic-style' || $post_Style == 'dt-sc-classic-ii-style' ):
		echo esc_html__('In ', 'augury');
		the_category(' ');
	elseif( $post_Style == 'dt-sc-date-left-modern-style' ):
		echo '<span>'.esc_html__('In ', 'augury').'</span>';
		the_category(' ');
	elseif( $post_Style == 'dt-sc-simple-style' ):
		$cats = wp_get_object_terms($post_ID, 'category');
		if( !empty($cats) ):
			$count = count($cats);
			$out = '';
			foreach( $cats as $key => $term ) {
				$meta  = get_term_meta( $term->term_id, '_dt_post_category_options', true );
				$color = isset( $meta['category-color'] ) ? $meta['category-color'] : '';

				$out .= '<a href="'.get_term_link( $term->slug ,'category').'" style="color:'.esc_attr($color).'">'.esc_html( $term->name ).'</a>';
				$key += 1;

				if( $key !== $count ){
					$out .= ' ';
				}
			}
			echo "{$out}";
		endif;
	else:
		$cats = wp_get_object_terms($post_ID, 'category');
		if( !empty($cats) ):
			$count = count($cats);
			$out = '';
			foreach( $cats as $key => $term ) {
				$out .= '<a href="'.get_term_link( $term->slug ,'category').'">'.esc_html( $term->name ).'</a>';
				$key += 1;

				if( $key !== $count ){
					$out .= ' ';
				}
			}
			echo "<i class='fas fa-folder'> </i>{$out}";
		endif;
	endif; ?>