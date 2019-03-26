<?php
/**
 * Add a sections: pl -> product list.
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pl_settings',
		array(
			'title'    => __( 'Settings', 'mk_framework' ),
			'priority' => 10,
			'panel' => 'cs_product_list',
		)
	)
);

// Add settings to the section.
// Label.
$wp_customize->add_setting( 'cs_pl_settings_grid_label' );

$wp_customize->add_control(
	new MK_Label_Control(
		$wp_customize,
		'cs_pl_settings_grid_label',
		array(
			'section' => 'cs_pl_settings',
			'column'  => 'mk-col-12',
			'label'  => 'Grid Settings',
		)
	)
);

// Columns.
$wp_customize->add_setting( 'cs_pl_settings_columns', array(
	'default'   => mk_get_option( 'shop_archive_columns' ),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Select_Control(
		$wp_customize,
		'cs_pl_settings_columns',
		array(
			'section' => 'cs_pl_settings',
			'column'  => 'mk-col-6',
			'icon'    => 'mk-columns',
			'choices' => array(
				'default' => __( 'Default (4 Columns full layout, 3 columns with sidebar)', 'mk_framework' ),
				'1' => __( '1 Column', 'mk_framework' ),
				'2' => __( '2 Columns', 'mk_framework' ),
				'3' => __( '3 Columns', 'mk_framework' ),
				'4' => __( '4 Columns', 'mk_framework' ),
			),
		)
	)
);

// Row.
$wp_customize->add_setting( 'cs_pl_settings_rows', array(
	'default'   => 4,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Select_Control(
		$wp_customize,
		'cs_pl_settings_rows',
		array(
			'section' => 'cs_pl_settings',
			'column'  => 'mk-col-6',
			'icon'    => 'mk-rows',
			'choices' => array(
				1 => __( '1 Row', 'mk_framework' ),
				2 => __( '2 Rows', 'mk_framework' ),
				3 => __( '3 Rows', 'mk_framework' ),
				4 => __( '4 Rows', 'mk_framework' ),
			),
		)
	)
);

// Selective refresh for Row and Column.
$wp_customize->selective_refresh->add_partial( 'cs_pl_settings_columns', array(
	'selector'            => '#mk-archive-products',
	'settings' => array( 'cs_pl_settings_columns', 'cs_pl_settings_rows' ),
	'render_callback'     => function( $partial, $container_context ) {
		include THEME_CUSTOMIZER_DIR . '/partials/cs-pl-settings-columns.php';
	},
	'container_inclusive' => false,
	'fallback_refresh'    => false,
) );

// Horizontal space.
$wp_customize->add_setting( 'cs_pl_settings_horizontal_space', array(
	'default'   => 20,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_settings_horizontal_space',
		array(
			'section'  => 'cs_pl_settings',
			'column'   => 'mk-col-4',
			'icon'     => 'mk-horizontal-space',
			'unit'     => 'px',
		)
	)
);

// Vertical space.
$wp_customize->add_setting( 'cs_pl_settings_vertical_space', array(
	'default'   => 20,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_settings_vertical_space',
		array(
			'section'  => 'cs_pl_settings',
			'column'   => 'mk-col-4',
			'icon'     => 'mk-vertical-space',
			'unit'     => 'px',
		)
	)
);
