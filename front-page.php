<?php
/**
 * The template for displaying the home page defined in backoffice
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ncv2
 */

get_header();
$description = get_bloginfo( 'description', 'display' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<!-- Section Introduction -->
			<section class="row hero">
				<div class="section">
					<div class="grid-middle">
						<div class="col-6_xs-12">
							<div>
								<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
								<?php if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $description; ?></p>
								<?php endif;

								while ( have_posts() ) : the_post();

									the_content();

								endwhile; ?>
							</div>
						</div>
						<div class="col-6_xs-12">
							<div>
								<?php echo do_shortcode('[contact-form-7 id="28" title="Formulaire de rappel"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Fin section introduction -->

			<section class="row">
				<?php if ( have_rows('nuage_services', 'option') ): ?>
				  <div class="grid-center-middle">
				    <?php while ( have_rows('nuage_services', 'option') ) : the_row(); ?>
				      <div class="col">
								<?php the_sub_field('services'); ?>
							</div>
				    <?php endwhile; ?>
				  </div>
				<?php endif; ?>
			</section>

			<!-- Section 1 - « Se faire sa place sur la toile » -->
			<?php $section_1_home = get_field('section_1_home');
			if($section_1_home) :
			?>
			<section class="row">
				<div class="section">
					<div class="grid">
						<div class="col-4_xs-12">
							<div>
								<img src="<?php echo $section_1_home['image']['url']; ?>" alt="<?php echo $section_1_home['image']['alt']; ?>" class="img-responsive" />
							</div>
						</div>
						<div class="col-8_xs-12">
							<div>
								<h2><?php echo $section_1_home['titre']; ?></h2>
								<h3><?php echo $section_1_home['accroche']; ?></h3>
								<?php echo $section_1_home['texte']; ?>
								<a class="btn bnt-default" title="" href="#">VOir nos réal</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<!-- Fin Section 1 -->

			<!-- Section 2 - « Une veille quotidienne pour répondre à vos besoins » -->
			<?php $section_2_home = get_field('section_2_home');
			if($section_2_home) :
			?>
			<section class="row">
				<div class="section">
					<div class="grid">
						<div class="col-12_xs-12">
							<div class="center">
								<h2><?php echo $section_2_home['titre']; ?></h2>
								<h3><?php echo $section_2_home['accroche']; ?></h3>
							</div>
						</div>
					</div>
					<div class="grid">
						<div class="col-12_xs-12">
							<?php if( !empty( $section_2_home['etapes'] ) ) : ?>
								<?php $i = 1; ?>
								<div class="grid-center">
								<?php foreach ($section_2_home['etapes'] as $etape): ?>
									<div class="col">
										<?php echo $i; ?>
										<hr/>
										<?php echo $etape['texte_etape']; ?>
									</div>
									<?php $i++; ?>
								<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<!-- Fin Section 2 -->

			<!-- Section 3 - Slide références -->
			<?php $section_reference_home = get_field('section_reference_home');
			if($section_reference_home) :
			?>
			<section class="row">
				<div class="grid">
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<h3><?php echo $section_reference_home['titre_vitrine']; ?></h3>
								<?php echo $section_reference_home['accroche_vitrine'];
								if(!empty( $section_reference_home['realisations_vitrine'] ) ) : ?>
								<div class="grid">
									<?php foreach ($section_reference_home['realisations_vitrine'] as $realisation_vitrine) :
										$post = $realisation_vitrine;
										setup_postdata( $post ); ?>
										<div class="col-6_xs-12">
											<?php get_template_part( 'template-parts/realisation/content', 'home' ); ?>
										</div>
										<?php wp_reset_postdata();
									endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<h3><?php echo $section_reference_home['titre_b2b']; ?></h3>
								<?php echo $section_reference_home['accroche_b2b'];
								if(!empty( $section_reference_home['realisations_b2b'] ) ) : ?>
									<div class="grid">
										<?php foreach ($section_reference_home['realisations_b2b'] as $realisation_vitrine) :
											$post = $realisation_vitrine;
											setup_postdata( $post ); ?>
											<div class="col-6_xs-12">
												<?php get_template_part( 'template-parts/realisation/content', 'home' ); ?>
											</div>
											<?php wp_reset_postdata();
										endforeach; ?>
									</div>
									<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="grid">
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<h3><?php echo $section_reference_home['titre_catalogue']; ?></h3>
								<?php echo $section_reference_home['accroche_catalogue'];
								if(!empty( $section_reference_home['realisations_catalogue'] ) ) : ?>
								<div class="grid">
									<?php foreach ($section_reference_home['realisations_catalogue'] as $realisation_vitrine) :
										$post = $realisation_vitrine;
										setup_postdata( $post ); ?>
										<div class="col-6_xs-12">
											<?php get_template_part( 'template-parts/realisation/content', 'home' ); ?>
										</div>
										<?php wp_reset_postdata();
										endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<h3><?php echo $section_reference_home['titre_app_web']; ?></h3>
								<?php echo $section_reference_home['accroche_app_web'];
								if(!empty( $section_reference_home['realisations_app_web'] ) ) : ?>
								<div class="grid">
									<?php foreach ($section_reference_home['realisations_app_web'] as $realisation_vitrine) :
										$post = $realisation_vitrine;
										setup_postdata( $post ); ?>
										<div class="col-6_xs-12">
											<?php get_template_part( 'template-parts/realisation/content', 'home' ); ?>
										</div>
										<?php wp_reset_postdata();
										endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<!-- Fin Section 3 -->

			<!-- Section 4 : Contact -->
			<section class="row">
				<div class="grid">
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<h3>Nous contacter</h3>
								<?php echo do_shortcode('[contact-form-7 id="49" title="Formulaire de contact accueil"]'); ?>
							</div>
						</div>
					</div>
					<div class="col-6_xs-12">
						<div class="section">
							<div class="">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
									Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
									 Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
								 </p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Fin Section 4 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
