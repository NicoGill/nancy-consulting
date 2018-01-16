<?php

 /**
  * Wordpress functions cleaning
  *
  * @packagepwellpharma
  */

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

// remove all actions related to emojis
function disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );

add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
 // Remove invalid rel attribute
function snip_category_rel($result) {
    $result = str_replace('rel="category tag"', '', $result);
    return $result;
}
add_filter('the_category', 'snip_category_rel');
add_filter('wp_list_categories', 'snip_category_rel');
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 1 ); // Remove width and height dynamic attributes to thumbnails

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
// remove admin bar for non-admin user
add_filter( 'show_admin_bar', '__return_false' );

function show_less_login_info() {
    return __('Les identifiants sont incorrects', 'gigatour-group');
}
add_filter( 'login_errors', 'show_less_login_info' );

function no_generator()  {
    return ''; }
add_filter( 'the_generator', 'no_generator' );

function ncv2_remove_recent_comments_style() {
    global $wp_widget_factory;
    if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
        remove_action( 'wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}
add_action( 'widgets_init', 'ncv2_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()

// remove wp version param from any enqueued scripts
function ncv2_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'ncv2_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'ncv2_remove_wp_ver_css_js', 9999 );

// Disable support for comments and trackbacks in post types
function ncv2_disable_comments_post_types_support() {
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    if(post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('admin_init', 'ncv2_disable_comments_post_types_support');

// Close comments on the front-end
function ncv2_disable_comments_status() {
  return false;
}
add_filter('comments_open', 'ncv2_disable_comments_status', 20, 2);
add_filter('pings_open', 'ncv2_disable_comments_status', 20, 2);

// Hide existing comments
function ncv2_disable_comments_hide_existing_comments($comments) {
  $comments = array();
  return $comments;
}
add_filter('comments_array', 'ncv2_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function ncv2_disable_comments_admin_menu() {
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'ncv2_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function ncv2_disable_comments_admin_menu_redirect() {
  global $pagenow;
  if ($pagenow === 'edit-comments.php') {
    wp_redirect(admin_url()); exit;
  }
}
add_action('admin_init', 'ncv2_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function ncv2_disable_comments_dashboard() {
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'ncv2_disable_comments_dashboard');

// Remove comments links from admin bar
function ncv2_disable_comments_admin_bar() {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'ncv2_disable_comments_admin_bar');

function ncv2_remove_wp_logo( $wp_admin_bar ){
    $wp_admin_bar->remove_node( 'new-content' );
}
add_action( 'admin_bar_menu', 'ncv2_remove_wp_logo', 100 );

function ncv2_remove_dashboard_widgets() {
  global $wp_meta_boxes;

  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}
add_action('wp_dashboard_setup', 'ncv2_remove_dashboard_widgets' );

function ncv2_remove_admin_menus(){
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'plugins.php' );
    remove_menu_page( 'users.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'options-general.php' );
    remove_menu_page( 'edit.php?post_type=page' );

    unset($submenu['edit.php'][16]);
    unset($submenu['index.php'][10]);
}
// add_action('admin_menu', 'ncv2_remove_admin_menus');

function ncv2_remove_admin_bar_links() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('about');
  $wp_admin_bar->remove_menu('wporg');
  $wp_admin_bar->remove_menu('documentation');
  $wp_admin_bar->remove_menu('support-forums');
  $wp_admin_bar->remove_menu('feedback');
  $wp_admin_bar->remove_menu('view-site');
  // $wp_admin_bar->remove_menu('updates');
  $wp_admin_bar->remove_menu('comments');
  // $wp_admin_bar->remove_menu('archive');
  // $wp_admin_bar->remove_menu('view');
}
add_action('wp_before_admin_bar_render', 'ncv2_remove_admin_bar_links');

function ncv2_allow_admin_area_to_admins_only() {

      if( defined('DOING_AJAX') && DOING_AJAX ) {
            //Allow ajax calls
            return;
      }

      $user = wp_get_current_user();

      if( empty( $user ) || !in_array( "administrator", (array) $user->roles ) ) {
           //Redirect to main page if no user or if the user has no "administrator" role assigned
           wp_redirect( get_site_url( ) );
           exit();
      }

 }
 add_action( 'admin_init', 'ncv2_allow_admin_area_to_admins_only');
