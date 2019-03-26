<?php
/**
 * Header Builder: HB_DB class.
 *
 * @package Header_Builder
 * @subpackage UI
 * @since 5.9.0
 */

/**
 * Create at isolated environment for displaying "wp-admin/admin.php?page=header-builder". Render
 * full-screen header-builder admin area.
 *
 * @author Dominique Mariano <dominique@artbees.net>
 *
 * @since 5.9.0 Introduced to replace screen.php.
 */
class HB_Screen {
	/**
	 * Constructor.
	 *
	 * @since 5.9.0
	 *
	 * Execute header_builder_screen() before any other hook when a user accesses the admin area.
	 * This allows us to create an isolated environment for the Header Builder, where only the assets
	 * needed for Header Builder are loaded and nothing else.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'header_builder_screen' ), 100 );
	}

	/**
	 * Renders the entire Header Builder screen on the front end, with default values.
	 *
	 * @since 5.9.0
	 *
	 * @SuppressWarnings(PHPMD.ExitExpression)
	 */
	public function header_builder_screen() {
		// @todo Sanitize GET request here.
		// If we are not on "wp-admin/admin.php?page=header-builder", then bail.
		if ( ! isset( $_GET['page'] ) || 'header-builder' !== $_GET['page'] ) { // WPCS: CSRF ok.
			return;
		}

		// Bootstrap needs to be removed. It is causing issues on some npm modules.
		wp_enqueue_style( 'hb-bootstrap', get_template_directory_uri() . '/header-builder/includes/assets/bootstrap.min.css' );
		wp_enqueue_style( 'hb-font-awesome', get_template_directory_uri() . '/header-builder/admin/fonts/font-awesome.min.css' );
		wp_enqueue_style( 'hb', get_template_directory_uri() . '/header-builder/admin/css/screen.css', array( 'hb-font-awesome' ) );
		wp_register_script( 'hb-webfontloader', get_template_directory_uri() . '/header-builder/admin/js/webfontloader.js', array(), false, true );
		wp_register_script( 'hb-navigation-scripts', get_template_directory_uri() . '/header-builder/includes/elements/assets/js/hb-navigation-scripts.js', array( 'jquery' ), false, true );
		wp_register_script( 'hb-burger-scripts', get_template_directory_uri() . '/header-builder/includes/elements/assets/js/hb-burger-menu.js', array( 'jquery' ), false, true );
		wp_register_script( 'hb', get_template_directory_uri() . '/header-builder/admin/js/screen.js', array( 'jquery', 'hb-webfontloader', 'hb-navigation-scripts', 'hb-burger-scripts' ), false, true );
		wp_localize_script( 'hb', 'ajax_object', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		) );

		// These default values need to be reconsidered. Ideally, we should start blank.
		// Mehdi uses this initial state to "hydrate" the props on the client side.
		// This JSON string must not be edited unless absolutely necessary. If default values
		// need to be specified, use Component.defaultProps instead.
		$response = wp_remote_get( get_template_directory_uri() . '/header-builder/admin/store.json' );
		$state    = wp_remote_retrieve_body( $response );

		// @todo Sanitize GET request here.
		// Danger zone. Let's keep this a secret during development. This is an escape hatch since HB is so full of bugs.
		if ( isset( $_GET['page'] ) && 'header-builder' === $_GET['page'] && isset( $_GET['data'] ) && 'clear' === $_GET['data'] ) { // WPCS: CSRF ok.
			delete_option( 'artbees_header_builder', $state );
		}
		add_option( 'artbees_header_builder', $state );

		ob_start();
		$this->setup_hb_admin_header();
		$this->setup_hb_admin_body();
		$this->setup_hb_admin_footer();
		// @todo We shouldn't use exit.
		exit;
	}

	/**
	 * Render the main application header and all associated metas, scripts, links, etc.
	 *
	 * @since 5.9.0
	 *
	 * @todo Find a way to escape Javascript code here.
	 */
	public function setup_hb_admin_header() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title><?php esc_html_e( 'Header Builder', 'mk_framework' ); ?></title>

			<script type="text/javascript">
				window.MK = window.MK || {};
				MK.HB = MK.HB || {};
				MK.HB.WP = MK.HB.WP || {};
				MK.HB.store = <?php echo get_option( 'artbees_header_builder', array() ); // WPCS: XSS ok. ?>;
				MK.HB.WP.menus = <?php echo wp_json_encode( wp_get_nav_menus() ); // WPCS: XSS ok. ?>;
			</script>
			<?php
			$menus_html = array();
			$menus = wp_get_nav_menus();
			add_filter( 'wp_nav_menu', 'hb_active_current_menu_item' );
			foreach ( $menus as $wp_term_object ) {
				$menus_html[ $wp_term_object->slug ] = wp_nav_menu( array(
					'menu' => $wp_term_object->slug,
					'container' => 'nav',
					'container_class' => 'hb-navigation hb-js-main-nav',
					'menu_class' => 'hb-navigation-ul',
					'echo' => false,
					'fallback_cb' => 'mk_link_to_menu_editor',
					'walker' => new hb_main_menu,
				) );
			}
			remove_filter( 'wp_nav_menu', 'hb_active_current_menu_item' );
			?>
			<script type="text/javascript">
				MK.HB.WP.menusHTML = <?php echo wp_json_encode( $menus_html ); // WPCS: XSS ok. ?>;
				MK.HB.WC = <?php echo wp_json_encode( hb_woocommerce_is_active() ); // WPCS: XSS ok. ?>;
			</script>

			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="hb" style="position: fixed; display: block; width: 100vw; height: 100vh; overflow: hidden;">
		<?php
	}

	/**
	 * Render the main application body. This contains all the main parts visible on the front end.
	 *
	 * @since 5.9.0
	 */
	public function setup_hb_admin_body() {
		?>
		<div id="header-builder" style='position: absolute; top: 0; height: 100%; bottom: 0; left: 0; background: #d6d6d6; overflow: visible; right: 0; min-width: 0; font-family: Helvetica, sans-serif;'></div>
		<?php
	}

	/**
	 * Render the main application footer and all associated metas, scripts, links, etc.
	 *
	 * @since 5.9.0
	 */
	public function setup_hb_admin_footer() {
		wp_print_scripts( 'hb' ); ?>
			</body>
		</html>
		<?php
	}
}

new HB_Screen();
