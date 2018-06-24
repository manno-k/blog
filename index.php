<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wordpress_template
 */

get_header(); ?>

	<main class="l-page index">
		<?php
		$paged     = (int) get_query_var( 'paged' );
		$args      = array(
			'posts_per_page' => 5,
			'paged'          => get_query_var( 'paged' ),
			'post_type'      => 'post',
			'post_status'    => 'publish'
		);
		$the_query = new WP_Query( $args );
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

		get_template_part('template-parts/content','archive');

			endwhile;
		endif; ?>

		<?php
//		pagination();
		the_posts_navigation();
		wp_reset_query(); ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
