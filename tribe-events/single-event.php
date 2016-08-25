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
  <?php
    $image_size = ( $index == 0 ) ? 'large' : 'medium';
    $image_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $image_size ) : null;

    if ( $image_url ):
  ?>
    <div data-feature-image="<?php echo $image_size ?>" style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
  <?php endif; ?>

  <!-- Notices -->
  <?php tribe_the_notices() ?>

  <h2 class="show-title">
    <?php the_title(); ?>
  </h2>

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
