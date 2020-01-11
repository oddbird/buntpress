<?php
/**
 * Template Name: Show Archive
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

  $date_format = 'F, Y';
  $year = date('y');

  $cata = get_category_by_slug('main-stage');
  $cataID = $cata->term_id;

  $catb = get_category_by_slug('past-shows');
  $catbID = $catb->term_id;

  $tags = array(
    'orderby' => 'slug',
    'order' => 'DESC',
    'search' => 'season'
  );

  $tags_array = get_tags( $tags );

  // LOOP OF Seasons
  foreach( $tags_array as $index => $season_tag ) :

    $season = array(
      'tag' => $season_tag->slug,
      'category__in' => array($cataID, $catbID)
    );

    $posts = query_posts($season);

    if ( count($posts) > 0 ) :
  ?>
  <section data-feature-section="<?php echo $season_tag->slug ?>" >
    <h2 class="category-title">
      <?php echo $season_tag->name ?>
    </h2>
  <?php

  // LOOP OF EVENT POSTS
  foreach ($posts as $index => $post) :

    setup_postdata($post);
    $post_id = get_the_ID();
    $start_date = get_field( 'start_date', $post_id );

    if ($start_date) {
      $start_date = new DateTime( $start_date );
      $start_date = $start_date->format($date_format);
    } else {
      $start_date = get_the_date( $date_format, $post_id );
    }

    $image_size = 'thumbnail';
  ?>
    <article class="clear" data-feature="<?php echo $image_size ?>">
      <?php if ( has_post_thumbnail() ): ?>
        <div data-feature-image="<?php echo $image_size ?>">
          <?php the_post_thumbnail($image_size, ['width' => '', 'height' => 'auto']) ?>
        </div>
      <?php endif; ?>

      <div class="show-details">
        <h2 class="show-title">
          <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            <?php the_title(); ?>
          </a>
        </h2>

        <div class="show-dates">
          <?php echo $start_date ?>
        </div>

        <div class="show-summary">
          <?php the_content( '' ); ?>
        </div>
      </div>
    </article>
  <?php
    wp_reset_postdata();
    endforeach;
  ?>
    </section>
  <?php
  endif;
  endforeach;
  ?>

<?php get_footer(); ?>
