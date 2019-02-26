<?php
	$args=array(
		'post_type'=>'strasbourg_activites',
		'posts_per_page'=>-1, 
		'orderby'=>'menu_order',
		'order'=>'dsc'
	);
	
	$info_query=new WP_Query($args);

	if($info_query->have_posts()): ?>

		<table class="table table-hover" id="tableauInscription">
			<thead>
				<tr>
					<th scope="col">Date</th>
					<th scope="col">Activité</th>
					<th scope="col">Description</th>
					<th scope="col">Inscription</th>
				</tr>
			</thead>

			<tbody>
			<!--DEBUT BOUCLE -->
				<?php while($info_query->have_posts()):
						$info_query->the_post();
						$date = new DateTime(get_post_meta($post->ID,'_activite_meta_date',true));

				?>

					<th scope="row"><?php echo ($date->format('d/m/Y')); ?></th>
					<td><?php the_title(); ?></td>
					<td><?php the_content(); ?></td>
					<td><button class="inscription">S'inscrire</button></td>
					</tr>


				<?php endwhile; wp_reset_postdata();?>	
			<!--FIN BOUCLE -->
			</tbody>

		</table>


		<!--version mobile -->
		<table class="table" id="tableauInscription2">
			<tbody>
				<!--DEBUT BOUCLE -->
				<?php while($info_query->have_posts()):
						$info_query->the_post();
						$date = new DateTime(get_post_meta($post->ID,'_activite_meta_date',true));;
				?>

					<tr>
     					 <th scope="col"><?php echo ($date->format('d/m/Y')); ?></th>
     				</tr>
     				<tr>
     					 <td scope="col"><?php the_title(); ?></td>
     				</tr>
				    <tr>
     					 <td scope="col"><?php the_content(); ?></td>
     				</tr>
     				<tr>
     					 <td scope="col"><button class="inscription">S'inscrire</button></td>
     				</tr>

				<?php endwhile; wp_reset_postdata();?>	
				<!--FIN BOUCLE -->
			</tbody>		
		</table>


	
	<?php endif;?>