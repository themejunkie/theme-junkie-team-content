<?php
/**
 * File for registering post type.
 *
 * @package    Theme_Junkie_Team_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @link       http://codex.wordpress.org/Function_Reference/register_post_type
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Register custom post type on the 'init' hook. */
add_action( 'init', 'tjtc_register_post_type' );

/**
 * Registers post type needed by the plugin.
 *
 * @since  0.1.0
 * @access public
 */
function tjtc_register_post_type() {

	$labels = array(
	    'name'               => __( 'Teams', 'tjtc' ),
	    'singular_name'      => __( 'Team', 'tjtc' ),
    	'menu_name'          => __( 'Teams', 'tjtc' ),
    	'name_admin_bar'     => __( 'Team', 'tjtc' ),
		'all_items'          => __( 'Teams', 'tjtc' ),
	    'add_new'            => __( 'Add New', 'tjtc' ),
		'add_new_item'       => __( 'Add New Team', 'tjtc' ),
		'edit_item'          => __( 'Edit Team', 'tjtc' ),
		'new_item'           => __( 'New Team', 'tjtc' ),
		'view_item'          => __( 'View Team', 'tjtc' ),
		'search_items'       => __( 'Search Teams', 'tjtc' ),
		'not_found'          => __( 'No Teams found', 'tjtc' ),
		'not_found_in_trash' => __( 'No Teams found in trash', 'tjtc' ),
		'parent_item_colon'  => '',
	);

	$defaults = array(	
		'labels'              => apply_filters( 'tjtc_team_labels', $labels ),
		'public'              => true,
		'exclude_from_search' => true,
		'menu_position'       => 56,
		'menu_icon'           => 'dashicons-businessman',
		'supports'            => array( 'title', 'editor', 'revisions', 'page-attributes' ),
		'rewrite'             => array( 'slug' => 'member', 'with_front' => false ),
		'has_archive'         => true
	);

	$args = apply_filters( 'tjtc_team_args', $defaults );

	register_post_type( 'member', $args );

}