<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-topic-title"><i class="fas fa-comment"></i><?php esc_html_e( 'Topic', 'augury' ); ?></li>
			<li class="bbp-topic-voice-count"><i class="fa fa-bullhorn"></i><?php esc_html_e( 'Voices', 'augury' ); ?></li>
			<li class="bbp-topic-reply-count"><i class="fas fa-pencil-alt"></i><?php bbp_show_lead_topic() ? esc_html_e( 'Replies', 'augury' ) : esc_html_e( 'Posts', 'augury' ); ?></li>
			<li class="bbp-topic-freshness"><i class="fa fa-refresh"></i><?php esc_html_e( 'Freshness', 'augury' ); ?></li>
		</ul>

	</li>

	<li class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

	<li class="bbp-footer">

		<div class="tr">
			<p>
				<span class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
			</p>
		</div><!-- .tr -->

	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
