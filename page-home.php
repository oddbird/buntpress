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

  $categories = [
    'feature' => 1,
    'main-stage' => 5,
    'third-tuesdays' => 1,
    'all-ages' => 1,
    'special' => 3,
  ];

  $category_names = [
    'feature' => null,
    'main-stage' => null,
    'third-tuesdays' => 'Third Tuesdays',
    'all-ages' => 'All Ages',
    'special' => 'Guests & Special Events',
  ];

  $date_format = 'F j, Y';

  $has_feature = false;
  $today = date('Ymd');

  // LOOP OF CATEGORIES
  foreach( $categories as $type => $count ) :
    $category_title = $category_names[$type];

    $season = array(
      'numberposts' => $count,
      'category_name' => $type
    );

    $posts = array_reverse ( query_posts($season) );
    $i = 0;

    // IF POSTS
    if ( count($posts) > 0 ) :

      $has_feature = ( $type == 'feature' ) ? true : $has_feature;

    // LOOP OF EVENT POSTS
    foreach ($posts as $index => $post) :
      setup_postdata($post);
      $post_id = get_the_ID();
      $start_date = get_field( 'start_date', $post_id );
      $end_date = get_field( 'end_date', $post_id );
      $end_date = ( $end_date ) ? $end_date : $start_date;

      // IF CURRENT
      if ( ( $end_date >= $today ) or ($type == 'feature') ) :
        $start_date = new DateTime( $start_date );
        $end_date = new DateTime( $end_date );
        $i = ++$i;

        $image_size = ( ( $type == 'feature' ) or ( ( $has_feature != true ) and ($type == 'main-stage') and ( $i == 1 ) ) ) ? 'large' : 'thumbnail';
        $ticket_url = get_field( 'ticket_url', $post_id );
        $ticket_link = ( $ticket_url ) ? $ticket_url : get_permalink();
        $hide_tickets = get_field( 'hide_tickets', $post_id );

        $display_date = get_field( 'display_date', $post_id );

        // IF FIRST LIVE POST
        if ($i == 1) :
    ?>
      <section data-feature-section="<?php echo $type ?>" >
        <?php if ( $category_title ): ?>
          <h2 class="category-title">
            <?php echo $category_title ?>
          </h2>
        <?php endif; ?>

    <?php endif; // END FIRST LIVE POST ?>

    <article class="clear" data-feature="<?php echo $image_size ?>">
      <?php if ( has_post_thumbnail() ): ?>
        <div data-feature-image="<?php echo $image_size ?>"<?php if ( $image_size != 'large' ): ?> style="background-image: url(<?php echo get_the_post_thumbnail_url($post_id); ?>);"<?php endif; ?>>
          <?php the_post_thumbnail($image_size, ['width' => '', 'height' => 'auto']) ?>
        </div>
      <?php endif; ?>

      <?php if ( ! $hide_tickets ): ?>
        <a href="<?php echo esc_url( $ticket_link ); ?>" class="ticket-link">
          <span>Tickets</span>
        </a>
      <?php endif; ?>

      <div class="show-details">
        <h2 class="show-title">
          <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            <?php the_title(); ?>
          </a>
        </h2>

        <div class="show-dates">
          <?php
            if ($display_date) {
              echo $display_date;
            } else {
              echo $start_date->format($date_format);

              if ( $end_date != $start_date ) {
                echo '—';
                echo $end_date->format($date_format);
              }
            }
          ?>
        </div>

        <div class="show-summary">
          <?php the_content( '' ); ?>
        </div>
      </div>
    </article>
  <?php
    endif; // END CURRENT
    wp_reset_postdata();
    endforeach; // EVENT POSTS

    if ($i > 0) : // IF LIVE POSTS
  ?>
    </section>
  <?php
    endif; // LIVE POSTS
  endif; // POSTS
  endforeach; // CATEGORIES
  ?>

<?php get_footer(); ?>
