<?php

/* Register Linux Mint CZ&SK header logo for setting it into the header */
register_default_headers( array(
	'lm35' => array(
		'url' => get_stylesheet_directory_uri().'/images/headLM35.png',
		'thumbnail_url' => get_stylesheet_directory_uri().'/images/headLM35.png',
		'description' => 'Linux Mint CZ&SK'
	)
 )
);

/* Enqueue Mantra original stylesheet */
add_action('wp_enqueue_scripts', 'mantra_css');
function mantra_css() {
	wp_enqueue_style('mantra', get_template_directory_uri().'/style.css');
}
