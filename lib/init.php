<?php

function nuclear_after_setup()
{
	load_theme_textdomain('nuclear', THEME_URL . '/languages');

	add_action('init', 'nuclear_cleanup_head');
	add_action('init', 'nuclear_register_menus');
	add_action('init', 'nuclear_post_types');

	nuclear_theme_support();
	nuclear_image_sizes();
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
}

function nuclear_image_sizes()
{
	set_post_thumbnail_size(125, 125, true);
	// add_image_size('nuclear_large', 700, 350, true);
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
	
}

function nuclear_cleanup_head()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head');
}

add_action('after_setup_theme', 'nuclear_after_setup');

