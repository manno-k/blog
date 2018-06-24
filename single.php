<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wordpress_template
 */

get_header(); ?>

	<main class="l-page ">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			//			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			//			if ( comments_open() || get_comments_number() ) :
			//				comments_template();
			//			endif;

		endwhile; // End of the loop.
		?>
		<nav class="c-post-link">
			<?php previous_post_link( '<div class="left">%link', '<i class="fa fa-arrow-left fa-fw"></i> %title</div>' ); ?>
			<?php next_post_link( '<div class="right">%link', '%title<i class="fa fa-arrow-right fa-fw"></i> </div>' ); ?>
		</nav>
		<?php get_template_part('template-parts/related','post'); ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
