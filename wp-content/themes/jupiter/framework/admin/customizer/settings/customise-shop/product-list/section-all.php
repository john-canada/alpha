<?php
/**
 * Add a section: cs -> product list
 *
 * @package WordPress
 * @subpackage Jupiter
 * @since 5.9.4
 */

$wp_customize->add_section(
	new MK_Section(
		$wp_customize,
		'cs_pl_all',
		array(
			'title'    => __( 'All Fields', 'mk_framework' ),
			'priority' => 100,
			'panel' => 'cs_product_list',
		)
	)
);

// Add settings to the section.
// Select with icon.
$wp_customize->add_setting( 'cs_pl_all_select_icon', array(
	'default'   => 3,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Select_Control(
		$wp_customize,
		'cs_pl_all_select_icon',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
			'icon'    => 'mk-columns',
			'choices' => array(
				1 => __( '1 Column', 'mk_framework' ),
				2 => __( '2 Columns', 'mk_framework' ),
				3 => __( '3 Columns', 'mk_framework' ),
				4 => __( '4 Columns', 'mk_framework' ),
			),
		)
	)
);

// Select with text.
$wp_customize->add_setting( 'cs_pl_all_select_text', array(
	'default'   => 3,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Select_Control(
		$wp_customize,
		'cs_pl_all_select_text',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
			'text'    => __( 'Select again', 'mk_framework' ),
			'choices' => array(
				1 => __( '1 Column', 'mk_framework' ),
				2 => __( '2 Columns', 'mk_framework' ),
				3 => __( '3 Columns', 'mk_framework' ),
				4 => __( '4 Columns', 'mk_framework' ),
			),
		)
	)
);

// Text input with icon.
$wp_customize->add_setting( 'cs_pl_all_input_text_icon', array(
	'default'   => 16,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_all_input_text_icon',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-4',
			'icon'     => 'mk-horizontal-space',
			'unit'     => 'px',
		)
	)
);

// Text input with text.
$wp_customize->add_setting( 'cs_pl_all_input_text_text', array(
	'default'   => 16,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_all_input_text_text',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-8',
			'text'     => __( 'Big size', 'mk_framework' ),
			'unit'     => 'px',
		)
	)
);

// Color with icon.
$wp_customize->add_setting( 'cs_pl_all_color_icon', array(
	'default'   => '#ffffff',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_all_color_icon',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-3',
			'icon'     => 'mk-border-color',
		)
	)
);

// Color with text.
$wp_customize->add_setting( 'cs_pl_all_color_text', array(
	'default'   => '#ffffff',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_all_color_text',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-8',
			'text'     => __( 'Active star color', 'mk_framework' ),
		)
	)
);

// Divider.
$wp_customize->add_setting( 'cs_pl_divider' );

$wp_customize->add_control(
	new MK_Divider_Control(
		$wp_customize,
		'cs_pl_divider',
		array(
			'section' => 'cs_pl_all',
		)
	)
);


// Box Model.
$wp_customize->add_setting( 'cs_pl_box_model', array(
	'default' => array(
		'margin_top' => 1,
		'margin_right' => 2,
		'margin_bottom' => 3,
		'margin_left' => 4,
		'padding_top' => 5,
		'padding-right' => 6,
		'padding_bottom' => 7,
		'padding_left' => 8,
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Box_Model_Control(
		$wp_customize,
		'cs_pl_box_model',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
		)
	)
);


// Checkbox button type.
$wp_customize->add_setting( 'cs_pl_all_checkbox_button', array(
	'default'   => array( 'one', 'three' ),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Checkbox_Control(
		$wp_customize,
		'cs_pl_all_checkbox_button',
		array(
			'section'       => 'cs_pl_all',
			'label'         => 'Checkbox',
			'choices' => array(
				'one' => __( 'One', 'mk_framework' ),
				'two' => __( 'Two', 'mk_framework' ),
				'three' => __( 'Three', 'mk_framework' ),
				'four' => __( 'Four', 'mk_framework' ),
			),
		)
	)
);


// Checkbox image type.
$wp_customize->add_setting( 'cs_pl_all_checkbox_image', array(
	'default'   => array( 1, 5 ),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Checkbox_Control(
		$wp_customize,
		'cs_pl_all_checkbox_image',
		array(
			'section'       => 'cs_pl_all',
			'label'         => __( 'Social Networks to Display', 'mk_framework' ),
			'input_type'    => 'image',
			'choices' => array(
				1 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				2 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				3 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				4 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				5 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				6 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				7 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
				8 => THEME_CUSTOMIZER_URI . '/assets/icons/blank-img.png',
			),
		)
	)
);

// Radio (Button Type).
$wp_customize->add_setting( 'cs_pl_all_radio', array(
	'default'   => '',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Radio_Control(
		$wp_customize,
		'cs_pl_all_radio',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
			'input_type'  => 'button',
			'choices' => array(
				1 => __( '16:9', 'mk_framework' ),
				2 => __( '3:2', 'mk_framework' ),
				3 => __( '4:4', 'mk_framework' ),
				4 => __( '5:8', 'mk_framework' ),
			),
		)
	)
);

// Radio (Icon Type).
$wp_customize->add_setting( 'cs_pl_all_radio_svg', array(
	'default'   => '',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Radio_Control(
		$wp_customize,
		'cs_pl_all_radio_svg',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
			'input_type'  => 'icon',
			'choices' => array(
				1 => 'mk-font-style-normal',
				2 => 'mk-font-style-italic',
			),
		)
	)
);

// Radio (Image Type).
$wp_customize->add_setting( 'cs_pl_all_radio_image', array(
	'default'   => '',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Radio_Control(
		$wp_customize,
		'cs_pl_all_radio_image',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
			'input_type'  => 'image',
			'choices' => array(
				1 => THEME_CUSTOMIZER_URI . '/assets/icons/blank.png',
				2 => THEME_CUSTOMIZER_URI . '/assets/icons/blank.png',
				3 => THEME_CUSTOMIZER_URI . '/assets/icons/blank.png',
				4 => THEME_CUSTOMIZER_URI . '/assets/icons/blank.png',
			),
		)
	)
);

// Typography.
$wp_customize->add_setting( 'cs_pl_all_typography', array(
	'default' => array(
		'family' => mk_get_option_element_font_family( 'body' ),
		'size' => mk_get_option( 'body_font_size' ),
		'weight' => mk_get_option( 'body_weight' ),
		'style' => 'normal',
		'color' => mk_get_option( 'body_text_color' ),
	),
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Typography_Control(
		$wp_customize,
		'cs_pl_all_typography',
		array(
			'section' => 'cs_pl_all',
			'column'  => 'mk-col-12',
		)
	)
);

// Color with icon 2.
$wp_customize->add_setting( 'cs_pl_all_color_icon_2', array(
	'default'   => '#ffffff',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_all_color_icon_2',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Text input with icon 2.
$wp_customize->add_setting( 'cs_pl_all_input_text_icon_2', array(
	'default'   => 16,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_all_input_text_icon_2',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-horizontal-space',
			'unit'     => 'px',
		)
	)
);

// Text input with icon 3.
$wp_customize->add_setting( 'cs_pl_all_input_text_icon_3', array(
	'default'   => 16,
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Input_Control(
		$wp_customize,
		'cs_pl_all_input_text_icon_3',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-3-alt',
			'icon'     => 'mk-horizontal-space',
			'unit'     => 'px',
		)
	)
);

// Color with icon 3.
$wp_customize->add_setting( 'cs_pl_all_color_icon_3', array(
	'default'   => '#ffffff',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Color_Control(
		$wp_customize,
		'cs_pl_all_color_icon_3',
		array(
			'section'  => 'cs_pl_all',
			'column'   => 'mk-col-2-alt',
			'icon'     => 'mk-border-color',
		)
	)
);

// Toggle.
$wp_customize->add_setting( 'cs_pl_all_toggle', array(
	'default'   => 'false',
	'transport' => 'postMessage',
) );

$wp_customize->add_control(
	new MK_Toggle_Control(
		$wp_customize,
		'cs_pl_all_toggle',
		array(
			'section'  => 'cs_pl_all',
			'settings' => 'cs_pl_all_toggle',
			'column'   => 'mk-col-12',
			'sublabel'   => 'Test label',
		)
	)
);
