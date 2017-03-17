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

/* Add search form to the header */
add_action('cryout_access_hook', 'lmcz_mantra_header_search');
function lmcz_mantra_header_search() {
    echo '<form method="get" id="searchform" action="'.get_home_url().'">
        <div>
            <input type="text" size="10" value="'.esc_html(get_query_var('s')).'" name="s" id="s" />
            <input type="submit" id="searchsubmit" value="Hledat na webu" class="btn" />
        </div>
    </form>';
}

/* Enqueue Mantra original stylesheet */
add_action('wp_enqueue_scripts', 'mantra_css');
function mantra_css() {
	wp_enqueue_style('mantra', get_template_directory_uri().'/style.css');
}

/* Enqueue login stylesheet */
add_action('login_enqueue_scripts', 'lmcz_custom_login');
function lmcz_custom_login() {
	wp_enqueue_style('lmcz_login', get_stylesheet_directory_uri().'/login.css');
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

