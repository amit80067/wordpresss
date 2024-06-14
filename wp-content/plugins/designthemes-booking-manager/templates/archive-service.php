<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
	/**
	* dt_booking_before_main_content hook.
	*/
	do_action( 'dt_booking_before_main_content' );
?>

	<?php
		/**
		* dt_booking_before_content hook.
		*/
		do_action( 'dt_booking_before_content' );
    ?>

		<?php
            $post_layout = cs_get_option( 'service-archives-post-layout' );

            switch($post_layout):

                case 'one-fourth-column':
                    $post_class = " service column dt-sc-one-fourth";
                    $columns = 4;
                break;

                case 'one-third-column':
                    $post_class = " service column dt-sc-one-third";
                    $columns = 3;
                break;

                default:
                case 'one-half-column':
                    $post_class = " service column dt-sc-one-half";
                    $columns = 2;
                break;
            endswitch;

            if( have_posts() ) :
                $i = 1;?>
                <div class="dt-sc-service-container"><?php
                    while( have_posts() ):
                        the_post();
                        $the_id = get_the_ID();

						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

                    endwhile;?>
                </div><?php
            endif;?>

            <!-- **Pagination** -->
            <div class="pagination booking-pagination"><?php
				echo '<div class="older-posts">'.get_next_posts_link( esc_html__('Older Posts ', 'dt-booking-manager').'<i class="fa fa-angle-right"></i>' ).'</div>';
                echo '<div class="newer-posts">'.get_previous_posts_link( '<i class="fa fa-angle-left"></i>'.esc_html__(' Newer Posts', 'dt-booking-manager') ).'</div>';
            ?></div><!-- **Pagination** -->

	<?php
        /**
        * dt_booking_after_content hook.
        */
        do_action( 'dt_booking_after_content' );
    ?>

<?php
	/**
	* dt_booking_after_main_content hook.
	*/
	do_action( 'dt_booking_after_main_content' );
?>

<?php get_footer();