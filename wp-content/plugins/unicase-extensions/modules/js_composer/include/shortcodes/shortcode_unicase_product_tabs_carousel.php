<?php
if ( !function_exists( 'shortcode_vc_product_tabs_carousel' ) ):

function shortcode_vc_product_tabs_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				=> '',
		'product_content'	=> 'recent_products',
		'tab_title_1'		=> '',
		'tab_content_1'		=> '',
		'tab_title_2'		=> '',
		'tab_content_2'		=> '',
		'tab_title_3'		=> '',
		'tab_content_3'		=> '',
		'tab_title_4'		=> '',
		'tab_content_4'		=> '',
		'carousel_items'	=> 4,
		'disable_touch_drag'=> false,
    ), $atts));

	$tabs = array(
		array(
			'slug'		=> $tab_content_1,
			'title'			=> $tab_title_1,
		),
		array(
			'slug'		=> $tab_content_2,
			'title'			=> $tab_title_2,
		),
		array(
			'slug'		=> $tab_content_3,
			'title'			=> $tab_title_3,
		),
		array(
			'slug'		=> $tab_content_4,
			'title'			=> $tab_title_4,
		),
	);

    $html = '';
    if( function_exists( 'unicase_products_tabs_carousel' ) ) {
		ob_start();
		unicase_products_tabs_carousel( $title, $product_content, $tabs, $carousel_items, $disable_touch_drag );
		$html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'unicase_product_tabs_carousel' , 'shortcode_vc_product_tabs_carousel' );

endif;