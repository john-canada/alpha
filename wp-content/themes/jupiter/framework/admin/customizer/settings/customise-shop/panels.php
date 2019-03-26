<?php
/**
 * Add nested panels: cs -> customise_shop.
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_panel(
	new MK_Panel(
		$wp_customize,
		'customise_shop',
		array(
			'title' => __( 'Customise Shop', 'mk_framework' ),
			'priority' => 300,
		)
	)
);

// Product List.
$wp_customize->add_panel(
	new MK_Panel(
		$wp_customize,
		'cs_product_list',
		array(
			'title' => __( 'Product List', 'mk_framework' ),
			'panel' => 'customise_shop',
			'priority' => 40,
		)
	)
);

// Product List > Styles.
$wp_customize->add_panel(
	new MK_Panel(
		$wp_customize,
		'cs_styles',
		array(
			'title' => __( 'Styles', 'mk_framework' ),
			'panel' => 'cs_product_list',
		)
	)
);

// Product Page.
$wp_customize->add_panel(
	new MK_Panel(
		$wp_customize,
		'cs_product_page',
		array(
			'title' => __( 'Product Page', 'mk_framework' ),
			'panel' => 'customise_shop',
			'priority' => 50,
		)
	)
);

// Product Page > Styles.
$wp_customize->add_panel(
	new MK_Panel(
		$wp_customize,
		'cs_pp_styles',
		array(
			'title' => __( 'Styles', 'mk_framework' ),
			'panel' => 'cs_product_page',
		)
	)
);

// Load all sections.
$sections = glob( dirname( __FILE__ ) . '/*/section-*.php' );

foreach ( $sections as $section ) {
	require_once( $section );
}
