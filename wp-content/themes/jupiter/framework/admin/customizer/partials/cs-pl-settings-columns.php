<?php
/**
 * Views file for selective_refresh for settings: cs_pl_settings_columns
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

/**
 * Action hoooks for wwoocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Action hoooks for woocommerce_archive_description hook
 */
do_action( 'woocommerce_archive_description' );
?>
<div id="mk-archive-products">
<?php
if ( have_posts() ) :

	/**
	 * Action hoooks for woocommerce_before_shop_loop hook
	 *
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	$args = array(
		'before'  => woocommerce_product_loop_start( false ),
		'after'   => woocommerce_product_loop_end( false ),
	);
	woocommerce_product_subcategories( $args );

	woocommerce_product_loop_start();

	while ( have_posts() ) : the_post();

		wc_get_template_part( 'content', 'product' );

	endwhile; // end of the loop.

	woocommerce_product_loop_end();

	/**
	 * Action hoooks for woocommerce_after_shop_loop hook
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );

	elseif ( ! woocommerce_product_subcategories( array(
		'before' => woocommerce_product_loop_start( false ),
		'after' => woocommerce_product_loop_end( false ),
	) ) ) :
		wc_get_template( 'loop/no-products-found.php' );
	endif;
?>
</div>
<?php
/**
 * Action hoooks for woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
