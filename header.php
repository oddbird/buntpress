<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buntpress
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $is_IE; if ( $is_IE ) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<script src="https://use.typekit.net/jjc1nib.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <span class="svg-defs"><?php buntpress_include_svg_icons(); ?></span>

  <aside class="site-messages">
    <a href="<?php echo get_site_url() ?>/donate/" class="message">
      Support Buntport »
    </a>
  </aside>

  <header data-region="banner">

    <h1 class="brand">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <span class="buntport">Buntport</span>
        <span class="theater">Theater</span>
      </a>
    </h1>

    <nav id="site-navigation" class="nav">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu'
        ) );
      ?>
    </nav>

  </header>

  <main id="main" data-region="main">
