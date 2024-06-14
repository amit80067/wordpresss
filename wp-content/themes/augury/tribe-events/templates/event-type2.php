	<?php $event_id = get_the_ID(); ?>

	<div class="container">
        <div class="dt-sc-one-fourth column first">
            <div class="date-wrapper">
                <p>
                    <span><?php echo tribe_get_start_date ( $event_id, true, 'd' ); ?></span>
                    <i><?php echo tribe_get_start_date ( $event_id, true, 'F' ); ?><br />
                    <?php echo tribe_get_start_time ( $event_id, 'h:i a' ). ' - '.tribe_get_end_time ( $event_id, 'h:i a' ); ?></i>
                </p>
            </div>
        </div>
        <div class="dt-sc-one-half column ver-sep">
            <h2><?php the_title(); ?></h2><?php
            if(class_exists( 'Tribe__Events__Pro__Main' )): ?>
                <a href="#" class="dt-sc-tooltip-top" title="<?php echo tribe_get_recurrence_text ( $event_id ); ?>"><?php esc_html_e('Recurring Event (See all)', 'augury'); ?></a><?php
            endif; ?>
        </div>
        <div class="dt-sc-one-fourth column right-calc">
            <a href="<?php echo esc_url( tribe_get_gcal_link($event_id) ); ?>"><?php esc_html_e('+ Google Calendar', 'augury'); ?></a><br />
            <a href="<?php echo esc_url( tribe_get_ical_link() ); ?>"><?php esc_html_e('+ iCal Export', 'augury'); ?></a>
        </div>
	</div>        

	<div class="dt-sc-hr-invisible-xsmall"></div>
	<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

	<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>

	<?php do_action( 'tribe_events_single_event_meta_primary_section_start' ); ?>

	<div class="event-content-wrapper">	
    	<div class="container">
            <div class="dt-sc-one-third column first">
                <div class="event-details">
                    <h3><?php esc_html_e('Details', 'augury'); ?></h3>
                    <ul>
                        <li><dt><?php esc_html_e('Start:', 'augury'); ?></dt><?php echo tribe_get_start_date ( $event_id, true, 'M d' ).' @ '.tribe_get_start_time ( $event_id, 'h:i a' ); ?></li>
                        <li><dt><?php esc_html_e('End:', 'augury'); ?></dt><?php echo tribe_get_end_date ( $event_id, true, 'M d' ).' @ '.tribe_get_end_time ( $event_id, 'h:i a' ); ?></li>
                        <?php if ( tribe_get_cost() ) : ?>
                            <li><dt><?php esc_html_e('Cost:', 'augury'); ?></dt><?php echo tribe_get_cost( $event_id, true ); ?></li>
                        <?php endif; ?>
                        <li><?php echo tribe_get_event_categories( $event_id, array( 'before' => '', 'sep' => ', ',  'after' => '', 'label' => '', 'label_before' => '<dt class="cat">Event Category',
                                                                                     'label_after'  => '</dt>', 'wrap_before' => '<div class="cat-wrapper">', 'wrap_after' => '</div>' )); ?></li>
                        <li><?php echo tribe_meta_event_tags( 'Event Tags:', ', ', false ); ?></li>
                        <?php
                        $website = tribe_get_event_website_link();
                        if(!empty($website)): ?>
                            <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_event_website_link',$website ); ?></li><?php
                        endif; ?>
                    </ul>
                </div>    
            </div>
        
            <div class="dt-sc-one-third column">
                <div class="event-organize">
                    <h3><?php esc_html_e('Organizer', 'augury'); ?></h3>
                    <h4><?php
                    if(class_exists( 'Tribe__Events__Pro__Main' ))
                        echo tribe_get_organizer_link ( $event_id, true, false );
                    else
                        echo tribe_get_organizer(); ?></h4>
                    <ul><?php
                        $phone = tribe_get_organizer_phone();
                        if(!empty($phone)): ?>
                            <li><dt><?php esc_html_e('Phone:', 'augury'); ?></dt><?php echo esc_html($phone); ?></li><?php
                        endif;
                        $email = tribe_get_organizer_email();
                        if(!empty($email)): ?>
                            <li><dt><?php esc_html_e('Email:', 'augury'); ?></dt><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo apply_filters( 'tribe_get_organizer_email', $email); ?></a></li><?php
                        endif;
                        $website = tribe_get_organizer_website_link();
                        if(!empty($website)): ?>
                            <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_organizer_website_link', $website); ?></li><?php
                        endif; ?>
                    </ul>
                </div>    
	        </div>
        
            <div class="dt-sc-one-third column">
                <div class="event-venue">
                    <h3><?php esc_html_e('Venue', 'augury'); ?></h3>
                    <ul><?php
                        if(tribe_address_exists()): ?>
                            <li><dt><?php esc_html_e('Address:', 'augury'); ?></dt>
                            <div class="event-addr"><?php
                                if(class_exists( 'Tribe__Events__Pro__Main' ))
                                    echo tribe_get_venue_link($event_id, true);
                                else
                                    echo tribe_get_venue($event_id);
                                echo tribe_get_full_address();
                                # Google map link...
                                if ( tribe_show_google_map_link() ) :
                                    echo '<div class="dt-sc-clear"></div>'.tribe_get_map_link_html();
                                endif; ?>
                            </div></li><?php
                        endif;
                        $phone = tribe_get_phone();
                        if(!empty($phone)): ?>
                            <li><dt><?php esc_html_e('Phone:', 'augury'); ?></dt><?php echo esc_html($phone); ?></li><?php
                        endif;
                        $website = tribe_get_venue_website_link();
                        if(!empty($website)): ?>
                            <li><dt><?php esc_html_e('Website:', 'augury'); ?></dt><?php echo apply_filters( 'tribe_get_venue_website_link', $website); ?></li><?php
                        endif; ?>
                    </ul><?php
					# Additional fields...
					if(class_exists( 'Tribe__Events__Pro__Main' )):
						do_action( 'tribe_events_single_event_meta_primary_section_end' );
					endif; ?>
                </div>
            </div>
        </div>
    </div>    

	<div class="dt-sc-clear"></div><?php
	# Google map...
	$map = tribe_get_embedded_map($event_id);
	if(!empty($map)): ?>
		<div class="event-google-map">
			<?php echo apply_filters( 'tribe_get_embedded_map', $map); ?>
		</div><?php
	endif; ?>
	<div class="dt-sc-hr-invisible-small"></div>
    <div class="container">
    	<?php 
			do_action( 'tribe_events_single_event_before_the_content' );
			the_content();
			do_action( 'tribe_events_single_event_after_the_content' );

			do_action( 'tribe_events_single_event_after_the_meta' ) ?>
	</div>