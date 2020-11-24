<?php
/**
 * Plugin Name: Examples
 *
 * @package WooCommerce\Admin
 */

/**
 * Register the JS.
 */
function add_extension_register_script() {
	if ( ! class_exists( 'Automattic\WooCommerce\Admin\Loader' ) || ! \Automattic\WooCommerce\Admin\Loader::is_admin_or_embed_page() ) {
		return;
	}

	$script_path       = '/build/index.js';
	$script_asset_path = dirname( __FILE__ ) . '/build/index.asset.php';
	$script_asset      = file_exists( $script_asset_path )
		? require( $script_asset_path )
		: array( 'dependencies' => array(), 'version' => filemtime( $script_path ) );
	$script_url = plugins_url( $script_path, __FILE__ );
	
	wp_register_script(
		'examples',
		$script_url,
		array_merge( array( 'wp-element', 'wp-data', 'moment' ), $script_asset['dependencies'] ),
		$script_asset['version'],
		true
	);

	wp_enqueue_script( 'examples' );
}

function register_items() {
	if ( 
		! method_exists( '\Automattic\WooCommerce\Admin\Features\Navigation\Menu', 'add_plugin_category' ) ||
		! method_exists( '\Automattic\WooCommerce\Admin\Features\Navigation\Menu', 'add_plugin_item' ) 
	) {
		return;
	}
	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_category(
		array(
			'id'         => 'examples-root',
			'title'      => 'Examples',
			'capability' => 'view_woocommerce_reports',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_item(
		array(
			'id'         => 'example-1',
			'parent'     => 'examples-root',
			'title'      => 'Example 1',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_item(
		array(
			'id'         => 'example-2',
			'parent'     => 'examples-root',
			'title'      => 'Example 2',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_category(
		array(
			'id'         => 'sub-menu',
			'parent'     => 'examples-root',
			'title'      => 'Sub Menu',
			'capability' => 'view_woocommerce_reports',
			'backButtonLabel' => 'Examples',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_item(
		array(
			'id'         => 'sub-menu-child-1',
			'parent'     => 'sub-menu',
			'title'      => 'Sub Menu Child 1',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_plugin_item(
		array(
			'id'         => 'sub-menu-child-2',
			'parent'     => 'sub-menu',
			'title'      => 'Sub Menu Child 2',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);
}

function add_wc_admin_menu () {
	wc_admin_register_page(
		[
			'id'     => 'example-wc-page',
			'title'  => __( 'Examples WC Page', 'woocommerce-payments' ),
			'path'   => '/examples',
			'nav_args' => array(
				'parent' => 'woocommerce',
				'is_top_level' => true,
				'menuId' => 'plugins',
			),
		]
	);
}

add_action( 'admin_menu', 'add_wc_admin_menu' );
add_action( 'plugins_loaded', 'register_items' );
add_action( 'admin_enqueue_scripts', 'add_extension_register_script' );
