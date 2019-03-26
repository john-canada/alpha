<?php
/**
 * Header Builder: Main loader file
 *
 * @since 5.9.0
 * @package Header_Builder
 */

/**
 * Main class used for loading all Header Builder files.
 *
 * @since 5.9.0
 * @since 5.9.3 Refactor it as main class.
 * @since 5.9.4 Add parameters on HB_Grid declaration.
 */
class HB_Main {

	/**
	 * Constructor.
	 *
	 * Call some functions to load Header Builder.
	 *
	 * @since 5.9.3
	 */
	public function __construct() {
		$this->init_load();
		$this->init_hooks();
	}

	/**
	 * Load all necessary files.
	 *
	 * @since 5.9.3
	 */
	public function init_load() {
		// Load the constants, etc.
		require_once dirname( __FILE__ ) . '/hb-config.php';
		require_once HB_INCLUDES_DIR . '/helpers/general.php';
		require_once HB_INCLUDES_DIR . '/helpers/array.php';

		// @todo Load files below only on the front end page to improve performance.
		require_once HB_INCLUDES_DIR . '/customize/class-hb-css.php';
		require_once HB_INCLUDES_DIR . '/customize/class-hb-data-transforms.php';
		require_once HB_INCLUDES_DIR . '/customize/class-hb-attributes.php';
		require_once HB_INCLUDES_DIR . '/customize/class-hb-tags.php';
		require_once HB_INCLUDES_DIR . '/customize/class-hb-css-layout.php';
		require_once HB_INCLUDES_DIR . '/customize/class-hb-customize.php';
		require_once HB_INCLUDES_DIR . '/class-hb-grid.php';

		if ( is_admin() ) {
			require_once HB_ADMIN_DIR . '/class-hb-db.php';
			require_once HB_ADMIN_DIR . '/class-hb-screen.php';
		}
	}

	/**
	 * Call all necessary hooks.
	 *
	 * @since 5.9.3
	 */
	public function init_hooks() {
		// Call hooks.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_filter( 'submenu_file', array( $this, 'return_query_tag' ) );
		add_filter( 'template_include', array( $this, 'preview_template' ), 99 );
		add_filter( 'query_vars', array( $this, 'query_vars_filter' ) );
		add_filter( 'get_header_style', array( $this, 'header_style' ) );
		add_action( 'mk_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'mk_enqueue_styles_minified', array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Add's "Header Builder" to Jupiter WordPress menu.
	 *
	 * @since 5.9.3
	 */
	public function admin_menu() {
		add_submenu_page( THEME_NAME, __( 'Header Builder', 'mk_framework' ), __( 'Header Builder', 'mk_framework' ), 'edit_theme_options', 'header-builder', '__return_null' );
	}

	/**
	 * Add the current page URL as the "return" parameter to our "Jupiter" > Header Builder" submenu.
	 *
	 * @since 5.9.3
	 */
	public function return_query_tag() {
		global $submenu;

		if ( array_key_exists( 'Jupiter', $submenu ) ) {
			return;
		}

		$current_url        = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$header_builder_url = add_query_arg( 'return', rawurlencode( $current_url ), 'admin.php?page=header-builder' );

		if ( ! array_key_exists( 'Jupiter', $submenu ) ) {
			return;
		}

		// The following position needs update if the header builder submenu location changes.
		foreach ( $submenu['Jupiter'] as $submenu_key => $submenu_array ) {
			if ( 'header-builder' === $submenu_array[2] ) {
				break;
			}
		}

		// @todo WordPress not allowed to override global $submenu. Need to find better way.
		$submenu['Jupiter'][ $submenu_key ][2] = $header_builder_url; // WPCS: override ok.
	}

	/**
	 * Render the "Preview" template when the URL loaded is "?header-builder=preview"
	 *
	 * @since 5.9.3
	 *
	 * @param string $template The path of the template to include.
	 */
	public function preview_template( $template ) {
		if ( 'navigation-preview' === get_query_var( 'header-builder' ) ) {
			return HB_INCLUDES_DIR . '/templates/navigation-preview.php';
		}

		return  $template;
	}

	/**
	 * Add header-builder to query vars. This is used for the preview functionality.
	 *
	 * @since 5.9.3
	 *
	 * @param array $public_query_vars The array of whitelisted query variables.
	 */
	public function query_vars_filter( $public_query_vars ) {
		$public_query_vars[] = 'header-builder';
		return $public_query_vars;
	}

	/**
	 * Override default header style from theme-options.
	 *
	 * @since 5.9.3
	 *
	 * @param string $style The Theme Options style to override.
	 */
	public function header_style( $style ) {
		$is_live = hb_is_frontend_active();
		$is_previewing = in_array( get_query_var( 'header-builder' ), array(
			'preview',
			'navigaiton-preview',
		), true );

		if ( $is_live || $is_previewing ) {
			$style = 'custom';
		}

		return $style;
	}

	/**
	 * Load our styles when mk_enqueue_styles() is called.
	 *
	 * @since 5.9.3
	 * @since 5.9.4 Add parameters on HB_Grid declaration.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'hb-grid', HB_ASSETS_URI . 'grid.css', false, false, 'all' );

		// @todo This HB_Grid should be declared only once.
		$mk_hb = new HB_Grid( new HB_Customize() );
		wp_add_inline_style( 'hb-grid', $mk_hb->style() );
	}

}

new HB_Main();
