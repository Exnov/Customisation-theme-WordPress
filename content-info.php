<?php
	$args=array(
		'post_type'=>'strasbourg_infos',
		'posts_per_page'=>-1, 
		'orderby'=>'menu_order',
		'order'=>'dsc'
	);
	
	$info_query=new WP_Query($args);

	if($info_query->have_posts()): ?>
		<section class="container blog-front">
		

				<div class="row">
				<?php while($info_query->have_posts()):
						$info_query->the_post();
				?>

					<div class="col-md-6 mb-4">
						<div class="card">
							<div class="card-header bg-dark">
								<h3 class="text-center h3 titre-card text-white"><?php the_title();?></h3>
							</div>
							<div class="card-body">								
									<?php 
									//pour récupérer la valeur de l'alt de l'image
									$alt=get_image_alt($info_query->ID);
									//création et affichage de <img>
									the_post_thumbnail('infos-thumb',array(
										'class'=>'img-fluid mx-auto d-block',
										'alt'=>$alt
									));
									?>				
									<p><?php the_content();?></p>
							</div>
							<div class="card-footer">
								<p>
									publié le <time class="entry-date" datetime="<?php echo(get_the_date('c')); ?>">
										<?php echo(get_the_date()); ?></time> - <?php echo(get_the_author()); ?>						
								</p>
							</div>	
						</div>
					</div>
				<?php endwhile; wp_reset_postdata();?>	
				</div>		
				
			
		</section>
		
		<?php endif;?>