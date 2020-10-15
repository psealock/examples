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
	if ( ! class_exists( 'Automattic\WooCommerce\Admin\Loader' ) || ! \Automattic\WooCommerce\Admin\Loader::is_admin_page() ) {
		return;
	}

	$script_path       = '/build/index.js';
	$script_asset_path = dirname( __FILE__ ) . '/build/index.asset.php';
	$script_asset      = file_exists( $script_asset_path )
		? require( $script_asset_path )
		: array( 'dependencies' => array(), 'version' => filemtime( $script_path ) );
	$script_url = plugins_url( $script_path, __FILE__ );

	error_log(print_r($script_asset['dependencies'], true));

	wp_register_script(
		'examples',
		$script_url,
		$script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	wp_enqueue_script( 'examples' );
}

function register_items() {
	if ( 
		! method_exists( '\Automattic\WooCommerce\Admin\Features\Navigation\Menu', 'add_category' ) ||
		! method_exists( '\Automattic\WooCommerce\Admin\Features\Navigation\Menu', 'add_item' ) 
	) {
		return;
	}
	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_category(
		array(
			'id'         => 'examples-root',
			'title'      => 'Examples',
			'capability' => 'view_woocommerce_reports',
			'parent'     => 'woocommerce',
			'is_top_level' => true,
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_item(
		array(
			'id'         => 'example-1',
			'parent'     => 'examples-root',
			'title'      => 'Example 1',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_item(
		array(
			'id'         => 'example-2',
			'parent'     => 'examples-root',
			'title'      => 'Example 2',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_category(
		array(
			'id'         => 'sub-menu',
			'parent'     => 'examples-root',
			'title'      => 'Sub Menu',
			'capability' => 'view_woocommerce_reports',
			'backButtonLabel' => 'WooCommerce Examples',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_item(
		array(
			'id'         => 'sub-menu-child-1',
			'parent'     => 'sub-menu',
			'title'      => 'Sub Menu Child 1',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);

	\Automattic\WooCommerce\Admin\Features\Navigation\Menu::add_item(
		array(
			'id'         => 'sub-menu-child-2',
			'parent'     => 'sub-menu',
			'title'      => 'Sub Menu Child 2',
			'capability' => 'view_woocommerce_reports',
			'url'        => 'http//:www.google.com',
		)
	);
}

add_action( 'plugins_loaded', 'register_items' );
add_action( 'admin_enqueue_scripts', 'add_extension_register_script' );
