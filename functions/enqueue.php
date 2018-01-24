<?php

 /**
  * Wordpress enqueue styles & scripts cleaning
  *
  * @package _ncv2
  */

// Load HTML5 Blank scripts (header.php)
function ncv2_header_scripts() {
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {

      // jQuery
      wp_deregister_script( 'jquery' );
      wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js", array(), null, true );
      wp_enqueue_script( 'jquery' );
      // Modernizr
      wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), null, true );
      // Custom scripts
      wp_register_script(
          'ncv2-script',
          get_template_directory_uri() . '/assets/js/wpng-main-script.js',
          array(
              'modernizr',
              'jquery'
          ),
          null, true );
      // Enqueue Scripts
      wp_enqueue_script( 'ncv2-script' );
    }
}
// Load HTML5 Blank conditional scripts
function ncv2_conditional_scripts() {
    if ( is_page( 'pagenamehere' ) ) {
        // Conditional script(s)
        wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' );
        wp_enqueue_script( 'scriptname' );
    }
}

function ncv2_load_fonts() {
  wp_register_style('poppins-googleFonts', '//fonts.googleapis.com/css?family=Poppins:200i,300,400,700');
  wp_enqueue_style( 'poppins-googleFonts');
}


function ncv2_styles() {
  // Register CSS - Sass styling
  wp_enqueue_style( 'ncv2-style', get_stylesheet_uri() );
  // Flexbox grid framework : https://github.com/kristoferjoseph/flexboxgrid
  // wp_enqueue_style( 'ncv2-flexbox-grid', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . ':cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css', array(), null );
}

add_action( 'wp_enqueue_scripts', 'ncv2_header_scripts' ); // Add Custom Scripts to wp_head
// add_action( 'wp_print_scripts', 'ncv2_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'wp_enqueue_scripts', 'ncv2_styles' ); // Add Theme Stylesheet
add_action( 'wp_print_styles', 'ncv2_load_fonts');
