    <div class="dt-sc-posts-list-wrapper"><?php
        // Getting options...
		$holder_class = $combine_class = array();
		$post_style = '';

        $post_layout = augury_get_option( 'blog-post-layout' );
		$combine_class[] = $post_layout.'-layout';

        $post_gl_style = augury_get_option( 'blog-post-grid-list-style' );
		$post_cover_style = augury_get_option( 'blog-post-cover-style' );
		$combine_class[] = $post_style = ( $post_layout == 'entry-grid' || $post_layout == 'entry-list' ) ? $post_gl_style.'-style' : $post_cover_style.'-style';

		$post_list_type = augury_get_option( 'blog-list-thumb' );
		$combine_class[] = ( $post_layout == 'entry-list' ) ? $post_list_type : '';

		$post_equal_height = augury_get_option( 'enable-equal-height' );
		if( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_equal_height == true ):
			$holder_class[] = 'apply-equal-height';
		elseif( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ):
			$holder_class[] = 'apply-isotope';
		elseif( $post_layout == 'entry-list' ):
			$holder_class[] = '';
		endif;

		$post_no_space = augury_get_option( 'enable-no-space' );
		if( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_no_space == true ):
			$holder_class[] = 'apply-no-space';
		elseif( $post_layout == 'entry-list' ):
			$holder_class[] = '';
		endif;

		$post_img_hover_style = augury_get_option( 'blog-image-hover-style' );
		$combine_class[] = ( $post_img_hover_style != '' ) ? $post_img_hover_style.'-hover' : '';

		$post_img_overlay_style = augury_get_option( 'blog-image-overlay-style' );
		$combine_class[] = ( ( $post_layout == 'entry-grid' || $post_layout == 'entry-list' ) && $post_img_overlay_style != '' ) ? $post_img_overlay_style.'-overlay' : '';

		$post_alignment = augury_get_option( 'blog-alignment' );
		$combine_class[] = ( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_alignment != '' ) ? $post_alignment : '';

		$post_columns = augury_get_option( 'blog-post-columns' );
		$post_columns = isset( $post_columns ) ? $post_columns : 'one-column';
		$post_columns = ( $post_layout == 'entry-list' ) ? 'one-column' : $post_columns;

        switch( $post_columns ):

            default:
			case 'one-column':
				$post_class = "column dt-sc-one-column dt-sc-post-entry ";
                $columns = 1;
            break;

            case 'one-half-column':
				$post_class = "column dt-sc-one-half dt-sc-post-entry ";
                $columns = 2;
            break;

            case 'one-third-column':
				$post_class = "column dt-sc-one-third dt-sc-post-entry ";
                $columns = 3;
            break;

            case 'one-fourth-column':
				$post_class = "column dt-sc-one-fourth dt-sc-post-entry ";
                $columns = 4;
            break;
        endswitch;

		$post_class .= implode(' ', $combine_class);
        
        if( have_posts() ):

            $i = 1;

            echo "<div class='tpl-blog-holder ".implode(' ', $holder_class)."'>";
            echo "<div class='grid-sizer ".$post_class."'></div>";

            $obj = new augury_post_functions;
            $meta = $obj->augury_post_meta_fields(false);

            while( have_posts() ):
                the_post();

                $temp_class = "";
                $post_ID = get_the_ID();

                if($i == 1) $temp_class = $post_class.' first'; else $temp_class = $post_class;
                if($i == $columns) $i = 1; else $i = $i + 1;

                $post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
                $post_meta = is_array($post_meta) ? $post_meta : array();

                $format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';
				$post_classes = array( 'blog-entry', 'format-'.$format );

				if( isset($meta[7]) && $meta[7] == true )
					$post_classes[] = 'has-post-format';

				if( isset($meta[6]) && $meta[6] == true && ( $format === 'video' || $format === 'audio' ) )
                    $post_classes[] = 'has-post-media'; 
                    
                if(get_the_title( $post_ID ) == '') {
                    $post_classes[] = 'post-without-title';
                }
                
                ?>

                <div class="<?php echo esc_attr($temp_class);?>">
                    <article id="post-<?php the_ID();?>" <?php post_class( $post_classes );?>><?php

						$template = apply_filters( 'augury_blog_archive_template', 'framework/templates/archive-blog-entry.php' );
						$template_args['ID'] = $post_ID;
						$template_args['Post_Style'] = $post_style;
						$template_args['Post_Layout'] = $post_layout;
						$template_args['Post_Column'] = $post_columns;
						$template_args['meta'] = $meta;

						augury_get_template( $template, $template_args );

                    echo '</article>';
                echo '</div>';

            endwhile;
            echo '</div>';

        else:?>
            <h2><?php esc_html_e('Nothing Found.', 'augury'); ?></h2>
            <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'augury'); ?></p><?php
        endif;?>

        <!-- **Pagination** --><?php
        $pagination = augury_get_option( 'blog-pagination' );
        if( $pagination == 'older_newer' ): ?>

            <div class="pagination blog-pagination">
                <?php 
                if(get_previous_posts_link()):
                    ?>
                    <div class="newer-posts"><?php echo get_previous_posts_link( '<i class="fas fa-angle-left"></i>'.esc_html__(' Newer Posts', 'augury') ); ?></div>
                    <?php
                endif;
                if(get_next_posts_link()):
                    ?>
                    <div class="older-posts"><?php echo get_next_posts_link( esc_html__('Older Posts ', 'augury').'<i class="fas fa-angle-right"></i>' ); ?></div>
                    <?php
                endif;
                ?>
            </div><?php

        elseif( $pagination == 'numbered' ): ?>

            <div class="pagination blog-pagination"><?php echo augury_pagination(); ?></div><?php

        elseif( $pagination == 'load_more' ):

			global $wp_query;
			$count = get_option( 'posts_per_page' );
			$pos = $count % $columns;
			$pos += 1; ?>

            <div class="pagination blog-pagination"><a class="loadmore-btn more-items" data-maxpage="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-pos="<?php echo esc_attr($pos); ?>" data-eheight="<?php echo esc_attr($post_equal_height); ?>" data-style="<?php echo esc_attr($post_style); ?>" data-layout="<?php echo esc_attr($post_layout); ?>" data-column="<?php echo esc_attr($post_columns); ?>" data-listtype="<?php echo esc_attr($post_list_type); ?>" data-hover="<?php echo esc_attr($post_img_hover_style); ?>" data-overlay="<?php echo esc_attr($post_img_overlay_style); ?>" data-align="<?php echo esc_attr($post_alignment); ?>" data-meta="" data-blogpostloadmore-nonce="<?php echo wp_create_nonce('blogpostloadmore_nonce'); ?>" href="javascript:void(0);"><?php esc_html_e('Load More', 'augury'); ?></a></div><?php

        elseif( $pagination == 'infinite_scroll' ):

			global $wp_query;
			$count = get_option( 'posts_per_page' );
			$pos = $count % $columns;
			$pos += 1; ?>

            <div class="pagination blog-pagination"><div class="infinite-btn more-items" data-maxpage="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-pos="<?php echo esc_attr($pos); ?>" data-eheight="<?php echo esc_attr($post_equal_height); ?>" data-style="<?php echo esc_attr($post_style); ?>" data-layout="<?php echo esc_attr($post_layout); ?>" data-column="<?php echo esc_attr($post_columns); ?>" data-listtype="<?php echo esc_attr($post_list_type); ?>" data-hover="<?php echo esc_attr($post_img_hover_style); ?>" data-overlay="<?php echo esc_attr($post_img_overlay_style); ?>" data-align="<?php echo esc_attr($post_alignment); ?>" data-meta="" data-blogpostloadmore-nonce="<?php echo wp_create_nonce('blogpostloadmore_nonce'); ?>"></div></div><?php

        endif; ?><!-- **Pagination** -->
    </div>