<?php
// Looping the enabled blocks...
$Post_ID		= $ID;
$elements_pos 	= $meta[0];
$meta_group_pos = $meta[1];

if( array_key_exists( 'feature_image', $elements_pos ) && ( $Post_Layout == 'entry-list' || $Post_Layout == 'entry-cover' )  ) {
	$elements_pos = array('feature_image' => $elements_pos['feature_image']) + $elements_pos;
}

$template_args['post_ID'] = $Post_ID;
$template_args['column'] = $Post_Column;
$template_args['post_Layout'] = $Post_Layout;
$template_args['post_Style'] = $Post_Style;
$template_args['meta'] = $meta;

foreach( $elements_pos as $key => $value ):

	if( $key == 'feature_image' ):

		$post_meta = get_post_meta($Post_ID, '_dt_post_settings', TRUE);
		$post_meta = is_array($post_meta) ? $post_meta : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';

		if( $Post_Layout == 'entry-grid' ):
			$template = 'framework/templates/archive/entry-image.php'; ?>
			<!-- Featured Image -->
			<div class="entry-thumb">
				<?php augury_get_template( $template, $template_args ); ?>

                <?php if( $meta[7] == true ): ?>
                    <!-- Post Format -->
                    <div class="entry-format">
                        <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                    </div><!-- Post Format -->
                <?php endif; ?>
			</div><!-- Featured Image --><?php
		else:
			$template = 'framework/templates/archive/entry-bg-image.php'; ?>
			<!-- Featured Image -->
			<div class="entry-thumb">
            	<div class="blog-image">
					<?php augury_get_template( $template, $template_args ); ?>
                </div><?php
				if( $Post_Layout == 'entry-list' && $meta[7] == true ): ?>
                    <!-- Post Format -->
                    <div class="entry-format">
                        <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                    </div><!-- Post Format --><?php
				endif; ?>
			</div><!-- Featured Image --><?php

			if( $Post_Layout == 'entry-cover' ):

				if( $meta[7] == true ): ?>
                    <!-- Post Format -->
                    <div class="entry-format">
                        <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                    </div><!-- Post Format --><?php
				endif;

				echo '<!-- Entry Details --><div class="entry-details">';
			endif;
		endif;

	elseif( $key == 'title' ):

		$template = 'framework/templates/archive/entry-title.php'; ?>

        <!-- Entry Title -->
        <div class="entry-title">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Title --><?php

	elseif( $key == 'content' ):

		if( $meta[2] && $meta[3] > 0 ):
			$template = 'framework/templates/archive/entry-excerpt.php';
			$template_args['excerpt_length'] = $meta[3];

			augury_get_template( $template, $template_args );
		endif;

	elseif( $key == 'read_more' ):

		if( $meta[4] != '' ):
			echo '<!-- Entry Button --><div class="entry-button">';
				echo '<a href="'.get_permalink().'" title="'.the_title_attribute('echo=0').'" class="dt-sc-button">'.$meta[4].'<span class="fas fa-long-arrow-alt-right"></span></a>';
			echo '</div><!-- Entry Button -->';
		endif;

	elseif( $key == 'author' ):

		$template = 'framework/templates/archive/entry-author.php'; ?>

        <!-- Entry Author -->
        <div class="entry-author">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Author --><?php

	elseif( $key == 'date' ):

		$template = 'framework/templates/archive/entry-date.php'; ?>

        <!-- Entry Date -->
        <div class="entry-date">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Date --><?php

	elseif( $key == 'comments' ):

		$template = 'framework/templates/archive/entry-comment.php'; ?>

        <!-- Entry Comment -->
        <div class="entry-comments">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Comment --><?php

	elseif( $key == 'categories' ):

		$template = 'framework/templates/archive/entry-categories.php'; ?>

        <!-- Entry Categories -->
        <div class="entry-categories">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Categories --><?php

	elseif( $key == 'tags' && has_tag() ):

		$template = 'framework/templates/archive/entry-tags.php'; ?>

        <!-- Entry Tags -->
        <div class="entry-tags">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Tags --><?php

	elseif( $key == 'social_share' ):

		$template = 'framework/templates/archive/entry-social.php'; ?>

        <!-- Entry Social Share -->
        <div class="entry-social-share">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Social Share --><?php

	elseif( $key == 'likes_views' ):

		$template = 'framework/templates/archive/entry-likes-views.php'; ?>

        <!-- Entry Likes Views -->
        <div class="entry-likes-views">
        	<?php augury_get_template( $template, $template_args ); ?>
        </div><!-- Entry Likes Views --><?php

	elseif( $key == 'meta_group' ): ?>

    	<div class="entry-meta-group"><?php

			foreach( $meta_group_pos as $key => $value ):

				if( $key == 'author' ):

					$template = 'framework/templates/archive/entry-author.php'; ?>

					<!-- Entry Author -->
					<div class="entry-author">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Author --><?php

				elseif( $key == 'date' ):

					$template = 'framework/templates/archive/entry-date.php'; ?>

					<!-- Entry Date -->
					<div class="entry-date">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Date --><?php
			
				elseif( $key == 'comments' ):

					$template = 'framework/templates/archive/entry-comment.php'; ?>

					<!-- Entry Comment -->
					<div class="entry-comments">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Comment --><?php

				elseif( $key == 'categories' ):

					$template = 'framework/templates/archive/entry-categories.php'; ?>

					<!-- Entry Categories -->
					<div class="entry-categories">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Categories --><?php

				elseif( $key == 'tags' && has_tag() ):

					$template = 'framework/templates/archive/entry-tags.php'; ?>

					<!-- Entry Tags -->
					<div class="entry-tags">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Tags --><?php

				elseif( $key == 'social_share' ):

					$template = 'framework/templates/archive/entry-social.php'; ?>

					<!-- Entry Social Share -->
					<div class="entry-social-share">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Social Share --><?php

				elseif( $key == 'likes_views' ):

					$template = 'framework/templates/archive/entry-likes-views.php'; ?>

					<!-- Entry Likes Views -->
					<div class="entry-likes-views">
						<?php augury_get_template( $template, $template_args ); ?>
					</div><!-- Entry Likes Views --><?php

				endif;
			endforeach;?></div><?php
	endif;

endforeach;

if( $Post_Layout == 'entry-cover' && array_key_exists( 'feature_image', $elements_pos ) ):
	echo '</div><!-- Entry Details -->';
endif;