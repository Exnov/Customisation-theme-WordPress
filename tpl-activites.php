<?php
/*
Template Name: Page Activités Mois
*/

get_header(); ?>

	
	<!--FORMULAIRE D'INSCRIPTION -->
	<div id="overlay"> <!--sous-couche inscription -->
		<form id="formInscription">
			<div class="form-group">
				<label for="nom">Nom : </label>
				<input type="text" id="nom" class="form-control" placeholder="..."/>
			</div>		
			<div class="form-group">
				<label for="prenom">Prénom: </label>
				<input type="text" id="prenom" class="form-control" placeholder="..."/>
			</div>	
			<div class="text-center">
				<button>Envoyer</button>
			</div>
		</form>
	</div>

	

	<div id="primary" class="content-area col-md-12">
		<main id="main" class="post-wrap" role="main">

			<?php while ( have_posts() ) : the_post(); 

					get_template_part( 'content', 'page' );
					get_template_part( 'content', 'activite' );
					
				endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
		
	
	

<?php get_footer(); ?>

	
