<?php
/**
 * The home template file.
 *
 * @package Sydney
 */

get_header(); 
$layout = sydney_blog_layout();

?>

	<?php do_action('sydney_before_content'); ?>

	<div id="primary" class="content-area col-md-12">

		<?php sydney_yoast_seo_breadcrumbs(); ?>
		
		<main id="main" class="post-wrap blog" role="main">



		<?php if ( have_posts() ) : ?>


		<?php //titre de la page
			$titre_page=$wp_query->queried_object->post_title;			
		?>
	
	
		<header class="entry-header">
			<h1 class="title-post entry-title"><?php echo($titre_page);  ?></h1>

			<ul>
				<li><a href="<?php echo(get_theme_mod('facebook-link')); ?>"><i class="fab fa-facebook"></i></a></li>
				<li><a href="<?php echo(get_theme_mod('twitter-link')); ?>"><i class="fab fa-twitter"></i></a></li>
				<li><a href="<?php echo(get_theme_mod('instagram-link')); ?>"><i class="fab fa-instagram"></i></a></li>
			</ul>

		</header>
	

		<div class="posts-layout actus-fil">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content', 'actu' );
				?>

			<?php endwhile; ?>
		</div>

		<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
			) );
		?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action('sydney_after_content'); ?>

<?php 

	if ( ( $layout == 'classic-alt' ) || ( $layout == 'classic' ) ) :
	get_sidebar();
	endif;

?>
<?php get_footer(); ?>
