<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wordpress_template
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wordpress_template' ); ?></a>
<span class="js-header__border top"></span>
<header id="masthead" class="l-header c-nav js-header">
	<div class="c-nav-wrap ">
		<div class="row">
			<div class="c-nav-logo">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) : ?>
					<h1>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
				<?php else : ?>
					<p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav class="c-nav-nav">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'wordpress_template' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
			<nav class="c-nav-nav__sp">
				<nav class="js-fixed-header">
					<button type="button" class="navbar-toggle collapsed js-offcanvas-btn">
						<span class="sr-only">Toggle navigation</span>
						<span class="hiraku-open-btn-line"></span>
					</button>
				</nav><!-- /.navbar -->
				<div class="row-offcanvas row-offcanvas-right">
					<div class="sidebar-offcanvas" id="sidebar">
						<div class="list-group js-offcanvas">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
							?>
						</div>
					</div><!--/.sidebar-offcanvas-->
				</div><!--/row-->
			</nav>
		</div>
	</div>
</header><!-- #masthead -->


<div class="js-loader js-type">
	now loading....
</div>
<div id="barba-wrapper" class="container">
	<div class="row py-4 barba-container">