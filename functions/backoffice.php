<?php

/**
 * Wordpress backoffice function helpers or styling
 *
 * @package _ncv2
 */

function ncv2_login_logo() {
	echo '<style type="text/css">
	#login h1 a {background-image:url('.get_stylesheet_directory_uri().'/assets/img/nicolas_gillium_logo_code.png);
	-webkit-background-size:contain!important;
	background-size: contain!important;
	width: 150px!important;
	height: 150px!important;}
	</style>';
}
add_action('login_head', 'ncv2_login_logo');

function ncv2_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'ncv2_logo_url' );

function ncv2_logo_url_title() {
	return 'Page d\'accueil de l\'administration de votre site';
}
add_filter( 'login_headertitle', 'ncv2_logo_url_title' );
