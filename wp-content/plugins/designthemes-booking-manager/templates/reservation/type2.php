<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}
?>
<!-- Reservation -->
<?php
    $staffids = isset($_REQUEST['staff']) ? $_REQUEST['staff'] : '';
    $serviceids = isset($_REQUEST['services']) ? $_REQUEST['services'] : '';

    $firstname = isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : '';
    $lastname = isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : '';
    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
    $emailid = isset($_REQUEST['emailid']) ? $_REQUEST['emailid'] : '';
    $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';

    //about your project
    $about_your_project = isset($_REQUEST['about_your_project']) ? $_REQUEST['about_your_project'] : '';
    $contact_info_data = '';

    if($firstname == '') { 
        $from_step1 = 'true'; 
        $servicebox_style = ''; 
        $contactbox_style = 'style="display:none;"'; 

        $gobackbox_style = 'style="display:none;"'; 
        $step_value = 1; 
        $current_step1 = 'dt-sc-current-step';
        $current_step2 = '';
        $completed_step = '';
        $timeslotbox_style = 'style="display:none;"';
    } else { 
        $from_step1 = 'false'; 
        $servicebox_style = 'style="display:none;"'; 
        $contactbox_style = '';
        $gobackbox_style = '';
        $step_value = 2;
        $current_step1 = '';
        $current_step2 = 'dt-sc-current-step';
        $completed_step = 'dt-sc-completed-step';

        $contact_info_data = '<ul>';
            if($firstname != '') { $contact_info_data .= '<li>'.$firstname.' '.$lastname.'</li>'; }
            if($phone != '') { $contact_info_data .= '<li>'.$phone.'</li>'; }
            if($emailid != '') { $contact_info_data .= '<li>'.$emailid.'</li>'; }
            if($address != '') { $contact_info_data .= '<li>'.$address.'</li>'; }
            if($about_your_project != '') { $contact_info_data .= '<li>'.$about_your_project.'</li>'; }
        $contact_info_data .= '</ul>';
    }?>
    <div class="dt-sc-reserve-appointment2 <?php echo esc_attr($class); ?>"><?php
        // Appointment title...
        if( $title != '')
            echo '<h2 class="appointment-title">'.$title.'</h2>'; ?>

        <div class="dt-sc-clear"></div>
    
        <div class="dt-sc-schedule-progress-wrapper">
    
            <div class="dt-sc-schedule-progress step1 <?php echo esc_attr($current_step1.' '.$completed_step); ?>">
                <div class="dt-sc-progress-step">
                    <span>1</span>
                </div>
                <h4><?php echo esc_html__('Select Date / Time slot', 'dt-booking-manager'); ?></h4>
                <p><?php echo esc_html__('Choose the type of service and your staff along with the time slot', 'dt-booking-manager'); ?></p>
            </div>
    
            <div class="dt-sc-schedule-progress step2 <?php echo esc_attr($current_step2); ?>">
                <div class="dt-sc-progress-step">
                    <span>2</span>
                </div>
                <h4><?php echo esc_html__('Fill Contact Details', 'dt-booking-manager'); ?></h4>
                <p><?php echo esc_html__('Fill in your personal details and brief description of your treatment needed', 'dt-booking-manager'); ?></p>
            </div>
    
            <div class="dt-sc-schedule-progress step3">
                <div class="dt-sc-progress-step">
                    <span>3</span>
                </div>
                <h4><?php echo esc_html__('Check Details', 'dt-booking-manager'); ?></h4>
                <p><?php echo esc_html__('Proof read the details about the choosen staff, service & personal details', 'dt-booking-manager'); ?></p>
            </div>                    
        </div>
    
        <div class="dt-sc-hr-invisible-small"></div>
        <div class="dt-sc-clear"></div>

        <p class="dt-sc-info-box"><?php esc_html_e('All fields are mandatory','dt-booking-manager');?></p>

        <div class="dt-sc-hr-invisible-small"></div>
        <div class="dt-sc-clear"></div>

        <div class="dt-sc-goback-box" <?php echo ($gobackbox_style); ?>>
            <input class="appointment-goback" value="<?php echo esc_html__('Go Back and edit', 'dt-booking-manager'); ?>" type="button" />
            <input type="hidden" value="<?php echo esc_attr($from_step1); ?>" name="appointment-step-checker"  id="appointment-step-checker"  />
            <input type="hidden" value="<?php echo esc_attr($step_value); ?>" name="appointment-step"  id="appointment-step"  />
        </div>
    
        <div class="dt-sc-schedule-box steps step1" <?php echo ($servicebox_style); ?>>
            <h2><?php echo esc_html__('Select Service & Date', 'dt-booking-manager'); ?></h2>
            <div class="dt-sc-single-border-separator"></div>
            <div class="dt-sc-hr-invisible-xsmall"></div>

            <div class="dt-sc-service-box" <?php echo ($servicebox_style); ?>>
                <form class="dt-sc-appointment-scheduler-form" name="dt-sc-appointment-scheduler-form" method="post">
                    <div class="column dt-sc-one-third first">
                        <select name="serviceid" id="serviceid" class="dt-select-service">
                            <option value=""><?php echo esc_html__('Select Service', 'dt-booking-manager'); ?></option><?php
                                $services_args = array('post_type'=>'dt_service', 'posts_per_page'=>'-1' , 'suppress_filters' => false );
                                if($serviceids != '') {
                                    $serviceids_arr = explode(',', $serviceids);
                                    $services_args['post__in'] = $serviceids_arr;
                                }

                                $cp_services = get_posts( $services_args );
                                if( $cp_services ) {
                                    foreach( $cp_services as $cp_service ) {
                                        $id = $cp_service->ID;

                                        $service_settings = get_post_meta($id, '_custom_settings', true);
                                        $service_settings = is_array ( $service_settings ) ? $service_settings : array ();

                                        $title = $cp_service->post_title; ?>
                                        <option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['services'])) { echo selected($_REQUEST['services'], $id, false); } ?>><?php echo esc_html($title);                   if( array_key_exists('service-price', $service_settings) ):
                                            echo ' - '.dt_booking_get_formatted_price( $service_settings['service-price'] );
                                        endif; ?></option><?php
                                    }
                                }?>
                        </select>
                    </div>
                    <div class="column dt-sc-one-third">
                        <select name="staffid" id="staffid" class="dt-select-staff">
                            <option value=""><?php echo esc_html__('Select Staff','dt-booking-manager'); ?></option><?php
                            $staffs_args = array(
                                'post_type' => 'dt_person',
                                'posts_per_page' => '-1',
                                'meta_query'=>array() );
    
                            if($staffids != '') {
                                $staffids_arr = explode(',', $staffids);
                                $staffs_args['post__in'] = $staffids_arr;
                            }
    
                            if(isset($_REQUEST['serviceid'])) {
                                $staffs_args['meta_query'][] = array(
                                    'key'     => '_dt_booking_person_services',
                                    'value'   =>  $_REQUEST['serviceid'],
                                    'compare' => 'LIKE'
                                );
                            }

                            $cp_staffs = get_posts( $staffs_args );
                            if( $cp_staffs ) {
                                foreach( $cp_staffs as $cp_staff ) {
                                    $id = $cp_staff->ID;

                                    $person_settings = get_post_meta($id, '_custom_settings', true);
                                    $person_settings = is_array ( $person_settings ) ? $person_settings : array ();

                                    $title = $cp_staff->post_title; ?>
                                    <option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['staff'])) { echo selected($_REQUEST['staff'], $id, false); } ?>><?php echo esc_html($title);                     if( array_key_exists('person-price', $person_settings) ):
                                        echo ' - '.dt_booking_get_formatted_price( $person_settings['person-price'] );
                                    endif; ?></option><?php
                                }
                            }?>
                        </select>
                    </div>
                    <div class="column dt-sc-one-third">
                        <div class="selection-box form-calender-icon">
                            <span class="far fa-calendar-alt"></span>
                            <input type="text" id="datepicker" name="date" value="<?php if(isset($_REQUEST['date'])) echo esc_attr($_REQUEST['date']); else echo esc_html__('Select Date', 'dt-booking-manager'); ?>" required />
                        </div>
                    </div>
    
                    <p class="aligncenter"><input class="generate-schedule dt-sc-button medium bordered" value="<?php echo esc_html__('Check available time', 'dt-booking-manager'); ?>" type="button" /></p>
                    <input type="hidden" id="staffids" name="staffids" value="<?php echo esc_attr($staffids); ?>" />
                    <input type="hidden" id="serviceids" name="serviceids" value="<?php echo esc_attr($serviceids); ?>" />
                </form>
            </div>
    
            <div class="dt-sc-timeslot-box" <?php echo ($timeslotbox_style); ?>>
                <div class="appointment-ajax-holder"></div>
            </div>
        </div>
    
        <div class="dt-sc-contactdetails-box steps step2" <?php echo ($contactbox_style); ?>>
            <div class="border-title"><h2><?php echo esc_html__('Contact Details', 'dt-booking-manager'); ?></h2></div>
            <form class="dt-sc-appointment-contactdetails-form" name="dt-sc-appointment-contactdetails-form" method="post">
                <div class="column dt-sc-one-half first">
                    <input type="text" id="firstname" name="firstname" value="<?php echo esc_attr($firstname); ?>" placeholder="<?php echo esc_html__('Name', 'dt-booking-manager'); ?>" required />
                </div>
                <div class="column dt-sc-one-half">
                    <input type="text" id="lastname" name="lastname" value="<?php echo esc_attr($lastname); ?>" placeholder="<?php echo esc_html__('Last Name', 'dt-booking-manager'); ?>" required />
                </div>
                <div class="column dt-sc-one-half first">
                    <input type="text" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" placeholder="<?php echo esc_html__('Phone', 'dt-booking-manager'); ?>" required />
                </div>
                <div class="column dt-sc-one-half">
                    <input type="text" id="emailid" name="emailid" value="<?php echo esc_attr($emailid); ?>" placeholder="<?php echo esc_html__('Email', 'dt-booking-manager'); ?>" required />
                </div>
                <div class="column dt-sc-one-column first">
                    <input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>" placeholder="<?php echo esc_html__('Address', 'dt-booking-manager'); ?>" required />
                </div>
    
                <p><?php echo esc_html('A brief description about your reason of visit','dt-booking-manager'); ?></p>
    
                <div class="column dt-sc-one-column first">
                    <textarea id="about_your_project" name="about_your_project" placeholder="<?php echo esc_html__('Message', 'dt-booking-manager'); ?>" required><?php echo esc_attr($about_your_project); ?></textarea>
                </div>
    
                <p class="aligncenter"><!-- <input class="generate-servicebox dt-sc-button medium bordered" value="<?php echo esc_html__('Submit Details', 'dt-booking-manager'); ?>" type="submit" /> -->
                <button class="generate-servicebox dt-sc-button medium bordered submit-details" type="button" ><?php echo esc_html__('Submit Details', 'dt-booking-manager'); ?></button>
                </p>
            </form>
        </div>
    
        <div class="dt-sc-notification-box steps step3" style="display:none;">
    
            <div class="border-title"><h2><?php echo esc_html__('Confirm Details', 'dt-booking-manager'); ?></h2></div>
    
            <div class="column dt-sc-one-half dt-sc-notification-details dt-sc-notification-schedulebox first">
                <div class="dt-sc-schedule-details" id="dt-sc-schedule-details"></div>
            </div>
    
            <div class="column dt-sc-one-half dt-sc-notification-details dt-sc-notification-contactbox ">
                <div class="dt-sc-contact-info" id="dt-sc-contact-info"><?php echo ($contact_info_data); ?></div>
            </div>
    
            <div class="dt-sc-clear"></div>
    
            <div class="dt-sc-aboutproject-box">
                <input type="hidden" id="hid_firstname" name="hid_firstname" value="<?php echo esc_attr($firstname); ?>" />
                <input type="hidden" id="hid_lastname" name="hid_lastname" value="<?php echo esc_attr($lastname); ?>" />
                <input type="hidden" id="hid_phone" name="hid_phone" value="<?php echo esc_attr($phone); ?>" />
                <input type="hidden" id="hid_emailid" name="hid_emailid" value="<?php echo esc_attr($emailid); ?>" />
                <input type="hidden" id="hid_address" name="hid_address" value="<?php echo esc_attr($address); ?>" />
                <input type="hidden" id="hid_about_your_project" name="hid_about_your_project" value="<?php echo esc_attr($about_your_project); ?>" />
    
                <div id="dt-sc-ajax-load-image" style="display:none;"><img src="<?php echo DTBOOKINGMANAGER_URL .'/css/images/loading_icon.gif'; ?>" alt="<?php esc_attr_e('loading', 'dt-booking-manager'); ?>" /></div>
    
                <form class="dt-sc-about-project-form" name="dt-sc-about-project-form" method="post">
                    <p class="aligncenter">
                        <input class="schedule-it dt-sc-button medium bordered" value="<?php echo esc_html__('Check & Confirm', 'dt-booking-manager'); ?>" type="submit" />
                    </p>
                </form>
            </div>

            <div class="dt-sc-clear"></div>

            <div class="dt-sc-apt-success-box dt-sc-success-box" style="display:none;"><?php
                $success = cs_get_option('success_message');
                $success = stripslashes($success);
                echo !empty($success) ? $success : '';?>
            </div>
            <div class="dt-sc-apt-error-box dt-sc-error-box" style="display:none;"><?php
                $error= cs_get_option('error_message');
                $error = stripslashes($error);
                echo !empty($error) ? $error : '';?>
            </div>
        </div><!-- Reservation -->
    </div>