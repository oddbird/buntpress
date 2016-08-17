<?php
/**
 * Template Name: Home
 *
 * This is the template that displays the home page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buntpress
 */

get_header(); ?>

  <div class="wrap">
    <div class="primary content-area">
      <main id="main" class="site-main" role="main">

        <?php
        // Ensure the global $post variable is in scope
        global $post;

        $terms = get_terms( 'tribe_events_cat' );
        $tribe_categories = tribe_get_event_cat_slugs();

        // The URL for the "View all" link.
        $link_to_all = tribe_events_get_list_widget_view_all_link( $instance );

        foreach( $terms as $tribe_category ){

          // Retrieve the next 5 upcoming events
          $events = tribe_get_events( array(
              'posts_per_page' => 1,
              'tax_query'=> array(
                array(
                  'taxonomy' => 'tribe_events_cat',
                  'field' => 'slug',
                  'terms' => $tribe_category
                )
              )
          ) );

        foreach ( $events as $post ) : setup_postdata( $post ); ?>

        <article class="featured-event-wrapper <?php tribe_events_event_classes() ?>">
          <?php if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'large', array( 'class' => 'featured-event-image' ));
            }
          ?>

          <h1 class="event-title">
            <a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
          </h1>

          <?php // Get any custom fields for this event
          $fields = tribe_get_custom_fields();

          // Is `Show runs from` set and not empty?
          if ( isset( $fields['Show runs from'] ) and !empty( $fields['Show runs from'] ) ) { ?>
            <span class="season-duration h3">
              <?php tribe_custom_field('Show runs from'); ?>
            </span>
          <?php } ?>

          <?php the_excerpt(); ?>

          <?php endforeach;
          wp_reset_postdata(); ?>

        </article>
        <?php } ?>

      </main><!-- #main -->
    </div><!-- .primary -->
  </div><!-- .wrap -->

<?php get_footer(); ?>
