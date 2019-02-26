<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sydney
 */

get_header(); 

$layout = sydney_blog_layout();

?>

	<?php do_action('sydney_before_content'); ?>

	<?php
	//vérification si sidebar présente à droite pour gérer l'espace du main
	$col='col-md-12';
	if (is_active_sidebar( 'sidebar-1' )){
		$col='col-md-9';
	}
	?>	

	<div id="primary" class="content-area <?php echo($col); ?> <?php echo esc_attr( $layout ); ?>">

		<?php sydney_yoast_seo_breadcrumbs(); ?>

		<main id="main" class="post-wrap blog" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h3 class="archive-title">', '</h3>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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