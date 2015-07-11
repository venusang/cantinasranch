<?php

// Gallery Settings
$gallery_settings =& new ECF_Panel('gallery_settings_panel', __('General Settings','rebirth'), 'gallery-items', 'normal', 'high');
$gallery_big_image = ECF_Field::factory('set', 'show_big_image', __('Show the big image?','rebirth') )->help_text(__('This will display a big version of the Featured Post Image as an introduction at the top of the gallery.','rebirth'));
$gallery_big_image->add_options(array(true => __('Yes','rebirth')));
$gallery_settings->add_fields(array(
	$gallery_big_image,
));

// Panel for Pages
$featured_item = ECF_Field::factory('set', 'page_featured', __('Add to Slider?','rebirth') );
$featured_item->add_options(array('featured' => __('Yes','rebirth')));
$item_caption = ECF_Field::factory('text', 'page_caption', __('Image Caption','rebirth'))->help_text(__('The caption displays under the image on the left.','rebirth'));
$item_button_text = ECF_Field::factory('text', 'page_button_text', __('Button Text','rebirth'))->help_text(__('This is the text in the button that links to the page (default is "View More")','rebirth'));
$homepage_slider_panel =& new ECF_Panel('homepage_slider_panel_pages', __('Homepage Slider Settings','rebirth'), 'page', 'normal', 'high');
$homepage_slider_panel->add_fields(array( $featured_item, $item_caption, $item_button_text));

// Panel for Videos
$video_link = ECF_Field::factory('text', 'video_link', 'Link to Video');
$video_link->help_text(__('Paste the link here to a <strong>Vimeo</strong> or <strong>Youtube</strong> video page.<br /><br /><strong>Youtube Example:</strong> http://www.youtube.com/watch?v=UF8uR6Z6KLc<br /><strong>Vimeo Example:</strong> http://vimeo.com/30195371','rebirth'));
$video_link_panel =& new ECF_Panel('video_link_panel', __('Video Link','rebirth'), 'video-items', 'normal', 'high');
$video_link_panel->add_fields(array( $video_link ));

// Panel for Audio Items
$audiofile_mp3 = ECF_Field::factory('file', 'file_mp3', 'MP3 File');
$audiofile_mp3->help_text(__('Upload the MP3 version of your audio file.','rebirth'));
$audiofile_external_mp3 = ECF_Field::factory('text', 'file_external_mp3', 'External MP3 File');
$audiofile_external_mp3->help_text(__('Alternatively, link to an external MP3 file. This will override any uploaded ones.','rebirth'));

$audio_files_panel =& new ECF_Panel('audio_files_panel', __('Upload Audio Files','rebirth'), 'audio-items', 'normal', 'high');
$audio_files_panel->add_fields(array( $audiofile_mp3, $audiofile_external_mp3));

// Panel for Events
$event_startdate = ECF_Field::factory('date', 'start_date_visual', 'Start Date');
$event_startdate->help_text(__('Pick the start date for this event.','rebirth'));
$event_startdate_real = ECF_Field::factory('hidden', 'start_date', '');
$event_enddate = ECF_Field::factory('date', 'end_date_visual', 'End Date (optional)');
$event_enddate->help_text(__('Optionally, pick an end date for this event. Leave this blank if this is a one day event.','rebirth'));
$event_enddate_real = ECF_Field::factory('hidden', 'end_date', '');
$event_location = ECF_Field::factory('textarea', 'address', 'Address');
$event_location->help_text(__('Optionally, enter the address for this event\'s location and it will display a Google Map for directions.','rebirth'));
$event_custom_title = ECF_Field::factory('text', 'custom_title', 'Custom Data (Title)');
$event_custom_title->help_text(__('Optionally, you can enter in some custom data. This will be the title.','rebirth'));
$event_custom_html = ECF_Field::factory('textarea', 'custom_text', 'Custom Data (Text, HTML allowed)');
$event_custom_html->help_text(__('Optionally, you can enter in some custom data. This will be the text (HTML Allowed!).','rebirth'));
$event_map = ECF_Field::factory('set', 'event_map', __('Map Setting','rebirth') );
$event_map->add_options(array('hide_event_map' => __('Display the <strong>Featured Image</strong> (or nothing if no featured image is set) instead of the <strong>Big Map</strong>','rebirth')));
$events_panel =& new ECF_Panel('events_panel', __('Event Settings','rebirth'), 'event-items', 'normal', 'high');
$events_panel->add_fields(array( $event_startdate, $event_startdate_real,$event_enddate,$event_enddate_real,$event_location,$event_map,$event_custom_title,$event_custom_html));

/* Hide footer map settings - Added in v1.5 */
$hide_footer_map_post = ECF_Field::factory('set', 'hide_footer_map_post', __('Hide the map in the footer on this post?','rebirth') );
$hide_footer_map_post->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_post =& new ECF_Panel('footer_map_panel_post', __('Footer Map Options','rebirth'), 'post', 'normal', 'high');
$footer_map_panel_post->add_fields(array( $hide_footer_map_post ));

$hide_footer_map_page = ECF_Field::factory('set', 'hide_footer_map_page', __('Hide the map in the footer on this page?','rebirth') );
$hide_footer_map_page->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_page =& new ECF_Panel('footer_map_panel_page', __('Footer Map Options','rebirth'), 'page', 'normal', 'high');
$footer_map_panel_page->add_fields(array( $hide_footer_map_page ));

$hide_footer_map_galleries = ECF_Field::factory('set', 'hide_footer_map_galleries', __('Hide the map in the footer on this gallery?','rebirth') );
$hide_footer_map_galleries->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_galleries =& new ECF_Panel('footer_map_panel_galleries', __('Footer Map Options','rebirth'), 'gallery-items', 'normal', 'high');
$footer_map_panel_galleries->add_fields(array( $hide_footer_map_galleries ));

$hide_footer_map_videos = ECF_Field::factory('set', 'hide_footer_map_videos', __('Hide the map in the footer on this video?','rebirth') );
$hide_footer_map_videos->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_videos =& new ECF_Panel('footer_map_panel_videos', __('Footer Map Options','rebirth'), 'video-items', 'normal', 'high');
$footer_map_panel_videos->add_fields(array( $hide_footer_map_videos ));

$hide_footer_map_audio = ECF_Field::factory('set', 'hide_footer_map_audio', __('Hide the map in the footer on this audio post?','rebirth') );
$hide_footer_map_audio->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_audio =& new ECF_Panel('footer_map_panel_audio', __('Footer Map Options','rebirth'), 'audio-items', 'normal', 'high');
$footer_map_panel_audio->add_fields(array( $hide_footer_map_audio ));

$hide_footer_map_events = ECF_Field::factory('set', 'hide_footer_map_events', __('Hide the map in the footer on this event?','rebirth') );
$hide_footer_map_events->add_options(array('hide' => __('Yes','rebirth')));
$footer_map_panel_events =& new ECF_Panel('footer_map_panel_events', __('Footer Map Options','rebirth'), 'event-items', 'normal', 'high');
$footer_map_panel_events->add_fields(array( $hide_footer_map_events ));


/* Slides */

// General Slide Settings
// Link Type
$slide_link_type = ECF_Field::factory('linkselect', 'slide_link_type', 'Link to');
$slide_link_type->add_options(array('' => 'Nothing','page' => 'Page...','post' => 'Post...','gallery' => 'Gallery Post...', 'video' => 'Video Post...', 'audio' => 'Audio Post...','event' => 'Event...','custom' => 'Custom URL...'));
$slide_link_type->help_text(__('<strong>PLEASE NOTE:</strong> Image slides are linked via the image and caption. All other slide types are just linked via the caption.','glory'));

$slide_hide_caption = ECF_Field::factory('set', 'slide_hide_caption', __('Hide the caption?','glory') );
$slide_hide_caption->add_options(array('slide_hide_caption' => __('Yes','glory')));

// Custom Link
$slide_link_custom = ECF_Field::factory('text', 'slide_link_custom', 'Custom URL');
$slide_link_custom->help_text(__('Enter any URL to link this slide.','glory'));

// Page Link
$slide_link_page = ECF_Field::factory('select', 'slide_link_page', 'Page');
$slide_link_page->add_options(page_array());

// Post Link
$slide_link_post = ECF_Field::factory('select', 'slide_link_post', 'Post');
$slide_link_post->add_options(post_array());

// Gallery Link
$slide_link_gallery = ECF_Field::factory('select', 'slide_link_gallery', 'Gallery');
$slide_link_gallery->add_options(post_array('gallery-items'));

// Video Link
$slide_link_video = ECF_Field::factory('select', 'slide_link_video', 'Video Post');
$slide_link_video->add_options(post_array('video-items'));

// Audio Link
$slide_link_audio = ECF_Field::factory('select', 'slide_link_audio', 'Audio Post');
$slide_link_audio->add_options(post_array('audio-items'));

// Event Link
$slide_link_event = ECF_Field::factory('select', 'slide_link_event', 'Event');
$slide_link_event->add_options(post_array('event-items'));

// Slide Type
$slide_type = ECF_Field::factory('slideselect', 'slide_type', 'Slide Type');
$slide_type->add_options(array('' => 'Select a type...','image' => 'Image','video' => 'Video','audio' => 'Audio','map' => 'Google Map'));
$slide_type->help_text(__('<strong>REQUIRED</strong> &mdash; You must select the type of slide this is.','glory'));

// Slide Button Text
$button_text = ECF_Field::factory('text', '_slide_button_text', 'Button Text');
$button_text->help_text(__('<strong>OPTIONAL</strong> &mdash; If you don\'t enter text, one will be automatically generated.','glory'));

$slide_settings_panel =& new ECF_Panel('slide_settings_panel', __('Slide Settings','glory'), 'slide-items', 'normal', 'high');
$slide_settings_panel->add_fields(array($slide_type,$slide_link_type,$slide_link_custom,$slide_link_page,$slide_link_post,$slide_link_gallery,$slide_link_video,$slide_link_audio,$slide_link_event,$slide_hide_caption,$button_text));

// Audio Settings
$slide_audiofile_mp3 = ECF_Field::factory('file', 'slide_file_mp3', 'MP3 File');
$slide_audiofile_mp3->help_text(__('Upload the MP3 version of your audio file.','glory'));
$slide_audiofile_external_mp3 = ECF_Field::factory('text', 'slide_file_external_mp3', 'External MP3 File');
$slide_audiofile_external_mp3->help_text(__('Alternatively, link to an external MP3 file. This will override any uploaded ones.','glory'));

$slide_audio_files_panel =& new ECF_Panel('slide_audio_panel', __('Audio Settings','glory'), 'slide-items', 'normal', 'high');
$slide_audio_files_panel->add_fields(array( $slide_audiofile_mp3, $slide_audiofile_external_mp3));

// Video Settings
$slide_video_link = ECF_Field::factory('text', 'slide_video_link', 'Link to Video');
$slide_video_link->help_text(__('Paste the link here to a <strong>Vimeo</strong> or <strong>Youtube</strong> video page.<br /><br /><strong>Youtube Example:</strong> http://www.youtube.com/watch?v=UF8uR6Z6KLc<br /><strong>Vimeo Example:</strong> http://vimeo.com/30195371','glory'));
$slide_video_link_panel =& new ECF_Panel('slide_video_panel', __('Video Settings','glory'), 'slide-items', 'normal', 'high');
$slide_video_link_panel->add_fields(array( $slide_video_link ));

// Google Map Settings
$slide_address = ECF_Field::factory('textarea', 'slide_address', 'Address');
$slide_address_panel =& new ECF_Panel('slide_address_panel', __('Google Map Settings','glory'), 'slide-items', 'normal', 'high');
$slide_address_panel->add_fields(array( $slide_address ));
?>