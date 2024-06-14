<?php get_header(); ?>

<!-- **Main** -->
<div id="main">

    <!-- ** Container ** -->
    <div class="container">

        <!-- Primary -->
        <section id="primary" class="content-full-width"><?php
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                    <?php the_content(); ?>
                    </div><!-- #post-<?php the_ID(); ?> --><?php
                }
            }?>
        </section><!-- Primary End -->

    </div>
    <!-- ** Container End ** -->

</div><!-- **Main - End ** -->
<?php get_footer(); ?>