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

  <?php
  // Ensure the global $post variable is in scope
  global $post;

  $this_season = 'season-16';
  $date_format = 'F j, Y';

  $season = array(
    'numberposts' => 10,
    'category_name' => 'main-stage',
    'tag' => $this_season
  );

  $mainstage = array_reverse ( query_posts($season) );

  foreach ($mainstage as $index=>$post) : setup_postdata();
    $tickets = get_site_url() . '/shows/';
    $post_id = get_the_ID();
    $today = date('Ymd');
    $start_date = get_field( 'start_date', $post_id );
    $end_date = get_field( 'end_date', $post_id );
    $end_date = ( $end_date ) ? $end_date : $start_date;
    $image_size = ( $index == 0 ) ? 'large' : 'medium';
    $image_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $image_size ) : null;

    if ( $end_date > $today ):
      $start_date = new DateTime( $start_date );
      $end_date = new DateTime( $end_date );
  ?>
    <article data-feature="main-stage" class="clear">
      <?php if ( $image_url ): ?>
        <div data-feature-image="<?php echo $image_size ?>" style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
      <?php endif; ?>

      <a href="<?php echo $tickets . $start_date->format('Y-m') . '/'; ?>" class="ticket-link">
        <span>Tickets</span>
      </a>

      <h2 class="show-title">
        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
          <?php the_title(); ?>
        </a>
      </h2>

      <div class="show-dates">
        <?php
          echo $start_date->format($date_format);

          if ( $end_date != $start_date ) {
            echo '—';
            echo $end_date->format($date_format);
          }
        ?>
      </div>

      <div class="show-summary">
        <?php the_content( '' ); ?>
      </div>
    </article>
  <?php
    endif;
  endforeach;

  $todaysDate = date('Y-m-d G:i:s');
  $slugs = array('third-tuesdays', 'all-ages', 'special-events');
  foreach( $slugs as $slug ) :

    $events = tribe_get_events( array(
        'posts_per_page' => 1,
        'start_date' => date( 'Y-m-d H:i:s' ),
        'tax_query'=> array(
          array(
            'taxonomy' => 'tribe_events_cat',
            'field' => 'slug',
            'terms' => $slug
          )
        )
    ) );

    foreach ( $events as $post ) : setup_postdata( $post );
      $post_id = get_the_ID();
      $image_size = 'medium';
      $image_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $image_size ) : null;
      $calendar_url = $tickets . tribe_get_start_date ( $post_id, false, 'Y-m', null ) . '/';
      $ticket_url = get_field( 'one_off', $post_id ) ? tribe_get_event_link() : $calendar_url;
    ?>
    <article data-feature="<?php echo $slug ?>" class="clear">
      <h2 class="category-title">
        <?php if ( $slug == 'third-tuesdays' ): ?>
          Third Tuesdays
        <?php elseif ( $slug == 'all-ages' ) : ?>
          All Ages
        <?php elseif ( $slug == 'special-events' ) : ?>
          Guests & Special Events
        <?php endif; ?>
      </h2>


      <?php if ( $image_url ): ?>
        <div data-feature-image="<?php echo $image_size ?>" style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
      <?php endif; ?>

      <a href="<?php echo $ticket_url; ?>" class="ticket-link">
        <span>Tickets</span>
      </a>

      <h3 class="show-title">
        <a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark">
          <?php the_title(); ?>
        </a>
      </h3>

      <div class="show-dates">
        <?php
          echo tribe_get_start_date ( $post_id, false, $date_format, null );
        ?>
      </div>

      <div class="show-summary">
        <?php the_content( '' ); ?>
      </div>
    </article>
  <?php
    endforeach;

  endforeach;
  wp_reset_postdata();
  ?>

<?php get_footer(); ?>
