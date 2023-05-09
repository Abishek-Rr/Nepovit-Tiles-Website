<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.14
 */
$mahogany_header_video = mahogany_get_header_video();
$mahogany_embed_video = '';
if (!empty($mahogany_header_video) && !mahogany_is_from_uploads($mahogany_header_video)) {
	if (mahogany_is_youtube_url($mahogany_header_video) && preg_match('/[=\/]([^=\/]*)$/', $mahogany_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$mahogany_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($mahogany_header_video) . '[/embed]' ));
			$mahogany_embed_video = mahogany_make_video_autoplay($mahogany_embed_video);
		} else {
			$mahogany_header_video = str_replace('/watch?v=', '/embed/', $mahogany_header_video);
			$mahogany_header_video = mahogany_add_to_url($mahogany_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$mahogany_embed_video = '<iframe src="' . esc_url($mahogany_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php mahogany_show_layout($mahogany_embed_video); ?></div><?php
	}
}
?>