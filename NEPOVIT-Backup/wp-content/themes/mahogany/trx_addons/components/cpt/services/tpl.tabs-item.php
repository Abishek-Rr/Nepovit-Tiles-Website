<?php
/**
 * The style "chess" of the Services item
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.13
 */

$args = get_query_var('trx_addons_args_sc_services');
$number = get_query_var('trx_addons_args_item_number');
$link = get_permalink();
?>
<div class="sc_services_item<?php
	echo !isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0 ? ' with_content' : ' without_content';
	if ($number-1 == $args['offset']) echo ' sc_services_item_active';
?>"<?php
	if (!empty($args['popup'])) {
		?> data-post_id="<?php echo esc_attr(get_the_ID()); ?>"<?php
		?> data-post_type="<?php echo esc_attr(TRX_ADDONS_CPT_SERVICES_PT); ?>"<?php
	}
?>><div class="sc_services_item_content">
		<div class="sc_services_item_content_inner">
			<div class="sc_services_item_subtitle"><?php trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY));?></div>
			<h3 class="sc_services_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h3>
			<?php if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) { ?>
				<div class="sc_services_item_text"><?php the_excerpt(); ?></div>
				<div class="sc_services_item_button sc_item_button"><a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button color_style_link2 sc_button_default sc_button_size_default', 'sc_services', $args)); ?>"><?php esc_html_e('Read more', 'mahogany'); ?></a></div>
			<?php } ?>
		</div>
	</div>
</div>
