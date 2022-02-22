<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fabthemes
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<nav id="top-navigation" class="top-navigation" role="navigation">
		<div class="container"> <div class="row"> 
			<div class="col-md-12">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'topnav' ) ); ?>

			</div>
		</div></div>
	</nav><!-- #top-navigation -->

	<header id="masthead" class="site-header" role="banner">
		<div class="container"> <div class="row"> 
			<div class="col-sm-6">
				<div class="site-branding">
					
	<?php if (get_theme_mod(FT_scope::tool()->optionsName . '_logo', '') != '') { ?>
				<h1 class="site-title logo"><a class="mylogo" rel="home" href="<?php bloginfo('siteurl');?>/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img relWidth="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxWidth', 0)); ?>" relHeight="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxHeight', 0)); ?>" id="ft_logo" src="<?php echo get_theme_mod(FT_scope::tool()->optionsName . '_logo', ''); ?>" alt="" /></a></h1>
	<?php } else { ?>
				<h1 class="site-title logo"><a id="blogname" rel="home" href="<?php bloginfo('siteurl');?>/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<?php } ?>

					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="search-box">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div></div>
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="container"> <div class="row"> 
			<div class="col-md-12">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ,'menu_id' => 'subnav' ) ); ?>
			</div>
		</div></div>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">
		<div class="container"> <div class="row"> 
