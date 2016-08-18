<?php
/**
 * Template part for displaying page content in page.php.
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
      $title_display = get_field( 'title_display', $post_id );

      if ( $title_display[0] != 'hide' ) {
        the_title( '<h1 class="entry-title">', '</h1>' );
      }
    ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php
      the_content();

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buntpress' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php
      edit_post_link(
        sprintf(
          /* translators: %s: Name of current post */
          esc_html__( 'Edit %s', 'buntpress' ),
          the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<span class="edit-link">',
        '</span>'
      );
    ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
