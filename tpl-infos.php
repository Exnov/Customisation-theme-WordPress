<?php
/*
Template Name: Page Infos
*/

get_header(); ?>

	<div id="primary" class="content-area col-md-12">
		<main id="main" class="post-wrap" role="main">

			<?php while ( have_posts() ) : the_post(); 

				get_template_part( 'content', 'page' );				
				get_template_part( 'content', 'info' ); //affichage des CPT infos

				endwhile; // end of the loop. 
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
		
	


	

<?php get_footer(); ?>
