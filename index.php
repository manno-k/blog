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
		<!--		--><?php
		//		if ( have_posts() ) :
		//
		//			if ( is_home() && ! is_front_page() ) : ?>
		<!--				<header>-->
		<!--					<h1 class="page-title screen-reader-text">--><?php //single_post_title(); ?><!--</h1>-->
		<!--				</header>-->
		<!---->
		<!--			--><?php
		//			endif;
		//
		//			/* Start the Loop */
		//			while ( have_posts() ) : the_post();
		//
		//				/*
		//				 * Include the Post-Format-specific template for the content.
		//				 * If you want to override this in a child theme, then include a file
		//				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		//				 */
		//				get_template_part( 'template-parts/content', get_post_format() );
		//
		//			endwhile;
		//
		//			the_posts_navigation();
		//
		//		else :
		//
		//			get_template_part( 'template-parts/content', 'none' );
		//
		//		endif; ?>

		<?php
		global $post;
		$args    = array( 'posts_per_page' => 8 );
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) {
			setup_postdata( $post );
			?>
			<article>
				<a href="<?php the_permalink() ?>">
					<dl>
						<dt><?php the_time( 'Y.m.d' ) ?>
							<span class="category"><?php the_category( '｜' ) ?></span>
						</dt>
						<dd>
							<h1>
								<?php the_title(); ?>
							</h1>
						</dd>
					</dl>
				</a>
			</article>
			<?php
		}
		wp_reset_postdata();
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
