<?php
/**
 * The template for displaying all single posts.
 *
 * @package Sydney
 */

get_header(); ?>

	<?php if (get_theme_mod('fullwidth_single')) { //Check if the post needs to be full width
		$fullwidth = 'fullwidth';
	} else {
		$fullwidth = '';
	} ?>

	<?php do_action('sydney_before_content'); ?>

	<?php
	//vérification si sidebar présente à droite pour gérer l'espace du main
	$col='col-md-12';
	if (is_active_sidebar( 'sidebar-1' )){
		$col='col-md-9';
	}
	?>

	<div id="primary" class="content-area <?php echo($col); ?> <?php echo $fullwidth; ?>"> 

		<?php sydney_yoast_seo_breadcrumbs(); ?>

		<main id="main" class="post-wrap" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 

			$type_post=get_post_type();

			if($type_post=='post'): //pour 'post' (actualités du blog)
				get_template_part( 'content', 'single' ); 
			else: //pour les CPT :'strasbourg_infos' (plus d'infos), 'strasbourg_activites' (ativités du mois) et 'bouton_menu' (accueil)
				get_template_part( 'content', 'single2' ); 
			endif;			

			?>

			<?php sydney_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action('sydney_after_content'); ?>

<?php if ( get_theme_mod('fullwidth_single', 0) != 1 ) {
	get_sidebar();
} ?>
<?php get_footer(); ?>
