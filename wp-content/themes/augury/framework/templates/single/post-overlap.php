<?php
	$format = !empty( $Post_Meta['post-format-type'] ) ? $Post_Meta['post-format-type'] : 'standard';

	$template = 'framework/templates/single/entry-image.php';
	$template_args['post_ID'] = $ID;
	$template_args['meta'] = $Post_Meta;
	$template_args['post_Style'] = $Post_Style; ?>

    <!-- Featured Image -->
    <div class="entry-thumb single-preview-img">
        <div class="blog-image">
			<?php augury_get_template( $template, $template_args ); ?>
        </div>

        <!-- Post Format -->
        <div class="entry-format">
            <a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
        </div><!-- Post Format -->

		<div class="entry-overlap">
            <div class="entry-bottom-details">
				<?php
                $template = 'framework/templates/single/entry-author.php'; ?>
                <!-- Entry Author -->
                <div class="entry-author">
                    <?php augury_get_template( $template, $template_args ); ?>
                </div><!-- Entry Author -->

				<?php
                $template = 'framework/templates/single/entry-date.php'; ?>
                <!-- Entry Date -->
                <div class="entry-date">
                    <?php augury_get_template( $template, $template_args ); ?>
                </div><!-- Entry Date -->

				<?php
                $template = 'framework/templates/single/entry-categories.php'; ?>
                <!-- Entry Categories -->
                <div class="entry-categories">
                    <?php augury_get_template( $template, $template_args ); ?>
                </div><!-- Entry Categories -->
            </div>
        </div>
    </div><!-- Featured Image -->

	<?php
	// Getting values from theme options...
	$template = 'framework/templates/single/entry-elements-loop.php';
	$template_args['ID'] = $ID;
	$template_args['Post_Style'] = $Post_Style;
	$template_args['Post_Meta'] = $Post_Meta;

	augury_get_template( $template, $template_args ); ?>