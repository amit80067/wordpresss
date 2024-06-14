<?php
// Getting values from theme options...
$ele_pos = augury_get_option( 'post-elements-position' );
foreach( $ele_pos as $ep ) {
	$element_position[$ep] = $ep;
}

$meta_pos = augury_get_option( 'post-meta-position' );
foreach( $meta_pos as $mp ) {
	$meta_group_position[$mp] = $mp;
}

$template_args['post_ID'] = $ID;
$template_args['meta'] = $Post_Meta;
$template_args['post_Style'] = $Post_Style;

foreach( $element_position as $key => $value ):

	if( $key == 'feature_image' ):

		$format = !empty( $Post_Meta['post-format-type'] ) ? $Post_Meta['post-format-type'] : 'standard';
		$template = 'framework/templates/single/entry-image.php'; ?>

		<!-- Featured Image -->
		<div class="entry-thumb single-preview-img">
			<?php augury_get_template( $template, $template_args ); ?>

			<!-- Post Format -->
			<div class="entry-format">
				<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
			</div><!-- Post Format -->
		</div><!-- Featured Image --><?php

	elseif( $key == 'title' ):

		$template = 'framework/templates/single/entry-title.php'; ?>

		<!-- Entry Title -->
		<div class="entry-title">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Title --><?php

	elseif( $key == 'content' ):

		$template = 'framework/templates/single/entry-content.php';
		augury_get_template( $template );

	elseif( $key == 'author' ):

		$template = 'framework/templates/single/entry-author.php'; ?>

		<!-- Entry Author -->
		<div class="entry-author">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Author --><?php

	elseif( $key == 'date' ):

		$template = 'framework/templates/single/entry-date.php'; ?>

		<!-- Entry Date -->
		<div class="entry-date">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Date --><?php

	elseif( $key == 'comments' ):

		$template = 'framework/templates/single/entry-comment.php'; ?>

		<!-- Entry Comment -->
		<div class="entry-comments">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Comment --><?php

	elseif( $key == 'categories' ):

		$template = 'framework/templates/single/entry-categories.php'; ?>

		<!-- Entry Categories -->
		<div class="entry-categories">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Categories --><?php

	elseif( $key == 'tags' && has_tag() ):

		$template = 'framework/templates/single/entry-tags.php'; ?>

		<!-- Entry Tags -->
		<div class="entry-tags">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Tags --><?php

	elseif( $key == 'social_share' ):

		$template = 'framework/templates/single/entry-social.php'; ?>

		<!-- Entry Social Share -->
		<div class="entry-social-share">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Social Share --><?php

	elseif( $key == 'likes_views' ):

		$template = 'framework/templates/single/entry-likes-views.php'; ?>

		<!-- Entry Likes Views -->
		<div class="entry-likes-views">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Likes Views --><?php

	elseif( $key == 'related_posts' ):

		$template = 'framework/templates/single/entry-related-posts.php'; ?>

		<!-- Entry Related Posts -->
		<div class="entry-related-posts">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Related Posts --><?php

	elseif( $key == 'author_bio' ):

		$template = 'framework/templates/single/entry-author-bio.php'; ?>

		<!-- Entry Author Bio -->
		<div class="entry-author-bio">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Author Bio --><?php

	elseif( $key == 'navigation' ):

		$template = 'framework/templates/single/entry-navigation.php'; ?>

		<!-- Entry Navigation -->
		<div class="entry-post-navigation">
			<?php augury_get_template( $template, $template_args ); ?>
		</div><!-- Entry Navigation --><?php

	elseif( $key == 'comment_box' ):

		$template = 'framework/templates/single/entry-commentbox.php';
		augury_get_template( $template, $template_args );

	elseif( $key == 'related_article' ):

		$template = 'framework/templates/single/entry-related-article.php';
		augury_get_template( $template, $template_args );

	elseif( $key == 'meta_group' ): ?>

		<div class="entry-meta-group"><?php

			foreach( $meta_group_position as $key => $value ):

				if( $key == 'author' ):

					$template = 'framework/templates/single/entry-author.php'; ?>

					<!-- Entry Author -->
					<div class="entry-author"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Author --><?php

				elseif( $key == 'date' ):

					$template = 'framework/templates/single/entry-date.php'; ?>

					<!-- Entry Date -->
					<div class="entry-date"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Date --><?php

				elseif( $key == 'comments' ):

					$template = 'framework/templates/single/entry-comment.php'; ?>

					<!-- Entry Comment -->
					<div class="entry-comments"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Comment --><?php

				elseif( $key == 'categories' ):

					$template = 'framework/templates/single/entry-categories.php'; ?>

					<!-- Entry Categories -->
					<div class="entry-categories"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Categories --><?php

				elseif( $key == 'tags' && has_tag() ):

					$template = 'framework/templates/single/entry-tags.php'; ?>

					<!-- Entry Tags -->
					<div class="entry-tags"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Tags --><?php

				elseif( $key == 'social_share' ):

					$template = 'framework/templates/single/entry-social.php'; ?>

					<!-- Entry Social Share -->
					<div class="entry-social-share"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Social Share --><?php

				elseif( $key == 'likes_views' ):

					$template = 'framework/templates/single/entry-likes-views.php'; ?>

					<!-- Entry Likes Views -->
					<div class="entry-likes-views"><?php 
						augury_get_template( $template, $template_args );
					?></div><!-- Entry Likes Views --><?php

				endif;
			endforeach;?></div><?php
	endif;

endforeach; ?>