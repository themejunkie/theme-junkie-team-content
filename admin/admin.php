<?php
/**
 * Admin functions for the plugin.
 *
 * @package    Theme_Junkie_Team_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Set up the admin functionality. */
add_action( 'admin_menu', 'tjtc_admin_setup' );

/**
 * Plugin's admin functionality.
 *
 * @since  0.1.0
 * @access public
 */
function tjtc_admin_setup() {

	/* Filter the 'enter title here' placeholder. */
	add_filter( 'enter_title_here', 'tjtc_title_placeholder', 10 );

	/* Custom columns on the edit member screen. */
	add_filter( 'manage_edit-member_columns', 'tjtc_edit_member_columns' );
	add_action( 'manage_member_posts_custom_column', 'tjtc_manage_member_columns', 10, 2 );
	add_filter( 'manage_edit-member_sortable_columns', 'tjtc_column_sortable' );

}

/**
 * Filter the 'enter title here' placeholder.
 *
 * @param  string  $title
 * @since  0.1.0
 * @access public
 * @return string
 */
function tjtc_title_placeholder( $title ) {

	if ( 'member' == get_current_screen()->post_type )
		$title = esc_attr__( 'Enter member name here', 'tjtc' );
	
	return $title;
}

/**
 * Sets up custom columns on the member edit screen.
 *
 * @param  array  $columns
 * @since  0.1.0
 * @access public
 * @return array
 */
function tjtc_edit_member_columns( $columns ) {
	global $post;

	unset( $columns['title'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Name', 'tjtc' )
	);

	if ( get_post_meta( $post->ID, 'tj_member_avatar', true ) )
		$new_columns['avatar'] = __( 'Image', 'tjtc' );

	$new_columns['position'] = __( 'Position', 'tjtc' );
	$new_columns['menu_order'] = __( 'Order', 'tjtc' );

	return array_merge( $new_columns, $columns );
}

/**
 * Displays the content of custom member columns on the edit screen.
 *
 * @param  string  $column
 * @param  int     $post_id
 * @since  0.1.0
 * @access public
 */
function tjtc_manage_member_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'avatar' :

			if ( get_post_meta( $post->ID, 'tj_member_avatar', true ) )
				echo '<img src="' . esc_url( get_post_meta( $post->ID, 'tj_member_avatar', true ) ) . '" style="width: 75px; height: 75px;" />';

			break;

		case 'position' :

			if ( get_post_meta( $post->ID, 'tj_member_position', true ) )
				echo get_post_meta( $post->ID, 'tj_member_position', true );

			break;

		case 'menu_order':

		    $order = $post->menu_order;
		    echo $order;

		    break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/**
 * Make Order column sortable.
 * 
 * @since  0.1.0
 * @access public
 * @return object
 */
function tjtc_column_sortable( $columns ) {
	$columns['menu_order'] = 'menu_order';
	return $columns;
}