<?php

/**
 * Init WPNG Wordpress starter theme
 *
 * @package _wpng
 */

/*
 * Custom Post Type creation
 * Wordpress standard way
 */
function ncv2_cpt() {
  // Register Custom Post Type Réalisation
	$labels_realisation = array(
		'name' => __( 'Réalisations', 'Post Type General Name', 'ncv2' ),
		'singular_name' => __( 'Réalisation', 'Post Type Singular Name', 'ncv2' ),
		'menu_name' => __( 'Réalisation', 'ncv2' ),
		'name_admin_bar' => __( 'Réalisation', 'ncv2' ),
		'archives' => __( 'Archives réalisation', 'ncv2' ),
		'attributes' => __( 'Attributs réalisation', 'ncv2' ),
		'parent_item_colon' => __( 'Parents réalisation:', 'ncv2' ),
		'all_items' => __( 'Toutes les réalisations', 'ncv2' ),
		'add_new_item' => __( 'Ajouter une nouvelle réalisation', 'ncv2' ),
		'add_new' => __( 'Ajouter', 'ncv2' ),
		'new_item' => __( 'Nouvelle réalisation', 'ncv2' ),
		'edit_item' => __( 'Modifier la réalisation', 'ncv2' ),
		'update_item' => __( 'Mettre à jour la réalisation', 'ncv2' ),
		'view_item' => __( 'Voir la réalisation', 'ncv2' ),
		'view_items' => __( 'Voir les réalisations', 'ncv2' ),
		'search_items' => __( 'Rechercher dans les réalisations', 'ncv2' ),
		'not_found' => __( 'Aucune réalisations trouvées.', 'ncv2' ),
		'not_found_in_trash' => __( 'Aucun Réalisations trouvées dans la corbeille.', 'ncv2' ),
		'featured_image' => __( 'Image mise en avant', 'ncv2' ),
		'set_featured_image' => __( 'Définir l’image mise en avant', 'ncv2' ),
		'remove_featured_image' => __( 'Supprimer l’image mise en avant', 'ncv2' ),
		'use_featured_image' => __( 'Utiliser comme image mise en avant', 'ncv2' ),
		'insert_into_item' => __( 'Insérer dans cette réalisation', 'ncv2' ),
		'uploaded_to_this_item' => __( 'Téléversé sur cette réalisation', 'ncv2' ),
		'items_list' => __( 'Liste des réalisations', 'ncv2' ),
		'items_list_navigation' => __( 'Navigation de la liste des réalisations', 'ncv2' ),
		'filter_items_list' => __( 'Filtrer la liste des réalisations', 'ncv2' ),
	);
	$args_realisation = array(
		'label' => __( 'Réalisation', 'ncv2' ),
		'description' => __( 'Réalisation Nancy Consulting', 'ncv2' ),
		'labels' => $labels_realisation,
		'menu_icon' => 'dashicons-art',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author', ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'realisation', $args_realisation );

}
add_action( 'init', 'ncv2_cpt', 0 );

// 1. customize ACF path
add_filter('acf/settings/path', 'ncv2_settings_path');

function ncv2_settings_path( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf/';
    // return
    return $path;

}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'ncv2_settings_dir');

function ncv2_settings_dir( $dir ) {
    // update path
    $dir = get_stylesheet_directory_uri() . '/acf/';
    // return
    return $dir;
}

// 3. Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/acf/acf.php' );

// save ACF Fields in JSON format
add_filter('acf/settings/save_json', 'ncv2_acf_json_save_point');
function ncv2_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'ncv2_json_load_point');

// Load ACF Fields in JSON format
function ncv2_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf/acf-json';
    return $paths;
}

add_filter('acf/settings/load_json', 'ncv2_json_load_point');

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Options générales',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'options-generales',
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-admin-site',
		'position' => 8
	));
}
