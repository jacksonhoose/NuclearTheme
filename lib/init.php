<?php

function nuclear_after_setup()
{
	load_theme_textdomain('nuclear', THEME_URL . '/languages');

	add_action('init', 'nuclear_cleanup_head');
	add_action('init', 'nuclear_register_menus');
	add_action('init', 'nuclear_post_types');

	nuclear_theme_support();
}

function nuclear_theme_support()
{
	add_theme_support('html5');
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('post-formats', [
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat'
	]);

	set_post_thumbnail_size(125, 125, true);

}

function nuclear_register_menus()
{
	register_nav_menus([
		'main-nav' => __('Primary Menu', 'nuclear-theme'),
		'footer-links' => __('Footer Links', 'nuclear-theme')
	]);
}

function nuclear_post_types()
{
	$labels = [
		'name'               => 'Clients',
		'singular_name'      => 'Client',
		'menu_name'          => _x('Clients', 'admin menu', 'your-plugin-textdomain'),
		'name_admin_bar'     => _x('Client', 'add new on admin bar', 'your-plugin-textdomain'),
		'add_new'            => _x('Add New', 'client', 'your-plugin-textdomain'),
		'add_new_item'       => __('Add New Client', 'your-plugin-textdomain'),
		'new_item'           => __('New Client', 'your-plugin-textdomain'),
		'edit_item'          => __('Edit Client', 'your-plugin-textdomain'),
		'view_item'          => __('View Client', 'your-plugin-textdomain'),
		'all_items'          => __('All Clients', 'your-plugin-textdomain'),
		'search_items'       => __('Search Clients', 'your-plugin-textdomain'),
		'parent_item_colon'  => __('Parent Clients:', 'your-plugin-textdomain'),
		'not_found'          => __('No clients found.', 'your-plugin-textdomain'),
		'not_found_in_trash' => __('No clients found in Trash.', 'your-plugin-textdomain')
	];

	$args = [
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => ['slug' => 'client'],
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => ['title']
	];

	register_post_type('client', $args);
}

function nuclear_cleanup_head()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head');
}

add_action('after_setup_theme', 'nuclear_after_setup');

