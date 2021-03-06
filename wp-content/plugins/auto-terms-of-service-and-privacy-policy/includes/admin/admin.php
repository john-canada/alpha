<?php

namespace wpautoterms\admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use wpautoterms\admin\action\Recheck_License;
use wpautoterms\admin\action\Set_Option;
use wpautoterms\admin\form\Legal_Page;
use wpautoterms\api\License;
use wpautoterms\api\Query;
use wpautoterms\Countries;
use wpautoterms\cpt\Admin_Columns;
use wpautoterms\cpt\CPT;
use wpautoterms\Upgrade;
use wpautoterms\Wpautoterms;

define( 'WPAUTOTERMS_API_KEY_HEADER', 'X-WpAutoTerms-ApiKey' );

abstract class Admin {
	/**
	 * @var  License
	 */
	protected static $_license;
	/**
	 * @var Query
	 */
	protected static $_query;
	/**
	 * @var Set_Option
	 */
	protected static $_warning_action;

	public static function init( License $license, Query $query ) {
		static::$_license = $license;
		static::$_query = $query;
		add_action( 'init', array( __CLASS__, 'action_init' ) );
		new Slug_Helper();
		new Upgrade();
	}

	public static function action_init() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 100 );
		add_filter( 'post_row_actions', array( __CLASS__, 'row_actions' ), 10, 2 );
		add_filter( 'pre_update_option', array( __CLASS__, 'fix_update' ), 10, 3 );
		add_filter( 'get_sample_permalink_html', array( __CLASS__, 'remove_permalink' ), 10, 5 );
		add_action( 'edit_form_top', array( __CLASS__, 'edit_form_top' ) );
		add_filter( 'get_pages', array( __CLASS__, 'update_wp_builtin_pp' ), 10, 2 );

		Notices::init( WPAUTOTERMS_OPTION_PREFIX . 'notices' );

		$recheck_action = new Recheck_License( CPT::edit_cap(), null, '', null, __( 'Access denied', WPAUTOTERMS_SLUG ) );
		$recheck_action->set_license_query( static::$_license );

		// TODO: extract warnings class
		static::$_warning_action = new Set_Option( CPT::edit_cap(), null, 'settings_warning_disable' );
		static::$_warning_action->set_option_name( 'settings_warning_disable' );

		Admin_Columns::init();
		Menu::init( static::$_license );
		static::$_license->check();
	}

	public static function update_wp_builtin_pp( $pages, $r ) {
		if ( ! isset( $r['name'] ) || !in_array( $r['name'], array(
				'wp_page_for_privacy_policy',
				'page_for_privacy_policy',
				'woocommerce_terms_page_id'
			) ) ) {
			return $pages;
		}
		$r['post_type'] = CPT::type();
		$r['name'] = WPAUTOTERMS_SLUG . '_page_for_privacy_policy';
		$autoterms_pages = get_pages( $r );

		return array_merge( $pages, $autoterms_pages );
	}

	public static function add_meta_boxes() {
		global $post;

		if ( empty( $post ) || ( $post->post_type != CPT::type() ) ) {
			return;
		}

		remove_meta_box( 'slugdiv', $post->post_type, 'normal' );
	}

	public static function remove_permalink( $permalink, $post_id, $new_title, $new_slug, $post ) {
		if ( $post->post_type != CPT::type() ) {
			return $permalink;
		}

		return '';
	}

	public static function edit_form_top( $post ) {
		if ( $post->post_type != CPT::type() ) {
			return;
		}

		if ( $post->post_status == 'auto-draft' ) {
			$page_id = isset( $_REQUEST['page_name'] ) ? sanitize_text_field( $_REQUEST['page_name'] ) : '';
			$page = false;
			if ( $page_id !== 'custom' ) {
				if ( ! empty( $page_id ) ) {
					$page = Wpautoterms::get_legal_page( $page_id );
					if ( $page->availability() !== true ) {
						$page = false;
					}
				}
				if ( $page === false ) {
					global $wpdb;
					$cpt = CPT::type();
					$cases = array();
					foreach ( Wpautoterms::get_legal_pages() as $page ) {
						$id = $page->id();
						$cases[] = "SUM(CASE WHEN $wpdb->posts.post_name LIKE '$id%' THEN 1 ELSE 0 END) as '$id'";
					}
					$cases = join( ',', $cases );
					$query = "SELECT $cases FROM $wpdb->posts WHERE ($wpdb->posts.post_type = '$cpt' AND $wpdb->posts.post_status<>'trash')";
					$pages_by_type = $wpdb->get_results( $query, ARRAY_A );
					$pages_by_type = $pages_by_type[0];
					\wpautoterms\print_template( 'auto-draft', compact( 'pages_by_type' ) );
				} else {
					\wpautoterms\print_template( 'auto-draft-page', compact( 'page' ) );
				}
			}
		}
	}

	public static function fix_update( $value, $name, $old_value ) {
		if ( $name !== WPAUTOTERMS_OPTION_PREFIX . Options::LEGAL_PAGES_SLUG ) {
			return $value;
		}

		return static::$_license->status() === License::STATUS_FREE ?
			Options::default_value( Options::LEGAL_PAGES_SLUG ) : $value;
	}

	public static function row_actions( $actions, $post ) {
		if ( ( CPT::type() == get_post_type( $post ) ) && ( $post->post_status == 'publish' ) ) {
			$link = get_post_permalink( $post->ID );
			$short_link = preg_replace( '/https?:\/\//i', '', trim( $link, '/' ) );
			$info = '<a href="' . $link . '">' . $short_link . '</a>';
			array_unshift( $actions, '<div class="inline-row-action-summary">' . $info . '</div>' );
		}

		return $actions;
	}

	public static function enqueue_scripts( $page ) {
		global $post;
		if ( ! empty( $post ) && ( $post->post_type == CPT::type() ) ) {
			// NOTE: load media scripts in case 3-rd party plugin fails to enqueue them properly.
			$scripts = wp_scripts();
			if ( ! empty( $scripts->queue ) ) {
				$cmp = 'media-';
				$cmp_len = strlen( $cmp );
				foreach ( $scripts->queue as $item ) {
					if ( strncasecmp( $item, $cmp, $cmp_len ) ) {
						wp_enqueue_media();
						break;
					}
				}
			}
			if ( $page == 'edit.php' ) {
				wp_enqueue_script( WPAUTOTERMS_SLUG . '_row_actions', WPAUTOTERMS_PLUGIN_URL . 'js/row-actions.js',
					false, false, true );
			}
			if ( $page == 'post-new.php' && $post->post_status == 'auto-draft' ) {
				wp_enqueue_script( WPAUTOTERMS_SLUG . '_post_new', WPAUTOTERMS_PLUGIN_URL . 'js/post-new.js',
					false, false, true );
				$hidden = array();
				$dependencies = array();
				/**
				 * @var $v Legal_Page
				 */
				foreach ( Wpautoterms::get_legal_pages() as $v ) {
					$hidden[ $v->id() ] = $v->hidden();
					$dependencies[ $v->id() ] = $v->dependencies();
				}
				$page_id = isset( $_REQUEST['page_name'] ) ? sanitize_text_field( $_REQUEST['page_name'] ) : '';
				wp_localize_script( WPAUTOTERMS_SLUG . '_post_new', 'wpautotermsPostNew', array(
					'hidden' => $hidden,
					'dependencies' => $dependencies,
					'settings_warning_disable_nonce' => static::$_warning_action->nonce(),
					'page_id' => $page_id
				) );
				wp_register_style( WPAUTOTERMS_SLUG . '_post_new_css', WPAUTOTERMS_PLUGIN_URL . 'css/post-new.css', false );
				wp_enqueue_style( WPAUTOTERMS_SLUG . '_post_new_css' );
				wp_register_style( WPAUTOTERMS_SLUG . '_admin_css', WPAUTOTERMS_PLUGIN_URL . 'css/admin.css', false );
				wp_enqueue_style( WPAUTOTERMS_SLUG . '_admin_css' );
			}
		}

		$prefix = WPAUTOTERMS_SLUG . '_';
		if ( strncmp( $page, $prefix, strlen( $prefix ) ) != 0 ) {
			return;
		}
		Countries::enqueue_scripts();
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_admin', WPAUTOTERMS_PLUGIN_URL . 'js/admin.js', false, false, true );
		wp_register_style( WPAUTOTERMS_SLUG . '_admin_css', WPAUTOTERMS_PLUGIN_URL . 'css/admin.css', false );
		wp_enqueue_style( WPAUTOTERMS_SLUG . '_admin_css' );
	}
}
