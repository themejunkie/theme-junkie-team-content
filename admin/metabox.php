<?php
/**
 * Meta boxes functions for the plugin.
 *
 * @package    Theme_Junkie_Team_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Register meta boxes. */
add_action( 'add_meta_boxes', 'tjtc_add_meta_boxes' );

/* Save meta boxes. */
add_action( 'save_post', 'tjtc_meta_boxes_save', 10, 2 );

/**
 * Registers new meta boxes for the 'team_item' post editing screen in the admin.
 *
 * @since  0.1.0
 * @access public
 * @link   http://codex.wordpress.org/Function_Reference/add_meta_box
 */
function tjtc_add_meta_boxes() {

	/* Check if current screen is team page. */
	if ( 'member' != get_current_screen()->post_type )
		return;

	add_meta_box( 
		'tjtc-metaboxes-team',
		__( 'Team Member Settings', 'tjtc' ),
		'tjtc_metaboxes_display',
		'member',
		'normal',
		'high'
	);

}

/**
 * Displays the content of the meta boxes.
 *
 * @param  object  $post
 * @since  0.1.0
 * @access public
 */
function tjtc_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'tjtc-metaboxes-team-nonce' ); ?>

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-avatar">
				<strong><?php _e( 'Avatar', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Upload or insert member avatar.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-avatar" id="tjtc-team-avatar" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_avatar', true ) ); ?>" size="30" style="width: 83%;" placeholder="<?php echo esc_attr( 'http://' ) ?>" />
			<a href="#" class="tjtc-open-media button" title="<?php esc_attr_e( 'Add Image', 'tjtc' ); ?>"><?php _e( 'Add Image', 'tjtc' ); ?></a>
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-position">
				<strong><?php _e( 'Position', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'The member position.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-position" id="tjtc-team-position" value="<?php echo sanitize_text_field( get_post_meta( $post->ID, 'tj_member_position', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php esc_attr_e( 'Web Designer', 'tjtc' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-twitter">
				<strong><?php _e( 'Twitter', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Twitter URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-twitter" id="tjtc-team-twitter" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_twitter_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://twitter.com/username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-facebook">
				<strong><?php _e( 'Facebook', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Facebook URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-facebook" id="tjtc-team-facebook" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_facebook_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://www.facebook.com/username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-gplus">
				<strong><?php _e( 'Google Plus', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Google Plus URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-gplus" id="tjtc-team-gplus" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_googleplus_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://plus.google.com/+username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-linkedin">
				<strong><?php _e( 'LinkedIn', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'LinkedIn URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-linkedin" id="tjtc-team-linkedin" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_linkedin_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://www.linkedin.com/in/username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-pinterest">
				<strong><?php _e( 'Pinterest', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Pinterest URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-pinterest" id="tjtc-team-pinterest" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_pinterest_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://pinterest.com/username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<div id="tjtc-block">

		<div class="tjtc-label">
			<label for="tjtc-team-dribbble">
				<strong><?php _e( 'Dribbble', 'tjtc' ); ?></strong><br />
				<span class="description"><?php _e( 'Dribbble URL.', 'tjtc' ); ?></span>
			</label>
		</div>

		<div class="tjtc-input">
			<input type="text" name="tjtc-team-dribbble" id="tjtc-team-dribbble" value="<?php echo esc_url( get_post_meta( $post->ID, 'tj_member_dribbble_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://dribbble.com/username' ); ?>" />
		</div>

	</div><!-- #tjtc-block -->

	<?php
}

/**
 * Saves the metadata for the team item info meta box.
 *
 * @param  int     $post_id
 * @param  object  $post
 * @since  0.1.0
 * @access public
 */
function tjtc_meta_boxes_save( $post_id, $post ) {

	if ( ! isset( $_POST['tjtc-metaboxes-team-nonce'] ) || ! wp_verify_nonce( $_POST['tjtc-metaboxes-team-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'tj_member_avatar'         => esc_url( $_POST['tjtc-team-avatar'] ),
		'tj_member_position'       => wp_filter_post_kses( $_POST['tjtc-team-position'] ),
		'tj_member_twitter_url'    => esc_url( $_POST['tjtc-team-twitter'] ),
		'tj_member_facebook_url'   => esc_url( $_POST['tjtc-team-facebook'] ),
		'tj_member_googleplus_url' => esc_url( $_POST['tjtc-team-gplus'] ),
		'tj_member_linkedin_url'   => esc_url( $_POST['tjtc-team-linkedin'] ),
		'tj_member_pinterest_url'  => esc_url( $_POST['tjtc-team-pinterest'] ),
		'tj_member_dribbble_url'   => esc_url( $_POST['tjtc-team-dribbble'] )
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}

}