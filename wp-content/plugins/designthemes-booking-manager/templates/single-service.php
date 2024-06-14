<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
            if( have_posts() ) {
                while( have_posts() ) {
                    the_post();
                    the_content();
                }
            }?>

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