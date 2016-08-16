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

        foreach( $terms as $tribe_category ){

          echo '<article class="featured-event-wrapper">';

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

        // Loop through the events: set up each one as
        // the current post then use template tags to
        // display the title and content
        foreach ( $events as $post ) : setup_postdata( $post ); ?>

        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'large', array( 'class' => 'featured-event-image' ));
          }
        ?>

          <h1 class="event-title">
            <a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
          </h1>

          <?php the_excerpt(); ?>

        <?php endforeach;
        wp_reset_postdata();

        echo '</article>';

      }
    ?>


      </main><!-- #main -->
    </div><!-- .primary -->

  </div><!-- .wrap -->

<?php get_footer(); ?>
