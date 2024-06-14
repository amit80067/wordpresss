<?php
	$format = !empty( $Post_Meta['post-format-type'] ) ? $Post_Meta['post-format-type'] : 'standard';

	$template_args['post_ID'] = $ID;
	$template_args['meta'] = $Post_Meta;
	$template_args['post_Style'] = $Post_Style; ?>

	<?php
    $template = 'framework/templates/single/entry-date.php'; ?>
    <!-- Entry Date -->
    <div class="entry-date meta-elements-space">
        <?php augury_get_template( $template, $template_args ); ?>
    </div><!-- Entry Date -->

	<?php
    $template = 'framework/templates/single/entry-title.php'; ?>
    <!-- Entry Title -->
    <div class="entry-title">
        <?php augury_get_template( $template, $template_args ); ?>
    </div><!-- Entry Title -->

	<?php
	if( shortcode_exists( 'dt_sc_postmeta_group' ) ):
		$sc = '[dt_sc_postmeta_group style="metagroup-horizontal-separator" blog_meta_position="author,comments,categories,tags,likes_views" /]';
		echo do_shortcode( $sc );
	endif; ?>

    <?php
	$template = 'framework/templates/single/entry-image.php'; ?>
    <!-- Featured Image -->
    <div class="entry-thumb single-preview-img">
        <div class="blog-image">
			<?php augury_get_template( $template, $template_args ); ?>
        </div>

        <!-- Post Format -->
        <div class="entry-format">
            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
        </div><!-- Post Format -->
    </div><!-- Featured Image -->

	<?php
	// Getting values from theme options...
	$template = 'framework/templates/single/entry-elements-loop.php';
	$template_args['ID'] = $ID;
	$template_args['Post_Style'] = $Post_Style;
	$template_args['Post_Meta'] = $Post_Meta;

	augury_get_template( $template, $template_args ); ?>