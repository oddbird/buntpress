<?php
/**
 * Template Name: Past Shows List
 *
 * This is the template that displays the home page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buntpress
 */

get_header(); ?>

  <main class="wrap">

  <?php
  // Ensure the global $post variable is in scope
  global $post;

  $terms = get_terms( 'tribe_events_cat' );
  $tribe_categories = tribe_get_event_cat_slugs();

  foreach( $terms as $tribe_category ) {
    $events = tribe_get_events( array(
      'eventDisplay' => 'past',
      'posts_per_page' => 1,
      'tax_query'=> array(
        array(
          'taxonomy' => 'tribe_events_cat',
          'field' => 'slug',
          'terms' => $tribe_category
        )
      )
    ) );

    foreach ( $events as $post ) : setup_postdata( $post );
      $post_id = get_the_ID();
      $image_size = ( $index == 0 ) ? 'large' : 'medium';
      $image_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $image_size ) : null;
      ?>

      <article data-feature="past-show" class="clear">
        <?php if ( $image_url ): ?>
          <div data-feature-image="<?php echo $image_size ?>" style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
        <?php endif; ?>

        <h2 class="show-title">
          <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            <?php the_title(); ?>
          </a>
        </h2>

        <div class="show-summary">
          <?php the_excerpt(); ?>
        </div>

        <?php buntpress_show_review(); ?>
      </article>

    <?php endforeach;
    wp_reset_postdata();
  } ?>

  </main><!-- .wrap -->

<?php get_footer(); ?>
