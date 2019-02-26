<?php
/*
Template Name: Page Contact
*/


get_header();

?>

	
	<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-0">
		<h1 class="title-post entry-title">Nous contacter</h1>
		<form>
			<p>Utilisez ce formulaire pour nous contacter, nous vous répondrons rapidement.</p>
			
			<!--titre-->
			<div class="form-group">
				<label for="ctc-titre">Titre du message</label>
				<input type="text" class="form-control" id="ctc-titre" name="ctc-titre" size="50" placeholder="Titre..."
				value=""> 
				<small class="text-danger">* Requis</small>
			</div>
			
			<!--nom -->
			<div class="form-group">
				<label for="ctc-nom">Votre nom</label>
				<input type="text" class="form-control" id="ctc-nom" name="ctc-nom" size="50" placeholder="Votre nom..."
				value=""> 
				<small class="text-danger">* Requis</small>
			</div>

			<!--date de naissance -->
			<div class="form-group">
				<label for="ctc-naissance">Votre date de naissance</label>
				<input type="date" class="form-control" id="ctc-naissance" name="ctc-naissance" size="50"> 
				<small class="text-danger">* Requis</small>
			</div>
			
			<!--e-mail -->
			<div class="form-group">
				<label for="ctc-mail">Votre e-mail</label>
				<input type="text" class="form-control" id="ctc-mail" name="ctc-mail" size="50" placeholder="Votre mail..."
				value=""> 
				<small class="text-danger">* Requis</small>
			</div>	

			<!--résident -->
			<br/>
		  	<div class="form-group row">
		   
		      	<div class="col-1" id="residence-case">
		        	<input type="checkbox" class="form-check-input"  value="" id="ctc-resident" name="ctc-resident">
		      	</div>

				<div class="col-11" id="residence-info">
		    		<label for="ctc-resident" class="form-check-label" >Résident de la ville</label>
		  	 	</div>
		 	</div>
		 	 <br/>	

		 	 <!--nationalité -->
			  <div class="form-group">
			    <label for="ctc-nationalite">Nationalité</label>
			    <select class="form-control" id="ctc-nationalite" name="ctc-nationalite">
			      <option value="FR">France</option>
			      <option value="AN">Anglais</option>
			      <option value="AL">Allemande</option>
			      <option value="ES">Espagnol</option>
			      <option value="AU">Autre</option>
			    </select>
			  </div>
			  <small class="text-danger">* Requis</small>
				
			<!--message -->
			<div class="form-group">
				<label for="ctc-message">Message</label>

				<textarea class="form-control" id="ctc-message" name="ctc-message" cols="42" rows="10" 
				placeholder="Votre message..."></textarea>
				<small class="text-danger">* Requis</small>
			</div>				
			
			<!--bouton -->
			<div class="form-group">
				<input type="submit" class="btn btn-default" id="send" name="send" value="Envoyer"> 
			</div>
			
		</form>
	</div>

	<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-0">
		<?php
		if(have_posts()):
			while(have_posts()):
				the_post();
				the_content();				
			endwhile;
		endif;
		?>
	</div>




<?php
get_footer();
?>