<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sydney
 */

get_header(); ?>

	<?php
	//vérification si sidebar présente à droite pour gérer l'espace du main
	$col='col-md-12';
	if (is_active_sidebar( 'sidebar-1' )){
		$col='col-md-9';
	}
	?>

	<div id="primary" class="content-area <?php echo($col); ?>">
		<main id="main" class="post-wrap" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php 
				get_template_part( 'content', 'page' ); 
				get_template_part( 'content', 'accueil');
				?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
