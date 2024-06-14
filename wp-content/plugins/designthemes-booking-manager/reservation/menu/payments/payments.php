<?php
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class PaymentsListTable extends WP_List_Table {
	var $payments_data = array();

	function __construct(){
		global $status, $page;

		global $wpdb;
		$payments = "SELECT option_id, option_name,option_value FROM $wpdb->options WHERE option_name LIKE '_dt_payment_mid_%' ORDER BY option_id ASC";
		$rows = $wpdb->get_results( $payments );
		if($rows):
			foreach( $rows as $row ){
				$option = get_option($row->option_name);
				$this->payments_data[] = array(
					'ID' => $row->option_id,
					'customer' => get_the_title($option['customer_id']),
					'amount' => $option['total'],
					'type' => $option['type'],
					'service' => $option['service'],
					'paypal_status' =>  isset( $option['status'] ) ? $option['status'] : '-' ,
					'paypal_transaction_id' =>  isset( $option['transaction_id'] ) ? $option['transaction_id'] : '-',
					'time' => $option['date']
				);
			}
		endif;

		parent::__construct( array(
			'singular'  => __( 'payment', 'dt-booking-manager' ),     //singular name of the listed records
            'plural'    => __( 'payments', 'dt-booking-manager' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
    	) );
	}

  	function column_default( $item, $column_name ) {
  		switch( $column_name ) { 
  			case 'customer':
  			case 'amount':
  			case 'type':
  			case 'service':
  			case 'time':
  			case 'paypal_status':
  			#case 'paypal_token':
  			case 'paypal_transaction_id':
  				return $item[ $column_name ];
  			default:
  				return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    	}
	}
	
	function column_cb( $item ) {
	  return sprintf(
		'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
	  );
	}
	
	public function get_bulk_actions() {
	  $actions = [
		'bulk-delete' => __('Delete', 'dt-booking-manager')
	  ];
	
	  return $actions;
	}

	function get_columns() {

		$columns = array(
			'cb'        => '<input type="checkbox" />',
            'customer'  => __( 'Customer', 'dt-booking-manager' ),
            'amount'    => __( 'Amount (', 'dt-booking-manager' ).cs_get_option('book-currency').')',
            'type'      => __( 'Type', 'dt-booking-manager' ),
            'service'   => __( 'Service', 'dt-booking-manager' ),
            'paypal_status'	=> __( 'Status', 'dt-booking-manager'),
            'paypal_transaction_id' => __('Transaction Id','dt-booking-manager'),
           	'time'      => __( 'Time', 'dt-booking-manager' )
        );
        return $columns;
    }

	function no_items() {
  		_e( 'No payments found, dude.', 'dt-booking-manager' );
	}

	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		$this->process_bulk_action();

		usort( $this->payments_data, array( &$this, 'usort_reorder' ) );
		
		$this->items = $this->payments_data;		
	}

	function get_sortable_columns() {
		$sortable_columns = array(
			'customer'  => array('customer',false),
			'type' => array('type',false),
			'time' => array('time',false),
			'service'   => array('service',false),
			'paypal_status' => array('paypal_status',false)
		);
		return $sortable_columns;
	}

	function usort_reorder( $a, $b ) {

		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'customer';

		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';

		// Determine sort order
  		$result = strcmp( $a[$orderby], $b[$orderby] );

  		// Send final sort direction to usort
  		return ( $order === 'asc' ) ? $result : -$result;
	}


    function column_customer($item) {
    	
    	$actions = array(
    		'delete' => sprintf('<a href="%s&action=%s&payment=%s">%s</a>','?post_type=dt_customers&page=dt_payments&noheader=true','delete',$item['ID'], __('Trash','dt-booking-manager')),
    	);

    	return sprintf('%1$s %2$s', $item['customer'], $this->row_actions($actions) );
    }

    function process_bulk_action() {
        if( 'delete'=== $this->current_action() ) {
			
      	    global $wpdb;
        	$option_id = $_REQUEST['payment'];
        	$action = $wpdb->delete( 'wp_options', array( 'option_id' => $option_id ) );

        	wp_redirect(admin_url('edit.php?post_type=dt_customers&page=dt_payments', 'admin'), 301);
        }

		if( 'bulk-delete'=== $this->current_action() ) {

			global $wpdb;
			$delete_ids = esc_sql( $_REQUEST['bulk-delete'] );
			foreach ( $delete_ids as $option_id ) {
     			$action = $wpdb->delete( 'wp_options', array( 'option_id' => $option_id ) );
		    }

			wp_redirect(admin_url('edit.php?post_type=dt_customers&page=dt_payments', 'admin'), 301);
		}
    }
}