<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}
?>
<div class="dt-sc-reserve-appointment type1 <?php echo esc_attr($class); ?>"><?php
    // Appointment title...
    if( $title != '')
        echo '<h2 class="appointment-title">'.$title.'</h2>';

    global $post;

    if( isset($_REQUEST['action'] ) && ( $_REQUEST['action'] === "success" || $_REQUEST['action'] === "error" ) ):
        if( $_REQUEST['action'] === "success" ):
            $successmsg = cs_get_option('success_message');
            $successmsg = isset($successmsg) ? '<div class="dt-sc-success-box">'.$successmsg.'</div>' : '';
            echo ($successmsg);

            $page_id = $post->ID;
            $page_link = get_page_link($page_id);
            _e('<p>To continue or make another one, please click this button</p>','dt-booking-manager');
            echo '<a href="'.esc_url($page_link).'" class="dt-sc-button" title="'.esc_attr__('Back to Reservation', 'dt-booking-manager').'">'.esc_html__('Back to Reservation', 'dt-booking-manager').'</a>';
        elseif( $_REQUEST['action'] === "error" ):
            $errormsg = cs_get_option('error_message');
            $errormsg = isset($errormsg) ? '<div class="dt-sc-error-box">'.$errormsg.'</div>' : '';
            echo ($errormsg);
        endif;
    else:
        $staffids = isset($_REQUEST['staffids']) ? $_REQUEST['staffids'] : '';
        $serviceids = isset($_REQUEST['serviceids']) ? $_REQUEST['serviceids'] : '';

        $time_format = get_option( 'time_format' );
        $fetch_start_time = isset($_REQUEST['start-time']) ? date($time_format, strtotime($_REQUEST['start-time'])) : date($time_format, strtotime('8:00 am'));
        $fetch_end_time = isset($_REQUEST['end-time']) ? $_REQUEST['end-time'] : '';?>

        <input type="hidden" id="hidden-end-time" name="hidden-end-time" value="<?php echo esc_attr($fetch_end_time); ?>">

        <div class="column dt-sc-one-half first">
            <h5><?php esc_html_e('Available Services','dt-booking-manager');?></h5>
            <select name="services" class="dt-select-service">
                <option value=""><?php esc_html_e('Select','dt-booking-manager');?></option><?php
                $services_args = array('post_type'=>'dt_service', 'posts_per_page'=>'-1', 'suppress_filters' => false, 'orderby' => 'title' );
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
                        <option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['services'])) echo selected($_REQUEST['services'], $id, false); ?>><?php echo esc_html($title);                       if( array_key_exists('service-price', $service_settings) ):
                            echo ' - '.dt_booking_get_formatted_price( $service_settings['service-price'] );
                        endif; ?></option><?php
                    }
                }?>
            </select>
        </div>

        <div class="column dt-sc-one-half">
            <h5><?php esc_html_e('Staffs','dt-booking-manager');?></h5>
            <select name="staff" class="dt-select-staff">
                <option value=""><?php esc_html_e('Select','dt-booking-manager');?></option><?php
                $staffs_args = array( 'post_type' => 'dt_person', 'posts_per_page' => '-1', 'meta_query' => array() );

                if($staffids != '') {
                    $staffids_arr = explode(',', $staffids);
                    $staffs_args['post__in'] = $staffids_arr;
                }

                if(isset($_REQUEST['services'])) {
                    $staffs_args['meta_query'][] = array(
                        'key'     => '_dt_booking_person_services',
                        'value'   =>  $_REQUEST['services'],
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
                        <option value="<?php echo esc_attr($id); ?>" <?php if(isset($_REQUEST['staff'])) echo selected($_REQUEST['staff'], $id, false); ?>><?php echo esc_html($title);                         
                        if( array_key_exists('person-price', $person_settings) ):
                            echo ' - '.dt_booking_get_formatted_price( $person_settings['person-price'] );
                        endif; ?></option><?php
                    }
                }?>
            </select>
        </div>

        <div class="dt-sc-hr-invisible-small"> </div>
        <div class="dt-sc-clear"> </div>
        <div class="dt-sc-title"><h3><?php esc_html_e('Time','dt-booking-manager');?></h3></div>
        <div class="dt-sc-hr-invisible-very-small"> </div>
        <div class="dt-sc-clear"> </div>

        <div class="column dt-sc-one-third first">
            <h5><?php esc_html_e('I am available on','dt-booking-manager');?></h5>
            <p class="form-calender-icon"><span class="far fa-calendar-alt"></span><input type="text" id="datepicker" name="date" value="<?php if(isset($_REQUEST['date'])) echo esc_attr($_REQUEST['date']); else echo date('Y-m-d'); ?>"/></p>
        </div>

        <div class="column dt-sc-one-third">
            <h5><?php esc_html_e('Start :','dt-booking-manager');?></h5><?php
                $time_format = get_option( 'time_format' ); 
                $fetch_start_time = isset($_REQUEST['start-time']) ? date($time_format, strtotime($_REQUEST['start-time'])) : date($time_format, strtotime('8:00 am'));
                $fetch_end_time = isset($_REQUEST['end-time']) ? date($time_format, strtotime($_REQUEST['end-time'])) : date($time_format, strtotime('11:00 pm'));
                $selected = 'selected="selected"'; ?>
            <select name="start-time" class='start-time'>
                <option value="00:00" <?php if( $fetch_start_time == date($time_format, strtotime('12:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('12:00 am')); ?></option>    
                <option value="01:00" <?php if( $fetch_start_time == date($time_format, strtotime('1:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('1:00 am')); ?></option>
                <option value="02:00" <?php if( $fetch_start_time == date($time_format, strtotime('2:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('2:00 am')); ?></option>
                <option value="03:00" <?php if( $fetch_start_time == date($time_format, strtotime('3:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('3:00 am')); ?></option>
                <option value="04:00" <?php if( $fetch_start_time == date($time_format, strtotime('4:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('4:00 am')); ?></option>
                <option value="05:00" <?php if( $fetch_start_time == date($time_format, strtotime('5:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('5:00 am')); ?></option>
                <option value="06:00" <?php if( $fetch_start_time == date($time_format, strtotime('6:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('6:00 am')); ?></option>
                <option value="07:00" <?php if( $fetch_start_time == date($time_format, strtotime('7:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('7:00 am')); ?></option>
                <option value="08:00" <?php if( $fetch_start_time == date($time_format, strtotime('8:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('8:00 am')); ?></option>
                <option value="09:00" <?php if( $fetch_start_time == date($time_format, strtotime('9:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('9:00 am')); ?></option>
                <option value="10:00" <?php if( $fetch_start_time == date($time_format, strtotime('10:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('10:00 am')); ?></option>
                <option value="11:00" <?php if( $fetch_start_time == date($time_format, strtotime('11:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('11:00 am')); ?></option>
                <option value="12:00" <?php if( $fetch_start_time == date($time_format, strtotime('12:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('12:00 pm')); ?></option>
                <option value="13:00" <?php if( $fetch_start_time == date($time_format, strtotime('1:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('1:00 pm')); ?></option>
                <option value="14:00" <?php if( $fetch_start_time == date($time_format, strtotime('2:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('2:00 pm')); ?></option>
                <option value="15:00" <?php if( $fetch_start_time == date($time_format, strtotime('3:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('3:00 pm')); ?></option>
                <option value="16:00" <?php if( $fetch_start_time == date($time_format, strtotime('4:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('4:00 pm')); ?></option>
                <option value="17:00" <?php if( $fetch_start_time == date($time_format, strtotime('5:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('5:00 pm')); ?></option>
                <option value="18:00" <?php if( $fetch_start_time == date($time_format, strtotime('6:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('6:00 pm')); ?></option>
                <option value="19:00" <?php if( $fetch_start_time == date($time_format, strtotime('7:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('7:00 pm')); ?></option>
                <option value="20:00" <?php if( $fetch_start_time == date($time_format, strtotime('8:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('8:00 pm')); ?></option>
                <option value="21:00" <?php if( $fetch_start_time == date($time_format, strtotime('9:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('9:00 pm')); ?></option>
                <option value="22:00" <?php if( $fetch_start_time == date($time_format, strtotime('10:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('10:00 pm')); ?></option>
                <option value="23:00" <?php if( $fetch_start_time == date($time_format, strtotime('11:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('11:00 pm')); ?></option>
            </select>
        </div>

        <div class="column dt-sc-one-third">
            <h5><?php esc_html_e('End :','dt-booking-manager');?></h5>
            <select name="end-time" class='end-time'>
                <option value="09:00" <?php if( $fetch_end_time == date($time_format, strtotime('9:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('9:00 am')); ?></option>    
                <option value="10:00" <?php if( $fetch_end_time == date($time_format, strtotime('10:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('10:00 am')); ?></option>  
                <option value="11:00" <?php if( $fetch_end_time == date($time_format, strtotime('11:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('11:00 am')); ?></option>  
                <option value="12:00" <?php if( $fetch_end_time == date($time_format, strtotime('12:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('12:00 pm')); ?></option>
                <option value="13:00" <?php if( $fetch_end_time == date($time_format, strtotime('1:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('1:00 pm')); ?></option>    
                <option value="14:00" <?php if( $fetch_end_time == date($time_format, strtotime('2:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('2:00 pm')); ?></option>    
                <option value="15:00" <?php if( $fetch_end_time == date($time_format, strtotime('3:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('3:00 pm')); ?></option>    
                <option value="16:00" <?php if( $fetch_end_time == date($time_format, strtotime('4:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('4:00 pmm')); ?></option>
                <option value="17:00" <?php if( $fetch_end_time == date($time_format, strtotime('5:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('5:00 pm')); ?></option>    
                <option value="18:00" <?php if( $fetch_end_time == date($time_format, strtotime('6:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('6:00 pm')); ?></option>    
                <option value="19:00" <?php if( $fetch_end_time == date($time_format, strtotime('7:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('7:00 pm')); ?></option>    
                <option value="20:00" <?php if( $fetch_end_time == date($time_format, strtotime('8:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('8:00 pm')); ?></option>
                <option value="21:00" <?php if( $fetch_end_time == date($time_format, strtotime('9:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('9:00 pm')); ?></option>    
                <option value="22:00" <?php if( $fetch_end_time == date($time_format, strtotime('10:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('10:00 pm')); ?></option> 
                <option value="23:00" <?php if( $fetch_end_time == date($time_format, strtotime('11:00 pm')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('11:00 pm')); ?></option> 
                <option value="23:59" <?php if( $fetch_end_time == date($time_format, strtotime('12:00 am')) ){ echo ($selected); } ?>><?php echo date($time_format, strtotime('12:00 am')); ?></option>
            </select>
        </div>

        <div class="dt-sc-clear"></div>

        <p class="aligncenter"><a href="#" class="dt-sc-button medium bordered show-time"><?php esc_html_e('Show Time','dt-booking-manager');?></a></p>

        <div class="dt-sc-hr-invisible-large"> </div>
        <div class="dt-sc-clear"> </div> 
        <div class="available-times"></div>

        <div id="personalinfo" class="personal-info" style="display:none;">
            <form name="frm-booking-reserve-default" class="dt-sc-booking-reservation default" id="dt-sc-booking-reservation">
                <div class="dt-sc-title"><h3><?php esc_html_e('Personal Info','dt-booking-manager');?></h3></div>
                <div class="dt-sc-hr-invisible-very-small"> </div>
                <div class="dt-sc-clear"> </div>

                <div class="column dt-sc-one-half first">
                    <p><input type="text" name="name" value="<?php if(isset($_REQUEST['cli-name'])) echo esc_attr($_REQUEST['cli-name']); ?>" placeholder="<?php esc_attr_e('Name:','dt-booking-manager');?>"></p>
                </div>
                <div class="column dt-sc-one-half">
                    <p><input type="email" name="email" value="<?php if(isset($_REQUEST['cli-email'])) echo esc_attr($_REQUEST['cli-email']); ?>" required placeholder="<?php esc_attr_e('Email:','dt-booking-manager');?>"></p>
                </div>
                <div class="column dt-sc-one-half first">
                    <p><input type="text" name="phone" value="<?php if(isset($_REQUEST['cli-phone'])) echo esc_attr($_REQUEST['cli-phone']); ?>" required placeholder="<?php esc_attr_e('Phone:','dt-booking-manager');?>"></p>
                </div>
                <div class="column dt-sc-one-half">
                    <div class="choose-payment" style="display:none;"><?php
                        $payatarrival = cs_get_option('enable-pay-at-arrival');
                        $paypal = cs_get_option('enable-paypal');?>
                        <select name="payment_type">
                            <option value=""><?php esc_html_e('Choose Payment','dt-booking-manager');?></option>
                            <?php if( !empty($payatarrival) ): ?>
                                <option value="local"><?php esc_html_e('Pay At Arrival','dt-booking-manager');?></option>
                            <?php endif;?>
                            <?php if( !empty($paypal) ): ?>
                                <option value="paypal"><?php esc_html_e('Pay with Paypal','dt-booking-manager');?></option>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                <textarea name="note" placeholder="<?php esc_attr_e('Note:','dt-booking-manager');?>"><?php if(isset($_REQUEST['cli-msg'])) echo esc_attr($_REQUEST['cli-msg']); ?></textarea>
                <?php $temp = $ctemp = rand(3212, 8787); $temp = str_split($temp, 1); ?>

                <div class="column dt-sc-one-half first">
                    <p><input type="text" name="captcha" required  placeholder="<?php esc_attr_e('Captcha','dt-booking-manager');?>"></p>
                    <input type="hidden" name="hiddencaptcha" id="hiddencaptcha" readonly="readonly" value="<?php echo esc_attr($ctemp);?>"/>
                </div>

                <div class="column dt-sc-one-half">
                    <p><span class="dt-sc-captcha">
                        <?php echo esc_html($temp[0]);?>
                        <sup><?php echo esc_html($temp[1]);?></sup>
                        <?php echo esc_html($temp[2]);?>
                        <sub><?php echo esc_html($temp[3]);?></sub>
                    </span></p>
                </div>

                <div class="dt-sc-clear"> </div>
                <p class="aligncenter"><!-- <input type="submit" name="subscheduleit" class="dt-sc-button medium bordered schedule-it" style="display:none;" value="<php esc_html_e('Schedule It', 'dt-booking-manager'); ?>" /> -->
                <button type="button" name="subscheduleit" class="dt-sc-button medium bordered schedule-it" style="display:none;"><?php esc_html_e('Schedule It', 'dt-booking-manager'); ?></button>
                </p>
            </form>
        </div><?php
    endif;?></div>