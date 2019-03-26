<?php
/**
 * Custom customizer loader
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

/**
 * Class to initiate the theme customizer
 *
 * @version 1.0.0
 * @author  Artbees Team
 *
 * @since 5.9.4
 */
class MK_Customizer {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->register_core();
		$this->register_controls();
		$this->add_hooks();
		$this->enqueue_dynamic_styles();
	}

	/**
	 * Add actions hooks
	 */
	public function add_hooks() {
		add_action( 'customize_register', array( $this, 'register_settings' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_controls' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue_preview' ) );
		add_action( 'customize_save_after', array( $this, 'clear_theme_cache' ) );
		add_filter( 'customize_partial_render', array( $this, 'prepend_inline_css' ) );

		// Hook to modify part of the pages.
		if ( $this->is_panel_enabled( 'customise_shop' ) ) {
			require_once( THEME_CUSTOMIZER_DIR . '/hooks/woocommerce.php' );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue_controls() {
		wp_enqueue_style(
			'mk-customizer-controls',
			THEME_CUSTOMIZER_URI . '/assets/css/customizer-controls.css',
			array(),
			$this->get_theme_version()
		);

		wp_enqueue_script(
			'mk-customizer-controls',
			THEME_CUSTOMIZER_URI . '/assets/js/customizer-controls.js',
			array(),
			$this->get_theme_version(),
			true
		);

		wp_enqueue_script(
			'mk-webfontloader',
			THEME_DIR_URI . '/assets/js/plugins/wp-enqueue/webfontloader.js',
			array(),
			$this->get_theme_version(),
			true
		);
	}

	/**
	 * Enqueue control related scripts/styles for live preview
	 */
	public function enqueue_preview() {
		wp_enqueue_script(
			'mk-customizer-preview',
			THEME_CUSTOMIZER_URI . '/assets/js/customizer-preview.js',
			array( 'customize-preview' ),
			$this->get_theme_version(),
			true
		);
	}

	/**
	 * Load core files dependencies
	 */
	public function register_core() {
		require_once( THEME_CUSTOMIZER_DIR . '/core/class-mk-panel.php' );
		require_once( THEME_CUSTOMIZER_DIR . '/core/class-mk-section.php' );
		require_once( THEME_CUSTOMIZER_DIR . '/core/class-mk-control.php' );
	}

	/**
	 * Load controls files dependencies
	 */
	public function register_controls() {
		if ( ! class_exists( 'WP_Customize_Control' ) ) {
			return;
		}

		$controls = glob( THEME_CUSTOMIZER_DIR . '/controls/**/class-mk-*.php' );

		foreach ( $controls as $control ) {
			require_once( $control );
		}
	}

	/**
	 * Register custom settings
	 *
	 * @param object $wp_customize WordPress built-in custmizer object.
	 */
	public function register_settings( $wp_customize ) {
		// Register new panel or section types.
		$wp_customize->register_section_type( 'MK_Panel' );
		$wp_customize->register_section_type( 'MK_Section' );

		// Load all the panels which include sections and settings.
		if ( $this->is_panel_enabled( 'customise_shop' ) ) {
			require_once( THEME_CUSTOMIZER_DIR . '/settings/customise-shop/panels.php' );
		}
	}

	/**
	 * Get all dynamic styles files.
	 */
	private function get_dynamic_styles_files() {
		$directory = THEME_CUSTOMIZER_DIR . '/dynamic-styles';
		$filter = array();

		// Filter the dynamic styles files.
		if ( ! $this->is_panel_enabled( 'customise_shop' ) ) {
			$filter[] = 'customise-shop';
		}

		$files = new RecursiveIteratorIterator(
			new RecursiveCallbackFilterIterator(
				new RecursiveDirectoryIterator(
					$directory,
					RecursiveDirectoryIterator::SKIP_DOTS
				),
				function ( $file ) use ( $filter ) {
					return $file->isFile() || ! in_array( $file->getBaseName(), $filter, true );
				}
			)
		);

		return $files;
	}

	/**
	 * Enqueue dynamic styles.
	 */
	protected function enqueue_dynamic_styles() {
		$files = $this->get_dynamic_styles_files();
		$static = new Mk_Static_Files( false );
		foreach ( $files as $file ) {
			$css = include( $file );
			if ( ! empty( $css ) ) {
				$static->addGlobalStyle( $css );
			}
		}
	}

	/**
	 * Check if a panel of sections and settings is enabled.
	 *
	 * @param string $panel Slug of the panel.
	 * @return boolean Returns true if enabled.
	 */
	protected function is_panel_enabled( $panel ) {
		$mk_options = get_option( THEME_OPTIONS );

		if ( ! empty( $mk_options[ $panel ] ) && 'true' === $mk_options[ $panel ] ) {
			return true;
		}

		return false;
	}

	/**
	 * Clear theme cache.
	 */
	public function clear_theme_cache() {
		$static = new Mk_Static_Files( false );
		$static->DeleteThemeOptionStyles( true );
	}

	/**
	 * Prepend inline CSS for selective refresh output.
	 *
	 * @param string|array|false $ouput The rendered partial as a string, raw data array (for client-side JS template).
	 */
	public function prepend_inline_css( $ouput ) {
		$inline_css = '';
		$files = $this->get_dynamic_styles_files();
		foreach ( $files as $file ) {
			$inline_css .= include( $file );
		}
		return '<style id=\'customizer-inline-styles\' type=\'text/css\'>' . $inline_css . '</style>' . $ouput;
	}

	/**
	 * Get theme version.
	 */
	public function get_theme_version() {
		return get_option( 'mk_jupiter_theme_current_version' );
	}

}

new MK_Customizer();

