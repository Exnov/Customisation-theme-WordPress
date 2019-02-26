<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Sydney
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="title-post entry-title">', '</h1>' ); ?>

		<?php
		if(!is_page('mentions-legales')):
		?>
		<ul>
			<li><a href="<?php echo(get_theme_mod('facebook-link')); ?>"><i class="fab fa-facebook"></i></a></li>
			<li><a href="<?php echo(get_theme_mod('twitter-link')); ?>"><i class="fab fa-twitter"></i></a></li>
			<li><a href="<?php echo(get_theme_mod('instagram-link')); ?>"><i class="fab fa-instagram"></i></a></li>
		</ul>
		<?php
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sydney' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'sydney' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article>
