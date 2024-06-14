<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Codestar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarthemes.com/
 * Version: 1.0.2
 * Description: A Lightweight and easy-to-use WordPress Options Framework
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: dtm-framework
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Copyright 2015 Codestar <info@codestarthemes.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * ------------------------------------------------------------------------------------------------
 *
 */

// ------------------------------------------------------------------------------------------------
require_once plugin_dir_path( __FILE__ ) .'/cs-framework-path.php';
// ------------------------------------------------------------------------------------------------

if( ! function_exists( 'dtm_framework_init' ) && ! class_exists( 'DTMFramework_Abstract' ) ) {
  function dtm_framework_init() {

    // active modules
    defined( 'DTM_ACTIVE_METABOX'   )   or  define( 'DTM_ACTIVE_METABOX',     true  );
    defined( 'DTM_ACTIVE_TAXONOMY'   )  or  define( 'DTM_ACTIVE_TAXONOMY',    true  );
    defined( 'DTM_ACTIVE_LIGHT_THEME' ) or  define( 'DTM_ACTIVE_LIGHT_THEME', false );

    // helpers
    dtm_locate_template( 'functions/deprecated.php'     );
    dtm_locate_template( 'functions/fallback.php'       );
    dtm_locate_template( 'functions/helpers.php'        );
    dtm_locate_template( 'functions/actions.php'        );
    dtm_locate_template( 'functions/enqueue.php'        );
    dtm_locate_template( 'functions/sanitize.php'       );
    dtm_locate_template( 'functions/validate.php'       );

    // classes
    dtm_locate_template( 'classes/abstract.class.php'   );
    dtm_locate_template( 'classes/options.class.php'    );
    dtm_locate_template( 'classes/metabox.class.php'    );
    dtm_locate_template( 'classes/taxonomy.class.php'   );

    // configs
    dtm_locate_template( 'config/metabox.config.php'    );
    dtm_locate_template( 'config/taxonomy.config.php'   );

  }
  add_action( 'init', 'dtm_framework_init', 10 );
}