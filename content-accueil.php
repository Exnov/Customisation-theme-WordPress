<?php
	$args=array(
		'post_type'=>'bouton_menu',
		'posts_per_page'=>-1, 
		'orderby'=>'menu_order',
		'order'=>'asc'
	);

	$info_query=new WP_Query($args);

	if($info_query->have_posts()): ?>
		<section class="container blog-front">

				<!--derniere actu -->
				<article class="row mb-5 rounded border" id="last_actu">
					<h1 class="display-4 col-sm-12">Dernière actualité</h1>
				<?php
					$last_actu=get_last_post();
				?>
					<div class="col-sm-3 image-actu">
						<?php
							if($vignette=wp_get_attachment_image_src(get_post_thumbnail_id($last_actu->ID),'thumbnail')):						   
								$vignette_url=$vignette[0];
								//pour récupérer la valeur de l'alt de l'image
								$alt_actu=get_image_alt($last_actu->ID);

						?>
								<a href="<?php echo(get_permalink($last_actu->ID));?>">
									<img class="img-fluid" src="<?php echo($vignette_url);?>" alt="<?php echo($alt_actu);?>"></a>
						<?php
							endif;
						?>
					</div>
					<div class="col-sm-9 texte-actu">
						<div>
							<h2 class="display-4"><a href="<?php echo(get_permalink($last_actu->ID));?>">
								<?php echo(get_the_title($last_actu->ID));?></a>
							</h2>	
							<span class="badge badge-pill badge-primary">
								<time class="entry-date" datetime="<?php echo(format_datetime($last_actu->ID));?>">
									<?php echo(get_display_date_event($last_actu->ID)); ?>
								</time>
							</span>	

						</div>
						<p><?php echo($last_actu->post_content); ?></p>
					</div>

				</article>

				<!--gros boutons menu -->
				<div class="row">
				<!--DEBUT BOUCLE -->
				<?php while($info_query->have_posts()):
						$info_query->the_post();

						
						$id_item_menu = get_post_meta($post->ID,'_menu_id',true); //id de item menu

						//récupération dans $info_query du texte, titre et image bouton
						//récuperation de l'url et du nom de tous items menu menu						
						$liste_items=selection_menu_items();

						//recherche des url et noms des items menus qui correspondent à nos CPT "boutons-menu" en fonction de l'ID
						foreach ($liste_items as $items) {

							if(strval($items[1])==$id_item_menu ):
								$nom_menu=$items[0];
								$url_menu=$items[2];
								$vignette_bouton=wp_get_attachment_image_src(get_post_thumbnail_id($info_query->ID),'boutons-thumb');
								$vignette_bouton_url=$vignette_bouton[0];
								//pour récupérer la valeur de l'alt de l'image
								$alt_bouton=get_image_alt($info_query->ID);
								//--Affichage contenu
				?>
							<div class="col-sm-6 mb-4 gros-boutons">
								
									<div class="card">
										
										<div class="card-body"> 
											
											<a href="<?php echo($url_menu); ?>">
												<img src="<?php echo($vignette_bouton_url); ?>" alt="<?php echo($alt_bouton);?>"/>
											</a>
											<h3 class="text-center titre-card text-white"><a href="<?php echo($url_menu); ?>">
												<?php echo($nom_menu);?></a></h3>
										</div>
									</div>
								
							</div>
				<?php
								//------------------
							endif;
						}
				?>

				<?php endwhile; wp_reset_postdata();?>	
			<!--FIN BOUCLE -->
				</div>		
				
		</section>
			


	
	<?php endif;?>