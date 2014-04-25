/**
 * Media upload handler script.
 *
 * Props to Thomas Griffin for the following JS code!
 * 
 * @package    Theme_Junkie_Team_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
jQuery(document).ready(function($){
	
	var tjtc_media_frame;
	
	// Bind to our click event in order to open up the new media experience.
	$(document.body).on('click.tjtcOpenMediaManager', '.tjtc-open-media', function(e){

		// Prevent the default action from occuring.
		e.preventDefault();

		// If the frame already exists, re-open it.
		if ( tjtc_media_frame ) {
			tjtc_media_frame.open();
			return;
		}

		tjtc_media_frame = wp.media.frames.tjtc_media_frame = wp.media({

			className: 'media-frame tjtc-media-frame',
			frame: 'select',
			multiple: false,
			title: tjtc_media.title,
			library: {
				type: 'image'
			},
			button: {
				text:  tjtc_media.button
			}

		});

		tjtc_media_frame.on('select', function(){
			
			// Grab our attachment selection and construct a JSON representation of the model.
			var media_attachment = tjtc_media_frame.state().get('selection').first().toJSON();

			// Send the attachment URL to our custom input field via jQuery.
			$('#tjtc-team-avatar').val(media_attachment.url);
			
		});

		// Now that everything has been set, let's open up the frame.
		tjtc_media_frame.open();

	});

});