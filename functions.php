<?php

/* Enqueue Mantra original stylesheet */
add_action('wp_enqueue_scripts', 'mantra_css');
function mantra_css() {
	wp_enqueue_style('mantra', get_template_directory_uri().'/style.css');
}

/* Remove information about WordPress and its version from HTML */
remove_action('wp_head', 'wp_generator');
function remove_cssjs_ver( $src ) {
	if(strpos($src, '?ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);

