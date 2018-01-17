<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _ncv2
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="section">
			<div class="site-info center">
				© 2018 Nancy Consulting • <a href="<?php echo esc_url( get_page_link(54) ); ?>" title="Visualiser les mentions légales du site"><?php echo esc_html_e('Mentions légales','ncv2'); ?></a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
