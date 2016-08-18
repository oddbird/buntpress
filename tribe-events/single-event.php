<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

$event_id = get_the_ID();
$date_format = 'l — F j, Y @ g:ia';

?>

<div id="tribe-events-content" class="tribe-events-single">

  <!-- Notices -->
  <?php tribe_the_notices() ?>

  <?php the_title( '<h2 class="show-title">', '</h2>' ); ?>

  <p class="show-dates">
    <?php echo tribe_get_start_date ( $post_id, true, $date_format, null ); ?>
  </p>

  <?php while ( have_posts() ) :  the_post(); ?>
    <div <?php post_class(); ?>>

      <!-- Event content -->
      <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
      <div class="tribe-events-single-event-description tribe-events-content">
        <?php the_content(); ?>
      </div>

      <!-- Event meta -->
      <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
      <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

    </div> <!-- #post-x -->
  <?php endwhile; ?>

</div><!-- #tribe-events-content -->
