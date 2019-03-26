<?php
/**
 * Template part for custom headers built by Header Builder.
 *
 * @since 5.9.0 Introduced.
 * @since 5.9.4 Add parameters on HB_Grid declaration.
 */
global $mk_options;

$is_shortcode = isset($view_params['is_shortcode']) ? $view_params['is_shortcode'] : false; ?>

<header class="hb-custom-header" <?php echo get_schema_markup('header'); ?>>
	<div class="hb-devices">
		<?php
			// @todo This HB_Grid should be declared only once.
			$mk_hb = new HB_Grid( new HB_Customize() );
		?>
		<?php $mk_hb->render_markup(); ?>
	</div>
	<?php mk_get_view('layout', 'title', false, ['is_shortcode' => $is_shortcode]) ?>
</header>
