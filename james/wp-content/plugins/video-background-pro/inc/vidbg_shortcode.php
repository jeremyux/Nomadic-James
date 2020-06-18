<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create shortcode for Video background Pro
 *
 * @since 1.1.1
 *
 * @uses shortcode_atts()
 * @uses wp_add_inline_script()
 * @param Array $atts The attributes.
 * @param Null  $content The content passed to the shortcode.
 */
function vidbg_shortcode( $atts, $content = null ) {
	$a = shortcode_atts(
		array(
			'container'              => 'body',
			'type'                   => 'self-host',
			'youtube_url'            => 'null',
			'youtube_start'          => '0',
			'youtube_end'            => 'null',
			'vimeo_url'              => 'null',
			'mp4'                    => 'null',
			'webm'                   => 'null',
			'poster'                 => 'null',
			'end_frame_poster'       => 'false',
			'loop'                   => 'true',
			'overlay'                => 'false',
			'overlay_color'          => '#000',
			'overlay_alpha'          => '0.3',
			'frontend_play_button'   => 'false',
			'frontend_volume_button' => 'false',
			'frontend_position'      => 'bottom-right',
			'player_options'         => 'null',
			'frontend_container'     => 'null',
			'source'                 => 'Shortcode',
		),
		$atts,
		'vidbg'
	);

	$js_config = array(
		'poster'                   => 'null' === $a['poster'] ? null : $a['poster'],
		'endOnPoster'              => ( 'true' === $a['end_frame_poster'] ),
		'loop'                     => ( 'true' === $a['loop'] ),
		'isOverlayEnabled'         => ( 'true' === $a['overlay'] ),
		'overlayColor'             => $a['overlay_color'],
		'overlayAlpha'             => (float) $a['overlay_alpha'],
		'isFrontendPlayEnabled'    => ( 'true' === $a['frontend_play_button'] ),
		'isFrontendVolumeEnabled'  => ( 'true' === $a['frontend_volume_button'] ),
		'frontendButtonsPosition'  => $a['frontend_position'],
		'frontendButtonsContainer' => 'null' === $a['frontend_container'] ? null : $a['frontend_container'],
		'isRtl'                    => is_rtl()
	);

	$player_do_not_track = false;
	$player_do_not_track = apply_filters( 'vidbgpro_player_do_not_track', $player_do_not_track );

	if ( true === $player_do_not_track ) {
		$js_config['doNotTrack'] = true;
	}

	switch ( $a['type'] ) {
		case 'self-host':
			$a['type'] = 'local';

			$js_options = array(
				'mp4'  => 'null' === $a['mp4'] ? null : $a['mp4'],
				'webm' => 'null' === $a['webm'] ? null : $a['webm'],
			);

			if ( 'null' !== $a['player_options'] ) {
				$js_options['videoAttributes'] = json_decode( $a['player_options'] );
			}

			break;
		case 'youtube':
			$js_options = array(
				'url'         => 'null' === $a['youtube_url'] ? null : $a['youtube_url'],
				'startSecond' => (int) $a['youtube_start'],
				'endSecond'   => 'null' === $a['youtube_end'] ? null : (int) $a['youtube_end'],
			);

			if ( 'null' !== $a['player_options'] ) {

				$js_options['playerOptions'] = json_decode( $a['player_options'] );
			}

			break;
		case 'vimeo':
			$js_options = array(
				'url' => 'null' === $a['vimeo_url'] ? null : $a['vimeo_url'],
			);

			if ( 'null' !== $a['player_options'] ) {
				$player_options = $a['player_options'];
				$player_options = urldecode($player_options);
				$player_options = json_decode($player_options);
				$js_options['playerOptions'] = $player_options;
			}

			break;
		default:
			$js_options = array();
			break;
	}

	$js = array(
		$a['container'],
		$a['type'],
		$js_config,
		$js_options,
	);

	if ( 'null' !== $a['poster'] ) {
		$styles = '
		' . $a['container'] . ' > .vidbg-container {
			background-image: url(' . $a['poster'] . ');
		}
	';

		wp_register_style( 'vidbgpro-inline-styles', false );
		wp_enqueue_style( 'vidbgpro-inline-styles' );
		wp_add_inline_style( 'vidbgpro-inline-styles', $styles );
	}

	$output = '
		jQuery(function($) {
			// ' . $a['source'] . "
			VideoBackgroundPro.instances['" . $a['container'] . "'] = new VideoBackgroundPro(
				'" . $a['container'] . "',
				'" . $a['type'] . "',
				" . wp_json_encode( $js_config ) . ',
				' . wp_json_encode( $js_options ) . '
			);
		})
	';

	// Add our vidbgpro init using wp_add_inline_script().
	wp_add_inline_script( 'vidbgpro', $output );

}
add_shortcode( 'vidbg', 'vidbg_shortcode' );
