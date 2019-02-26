<?php
/**
 * The template for displaying search results pages.
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
		<main id="main" class="post-wrap blog" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3><?php printf( __( 'Search Results for: %s', 'sydney' ), '<span>' . get_search_query() . '</span>' ); ?></h31>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
					get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>