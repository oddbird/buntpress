<?php
/**
 * buntpress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package buntpress
 */

if ( ! function_exists( 'buntpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function buntpress_setup() {
  /**
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on buntpress, use a find and replace
   * to change 'buntpress' to the name of your theme in all the template files.
   * You will also need to update the Gulpfile with the new text domain
   * and matching destination POT file.
   */
  load_theme_textdomain( 'buntpress', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /**
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /**
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'buntpress' ),
    'mobile'  => esc_html__( 'Optional Mobile Menu', 'buntpress' ),
  ) );

  /**
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'buntpress_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add styles to the post editor
  add_editor_style( array( 'editor-style.css', buntpress_font_url() ) );

}
endif; // buntpress_setup
add_action( 'after_setup_theme', 'buntpress_setup' );


/**
 * WooCommerce Support
 *
 */
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buntpress_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'buntpress_content_width', 960 );
}
add_action( 'after_setup_theme', 'buntpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buntpress_widgets_init() {

  // Define sidebars
  $sidebars = array(
    'homepage'  => esc_html__( 'Homepage', 'buntpress' ),
    'footer-social'  => esc_html__( 'Footer Social', 'buntpress' ),
    'footer-signup'  => esc_html__( 'Footer Sign Up', 'buntpress' ),
  );

  // Loop through each sidebar and register
  foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
    register_sidebar( array(
      'name'          => $sidebar_name,
      'id'            => $sidebar_id,
      'description'   => sprintf ( esc_html__( 'Widget area for %s', 'buntpress' ), $sidebar_name ),
      'before_widget' => '<aside class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );
  }

}
add_action( 'widgets_init', 'buntpress_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load styles and scripts.
 */
require get_template_directory() . '/inc/scripts.php';

/*
 * Register custom metaboxes for products
 */
require get_template_directory() . '/inc/cmb-reviews.php';


/** remove additional product info **/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


/*
 * Filter out default woocommerce checkout fields
 */
function buntpress_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'buntpress_override_checkout_fields' );


/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}

add_filter( 'wootickets-tickets-email-enabled', 'no_wooticket_emails' );
function no_wooticket_emails() {
    return 'no';
}
