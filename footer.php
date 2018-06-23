<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wordpress_template
 */

?>
</div><!--.row-->
</div><!--.container-->
<footer class="l-footer c-nav">
	<div class="c-nav-wrap">
		<div class="row">
			<nav class="c-nav-nav__bottom">
				<a id="js-top">
					<i class="fa fa-chevron-circle-up fa-2x fa-fw" aria-hidden="true"></i>
				</a>
				<a href="https://www.instagram.com/rundy_k/" target="_blank">
					<i class="fa fa-instagram fa-2x fa-fw" aria-hidden="true"></i>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
					<i class="fa fa-envelope-o fa-2x fa-fw" aria-hidden="true"></i>
				</a>
			</nav>
			<p class="c-nav-logo js-footer">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
