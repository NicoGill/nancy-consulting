<?php
/**
 * The template for displaying the home page defined in backoffice
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _wpng
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			endwhile;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
