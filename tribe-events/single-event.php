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

?>

<div id="tribe-events-content" class="tribe-events-single">

  <!-- Notices -->
  <?php tribe_the_notices() ?>

  <?php the_title( '<h1>', '</h1>' ); ?>

  <div class="tribe-events-schedule">
    <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
  </div>

  <?php while ( have_posts() ) :  the_post(); ?>
    <div <?php post_class(); ?>>
      <!-- Event featured image, but exclude link -->
      <?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

      <!-- Event content -->
      <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
      <div class="tribe-events-single-event-description tribe-events-content">
        <?php the_content(); ?>
      </div>

      <!-- Event meta -->
      <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
      <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

      <!-- show reviews if available -->
      <?php buntpress_show_review(); ?>

      </div> <!-- #post-x -->
    <?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
  <?php endwhile; ?>

</div><!-- #tribe-events-content -->
