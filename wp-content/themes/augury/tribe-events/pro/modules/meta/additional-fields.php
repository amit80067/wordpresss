<?php
/**
 * Single Event Meta (Additional Fields) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/pro/modules/meta/additional-fields.php
 *
 * @package TribeEventsCalendarPro
 */

if ( ! isset( $fields ) || empty( $fields ) || ! is_array( $fields ) ) {
	return;
}

?>

<div class="tribe-events-meta-group tribe-events-meta-group-other">
    <div class="dt-sc-hr-invisible-xsmall"></div>
	<h3> <?php esc_html_e( 'Other', 'augury' ) ?> </h3>
	<ul class="event-custom-fields">
		<?php foreach ( $fields as $name => $value ): ?>
			<li>
                <dt> <?php echo esc_html( $name );  ?>: </dt>
				<?php
					// This can hold HTML. The values are cleansed upstream
					echo ( ($value) ); ?>
            </li>    
		<?php endforeach; ?>
	</ul>
</div>
