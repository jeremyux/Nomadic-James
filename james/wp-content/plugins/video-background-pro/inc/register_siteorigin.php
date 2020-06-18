<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Video Background Pro fields for SiteOrigin
 *
 * @since 3.0.0
 * @param Array $fields the SiteOrigin fields.
 */
function vidbgpro_register_siteorigin_fields( $fields ) {

	$prefix     = 'vidbg_so_';
	$group_name = 'vidbg_so';

	$fields[ $prefix . 'type' ] = array(
		'name'        => __( 'Video Background Type', 'video-background-pro' ),
		'type'        => 'select',
		'description' => __( 'Please specify if you would like to self host your video background or use a YouTube video instead.', 'video-background-pro' ),
		'options'     => array(
			'self-host' => __( 'Self Host', 'video-background-pro' ),
			'youtube'   => __( 'YouTube', 'video-background-pro' ),
			'vimeo'     => __( 'Vimeo', 'video-background-pro' ),
		),
		'group'       => $group_name,
		'priority'    => 1,
	);

	$fields[ $prefix . 'youtube_url' ] = array(
		'type'        => 'text',
		'name'        => __( 'Link to YouTube video', 'video-background-pro' ),
		'description' => __( 'Please specify the link to the YouTube video.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 25,
	);

	$fields[ $prefix . 'youtube_start' ] = array(
		'type'        => 'text',
		'name'        => __( 'Youtube Start Second', 'video-background-pro' ),
		'description' => __( 'The second the YouTube video background starts on.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 26,
	);

	$fields[ $prefix . 'youtube_end' ] = array(
		'type'        => 'text',
		'name'        => __( 'Youtube End Second', 'video-background-pro' ),
		'description' => __( 'The second the YouTube video background ends on.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 27,
	);

	$fields[ $prefix . 'vimeo_url' ] = array(
		'type'        => 'text',
		'name'        => __( 'Link to Vimeo video', 'video-background-pro' ),
		'description' => __( 'Please specify the link to the Vimeo video.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 25,
	);

	$fields[ $prefix . 'end_frame_poster' ] = array(
		'type'        => 'checkbox',
		'name'        => __( 'End video on fallback image?', 'video-background-pro' ),
		'description' => __( 'If you would like your video to end on the fallback image, you can enable it here.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 75,
	);

	$fields[ $prefix . 'frontend_play_button' ] = array(
		'type'        => 'checkbox',
		'name'        => __( 'Enable play/pause button on the frontend?', 'video-background-pro' ),
		'description' => __( 'By enabling this option, a play/pause button will show up in the bottom right hand corner of the video background.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 85,
	);

	$fields[ $prefix . 'frontend_volume_button' ] = array(
		'type'        => 'checkbox',
		'name'        => __( 'Eanble mute/unmute button on the frontend?', 'video-background-pro' ),
		'description' => __( 'By enabling this option, a mute/unmute button will show up in the bottom right hand corner of the video background.', 'video-background-pro' ),
		'group'       => $group_name,
		'priority'    => 86,
	);

	$fields[ $prefix . 'frontend_position' ] = array(
		'type'        => 'select',
		'name'        => __( 'Frontend Buttons Position', 'video-background-pro' ),
		'description' => __( 'Please select the position you would like your frontend buttons to be in. (If applicable)', 'video-background-pro' ),
		'options'     => array(
			'bottom-right' => __( 'Bottom Right', 'video-background-pro' ),
			'top-right'    => __( 'Top Right', 'video-background-pro' ),
			'bottom-left'  => __( 'Bottom Left', 'video-background-pro' ),
			'top-left'     => __( 'Top Left', 'video-background-pro' ),
		),
		'group'       => $group_name,
		'priority'    => 87,
	);

	return $fields;
}
add_filter( 'vidbg_siteorigin_fields', 'vidbgpro_register_siteorigin_fields' );

/**
 * Sanitize the Video Background Pro fields for SiteOrigin Page Builder
 *
 * @since 3.0.0
 * @param Array $atts The attributes.
 */
function vidbgpro_siteorigin_fields_sanitize( $atts ) {

	if ( array_key_exists( 'overlay', $atts ) ) {
		$atts['overlay'] = true === $atts['overlay'] ? 'true' : 'false';
	}

	return $atts;

}
add_filter( 'vidbg_sanitize_siteorigin_fields', 'vidbgpro_siteorigin_fields_sanitize' );
