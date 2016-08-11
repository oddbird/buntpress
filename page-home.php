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
        // Retrieve the next 5 upcoming events
        $events = tribe_get_events( array(
            'posts_per_page' => 1,
            'start_date' => date( 'Y-m-d H:i:s' )
        ) );

        // Loop through the events: set up each one as
        // the current post then use template tags to
        // display the title and content
        foreach ( $events as $post ) {
          setup_postdata( $post );

          // Show the date after the title!
          echo "$post->post_title";
          echo tribe_get_start_date( $post );
          echo $event->post_content;
        }
      ?>

      </main><!-- #main -->
    </div><!-- .primary -->

  </div><!-- .wrap -->

<?php get_footer(); ?>
