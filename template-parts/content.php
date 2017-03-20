<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buntpress
 */

?>

<article <?php post_class(); ?>>
  <?php if ( has_post_thumbnail() ) : ?>
    <div data-feature-image="large">
      <?php the_post_thumbnail('large', ['width' => '', 'height' => 'auto']) ?>
    </div>
  <?php endif; ?>

  <header class="entry-header">
    <?php
      if ( is_single() ) {
        the_title( '<h1 class="entry-title">', '</h1>' );
      } else {
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      }
    ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php
      the_content();
    ?>

    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buntpress' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->
</article><!-- #post-## -->
