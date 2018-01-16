<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _wpng
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ncv2' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="luxbar luxbar-fixed">
	    <input type="checkbox" id="luxbar-checkbox" class="luxbar-checkbox">
	    <div class="luxbar-menu luxbar-menu-right luxbar-menu-light">
	        <ul class="luxbar-navigation menu">
	            <li class="luxbar-header">
	                <a class="luxbar-brand site-title logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/nicolas_gillium_logo_code.png" class="img-logo img-responsive" alt="Logo site"/>
									</a>
	                <label class="luxbar-hamburger luxbar-hamburger-spin" for="luxbar-checkbox"> <span></span> </label>
	            </li>
							<?php
							wp_nav_menu( array(
								'menu_id' => 'menu-principal',
								'menu_class'=> '',
								'container' => '',
								'items_wrap' => '%3$s'
							) );
							?>
	        </ul>
	    </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
