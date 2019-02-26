<!--row -->
<article class="row mb-3">
	<div class="col-sm-2 image-actu">
		<?php
			if($vignette=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'thumbnail')):						   
				$vignette_url=$vignette[0];
				//pour récupérer la valeur de l'alt de l'image
				$alt_actu=get_image_alt($post->ID);
		?>
				<a href="<?php the_permalink();?>">
					<img class="img-fluid" src="<?php echo($vignette_url);?>" alt="<?php echo($alt_actu);?>">
				</a>
		<?php
			endif;
		?>
	</div>
	<div class="col-sm-10 texte-actu">
		<div>
			<h1 class="display-4"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
			<span class="badge badge-pill badge-primary">
				<time class="entry-date" datetime="<?php echo(format_datetime($post->ID));?>">
					<?php echo(get_display_date_event($post->ID)); ?>
				</time>
			</span>
			
		</div>
		
		<p>
			<?php
				echo(affichage_meta(
						esc_attr(get_the_date('c')),
						esc_html(get_the_date()),
						get_the_category_list(', '),
						get_the_author()
						)
				);								
			?>							
		</p>
		<p><?php the_excerpt();?></p>
	</div>
	
</article>

