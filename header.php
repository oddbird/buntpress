<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<h1 role="banner">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
  </a>
</h1>

<nav role="navigation">
  <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</nav>
