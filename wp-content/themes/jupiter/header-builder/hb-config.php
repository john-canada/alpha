<?php
/**
 * Header Builder: Configuation file.
 *
 * @since 5.9.0
 * @since 5.9.3 Add HB_ASSETS_URI and HB_ELEMENTS_ASSETS_URI.
 *
 * @package Header_Builder
 */

define( 'HB_DIR', dirname( __FILE__ ) );
define( 'HB_INCLUDES_DIR', HB_DIR . '/includes/' );
define( 'HB_ADMIN_DIR', HB_DIR . '/admin/' );
define( 'HB_URI', get_stylesheet_directory_uri() . '/header-builder/' );
define( 'HB_ASSETS_URI', HB_URI . 'includes/assets/' );
define( 'HB_ELEMENTS_ASSETS_URI', HB_URI . 'includes/elements/assets/' );
