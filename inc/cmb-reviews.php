<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 * *
 * @category Buntpress
 * @package  Buntpress CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
  require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
  require_once dirname( __FILE__ ) . '/CMB2/init.php';
}




add_action( 'cmb2_admin_init', 'buntpress_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function buntpress_register_repeatable_group_field_metabox() {
  $prefix = 'buntpress_';

  /**
   * Repeatable Field Groups
   */
  $cmb_group = new_cmb2_box( array(
    'id'           => $prefix . 'metabox',
    'title'        => __( 'Reviews', 'cmb2' ),
    'object_types' => array( 'tribe_events' ),
  ) );

  // $group_field_id is the field id string, so in this case: $prefix . 'demo'
  $group_field_id = $cmb_group->add_field( array(
    'id'          => $prefix . 'reviews',
    'type'        => 'group',
    'options'     => array(
      'group_title'   => __( 'Review {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Review', 'cmb2' ),
      'remove_button' => __( 'Remove Review', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );

  /**
   * Group fields works the same, except ids only need
   * to be unique to the group. Prefix is not needed.
   *
   * The parent field's id needs to be passed as the first argument.
   */
  $cmb_group->add_group_field( $group_field_id, array(
    'name'       => __( 'Review Title', 'cmb2' ),
    'id'         => 'review-title',
    'type'       => 'text',
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name'        => __( 'Review', 'cmb2' ),
    'description' => __( 'The main content of the review', 'cmb2' ),
    'id'          => 'review-main',
    'type'        => 'textarea_small',
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name' => __( 'Entry Image', 'cmb2' ),
    'id'   => 'review-image',
    'type' => 'file',
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name' => __( 'Image Caption', 'cmb2' ),
    'id'   => 'review-image_caption',
    'type' => 'text',
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name'       => __( 'Review Name', 'cmb2' ),
    'id'         => 'review-name',
    'type'       => 'text',
  ) );

}
