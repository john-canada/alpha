<?php
/**
 * Add a section: pl -> product list, s -> styles.
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pl_s_box_style',
		array(
			'title'    => __( 'Box Style', 'mk_framework' ),
			'priority' => 10,
			'panel' => 'cs_styles',
		)
	)
);

// Add settings to the section.
// Background color.
$wp_customize->add_setting( 'cs_pl_s_box_style_background_color', array(
	'default'   => '#ffffff',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_box_style_background_color',
		array(
			'section'  => 'cs_pl_s_box_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-background-color',
		)
	)
);

// Border radius.
$wp_customize->add_setting( 'cs_pl_s_box_style_border_radius', array(
	'default'   => 0,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_box_style_border_radius',
		array(
			'section'  => 'cs_pl_s_box_style',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-corner-radius',
			'unit'     => 'px',
		)
	)
);

// Border width.
$wp_customize->add_setting( 'cs_pl_s_box_style_border_width', array(
	'default'   => 1,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_s_box_style_border_width',
		array(
			'section'  => 'cs_pl_s_box_style',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-border',
			'unit'     => 'px',
		)
	)
);

// Border color.
$wp_customize->add_setting( 'cs_pl_s_box_style_border_color', array(
	'default'   => '#e3e3e3',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_s_box_style_border_color',
		array(
			'section'  => 'cs_pl_s_box_style',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Box Model.
$wp_customize->add_setting( 'cs_pl_s_box_style_box_model', array(
	'default' => array(
		'margin_top'     => 0,
		'margin_right'   => 0,
		'margin_bottom'  => 0,
		'margin_left'    => 0,
		'padding_top'    => 0,
		'padding_right'  => 0,
		'padding_bottom' => 0,
		'padding_left'   => 0,
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Box_Model_Control(
		$wp_customize,
		'cs_pl_s_box_style_box_model',
		array(
			'section' => 'cs_pl_s_box_style',
			'column'  => 'mk-col-12',
		)
	)
);
