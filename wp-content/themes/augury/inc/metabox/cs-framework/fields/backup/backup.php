<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class DTMFramework_Option_backup extends DTMFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo "{$this->element_before()}";

    echo '<textarea name="'. $this->unique .'[import]"'. $this->element_class() . $this->element_attributes() .'></textarea>';
    submit_button( esc_html__( 'Import a Backup', 'augury' ), 'primary cs-import-backup', 'backup', false );
    echo '<small>( '. esc_html__( 'copy-paste your backup string here', 'augury' ).' )</small>';

    echo '<hr />';

    echo '<textarea name="_nonce"'. $this->element_class() . $this->element_attributes() .' disabled="disabled">'. cs_encode_string( get_option( $this->unique ) ) .'</textarea>';
    echo '<a href="'. esc_url( admin_url( 'admin-ajax.php?action=cs-export-options' ) ).'" class="button button-primary" target="_blank">'. esc_html__( 'Export and Download Backup', 'augury' ) .'</a>';
    echo '<small>-( '. esc_html__( 'or', 'augury' ) .' )-</small>';
    submit_button( esc_html__( 'Reset All Options', 'augury' ), 'cs-warning-primary cs-reset-confirm', $this->unique . '[resetall]', false );
    echo '<small class="cs-text-warning">'. esc_html__( 'Please be sure for reset all of framework options.', 'augury' ) .'</small>';

    echo "{$this->element_after()}";

  }

}