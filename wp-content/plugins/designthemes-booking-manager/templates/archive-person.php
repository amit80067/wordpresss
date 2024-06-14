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
			$teamstyle  = cs_get_option( 'person-archives-post-style' );
			$post_layout = cs_get_option( 'person-archives-post-layout' );
			$post_excerpt = cs_get_option( 'person-archives-excerpt' );

			switch($post_layout):

				case 'one-fourth-column':
					$post_class = " person column dt-sc-one-fourth";
					$columns = 4;
				break;
			
				case 'one-third-column':
					$post_class = " person column dt-sc-one-third";
					$columns = 3;
				break;
			
				default:
				case 'one-half-column':
					$post_class = " person column dt-sc-one-half";
					$columns = 2;
				break;
			endswitch;

			if( have_posts() ) :
				$i = 1;?>
				<div class="dt-sc-person-container"><?php
					while( have_posts() ):
						the_post();
						$the_id = get_the_ID();
			
						$temp_class = $teamstyle;
						if($i == 1) $temp_class .= $post_class.' first'; else $temp_class .= $post_class;
						if($i == $columns) $i = 1; else $i = $i + 1;
			
						# Meta
						$person_meta = get_post_meta($the_id,'_custom_settings',TRUE);
						$person_meta = is_array( $person_meta ) ? $person_meta  : array(); ?>
			
						<div id="dt_person-<?php echo esc_attr($the_id);?>" class="<?php echo esc_attr( trim($temp_class));?>"><?php
							# Feature image
							if( has_post_thumbnail() ){
								$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $the_id ), 'dt-bm-archive-person', false);
								$image = $post_thumb[0];
							} else {
								$image = $popup = 'http://placehold.it/420X420.jpg&text='.get_the_title($the_id);
							}
			
							echo "<div class='dt-sc-team {$teamstyle}'>";
								echo "<div class='dt-sc-team-thumb'>";
									echo '<img src="'.$image.'" alt="'.get_the_title().'" />';
			
									if($teamstyle == 'type2'):
										echo '<div class="dt-sc-team-thumb-overlay">';
											if( array_key_exists( 'person-social', $person_meta ) ) {
												echo do_shortcode( $person_meta['person-social'] );
											}
										echo '</div>';
									endif;

								echo '</div>';

								echo "<div class='dt-sc-team-details'>";
									echo '<h4><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>';
									if( array_key_exists( 'person-role', $person_meta ) ) {
										echo '<h5>'.$person_meta['person-role'].'</h5>';
									}

									if($teamstyle != 'type2'):
										if( array_key_exists( 'person-social', $person_meta ) ) {
											echo do_shortcode( $person_meta['person-social'] );
										}
									endif;

									if( $post_excerpt ) {
										echo dt_booking_post_excerpt(12);
									}
								echo '</div>';

							echo '</div>'; ?>
						</div><?php
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