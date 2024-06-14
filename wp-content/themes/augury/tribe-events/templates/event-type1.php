	<?php $event_id = get_the_ID(); ?>

    <p class="nav-top-links">
        <a href="<?php echo esc_url( tribe_get_events_link() ); ?>" class="back-nav"><?php esc_html_e('All Events', 'augury'); ?></a>
        <span class="sep">/</span>
        <a href="<?php echo esc_url( tribe_get_gcal_link($event_id) ); ?>"><?php esc_html_e('+ Google Calendar', 'augury'); ?></a>
        <span class="sep">/</span>
        <a href="<?php echo esc_url( tribe_get_ical_link() ); ?>"><?php esc_html_e('+ iCal Export', 'augury'); ?></a>
    </p>
	<h2><?php the_title(); ?></h2>

    <p class="event-schedule"><?php
      echo tribe_get_start_date ( $event_id, true, 'm/d/Y' ).' @ '.tribe_get_start_time ( $event_id, 'h:i a' ).' - '.tribe_get_end_date ( $event_id, true, 'm/d/Y' ).' @ '.tribe_get_end_time ( $event_id, 'h:i a' );
      if(class_exists( 'Tribe__Events__Pro__Main' )): ?>
          | <a href="#" class="dt-sc-tooltip-top" title="<?php echo tribe_get_recurrence_text ( $event_id ); ?>"><?php esc_html_e('Recurring Event (See all)', 'augury'); ?></a><?php
      endif; ?>
    </p>

    <div class="dt-sc-two-third column first">
      <div class="event-image-wrapper">
          <div class="date-wrapper">
              <p class="event-datetime">
                  <span><?php echo tribe_get_start_date ( $event_id, true, 'd' ).' <i>'.tribe_get_start_date ( $event_id, true, 'M' ).'</i>'; ?></span>
                  <i class="fas fa-clock"></i><?php echo tribe_get_start_time ( $event_id, 'h:i a' ). ' - '.tribe_get_end_time ( $event_id, 'h:i a' ); ?>
              </p>
              <p class="event-venue">
                  <i class="fas fa-map-marker-alt"></i><?php echo tribe_get_venue(); ?>
              </p>
          </div>    
          <?php echo tribe_event_featured_image( $event_id, 'augury-event-single-type1', false ); ?>
      </div>    
      <div class="entry-content">
          <?php 
		  	  do_action( 'tribe_events_single_event_before_the_content' );
			  the_content();
			  do_action( 'tribe_events_single_event_after_the_content' ); ?>
      </div>
    </div>

	<?php do_action( 'tribe_events_single_event_before_the_meta' ); ?>

	<?php do_action( 'tribe_events_single_event_meta_primary_section_start' ); ?>

    <div class="dt-sc-one-third column">
        <h3><?php esc_html_e('Details', 'augury'); ?></h3>
        <ul class="event-details">
            <li>
                <dt><?php esc_html_e('Start:', 'augury'); ?></dt>
                <?php echo tribe_get_start_date ( $event_id, true, 'M d' ).' @ '.tribe_get_start_time ( $event_id, 'h:i a' ); ?>
            </li>
            <li>
                <dt><?php esc_html_e('End:', 'augury'); ?></dt>
                <?php echo tribe_get_end_date ( $event_id, true, 'M d' ).' @ '.tribe_get_end_time ( $event_id, 'h:i a' ); ?>
            </li>
            <?php if ( tribe_get_cost() ) : ?>
                <li><dt><?php esc_html_e('Cost:', 'augury'); ?></dt><?php echo tribe_get_cost( $event_id, true ); ?></li>
            <?php endif; ?>
            <li><?php echo tribe_get_event_categories( $event_id, array( 
                'before' => '', 'sep' => ', ',  'after' => '', 'label' => '',
                'label_before' => '<dt class="cat">Event Category',
                'label_after'  => '</dt>', 'wrap_before' => '<div class="cat-wrapper">', 'wrap_after' => '</div>'
                ) ); ?></li>
            <li><?php echo tribe_meta_event_tags( 'Event Tags:', ', ', false ); ?></li>
            <?php
            $website = tribe_get_event_website_link();
            if(!empty($website)): ?>
                <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_event_website_link', $website ); ?></li><?php
            endif; ?>
        </ul>
        <div class="dt-sc-hr-invisible-xsmall"></div>
        <h3><?php esc_html_e('Organizer', 'augury'); ?></h3>
        <h4><?php
        if(class_exists( 'Tribe__Events__Pro__Main' ))
            echo tribe_get_organizer_link ( $event_id, true, false );
        else
            echo tribe_get_organizer(); ?></h4>
        <ul class="event-organize"><?php
            $phone = tribe_get_organizer_phone();
            if(!empty($phone)): ?>
                <li><dt><?php esc_html_e('Phone:', 'augury'); ?></dt><?php echo esc_html( $phone ); ?></li><?php
            endif;
            $email = tribe_get_organizer_email();
            if(!empty($email)): ?>
                <li>
                    <dt><?php esc_html_e('Email:', 'augury'); ?></dt>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo apply_filters( 'tribe_get_organizer_email', $email); ?></a>
                </li><?php
            endif;
            $website = tribe_get_organizer_website_link();
            if(!empty($website)): ?>
                <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_organizer_website_link',$website ); ?></li><?php
            endif; ?>
        </ul>
        <div class="dt-sc-hr-invisible-xsmall"></div>
        <h3><?php esc_html_e('Venue', 'augury'); ?></h3>
        <h4><?php
        if(class_exists( 'Tribe__Events__Pro__Main' ))
            echo tribe_get_venue_link($event_id, true);
        else
            echo tribe_get_venue($event_id); ?></h4><?php
        if ( tribe_address_exists() ) :
            echo '<p class="event-address">'.tribe_get_full_address().'</p>';
            # Google map link...
            if ( tribe_show_google_map_link() ) :
                echo tribe_get_map_link_html();
                echo '<div class="dt-sc-hr-invisible-xsmall"></div>';
            endif;
        endif; ?>
        <ul class="event-venue"><?php
            $phone = tribe_get_phone();
            if(!empty($phone)): ?>
                <li><dt><?php esc_html_e('Phone:', 'augury'); ?></dt><?php echo esc_html( $phone ); ?></li><?php
            endif;
            $website = tribe_get_venue_website_link();
            if(!empty($website)): ?>
                <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_venue_website_link', $website ); ?></li><?php
            endif; ?>
        </ul><?php
		# Additional fields...
        if(class_exists( 'Tribe__Events__Pro__Main' )):
            do_action( 'tribe_events_single_event_meta_primary_section_end' );
        endif;

        # Google map...
        $map = tribe_get_embedded_map($event_id);
        if(!empty($map)): ?>
            <div class="dt-sc-hr-invisible-xsmall"></div><div class="dt-sc-clear"></div>
            <div class="event-google-map">
                <?php echo apply_filters( 'tribe_get_embedded_map', $map ); ?>
            </div><?php
        endif; ?>
    </div>

	<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>