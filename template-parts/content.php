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
  <?php
    $image_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ) : null;
    if ($image_url) :
  ?>
    <div data-feature-image="large" style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
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

    <?php buntpress_show_review(); ?>

    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buntpress' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->
</article><!-- #post-## -->
