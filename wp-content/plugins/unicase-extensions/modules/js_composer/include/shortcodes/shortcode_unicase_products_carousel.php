<?php
if ( !function_exists( 'shortcode_vc_products_carousel' ) ):

function shortcode_vc_products_carousel( $atts, $content = null ){

	extract(shortcode_atts(array(
		'title'				=> '',
		'type'				=> 'type-1',
		'product_content'	=> 'recent_products',
		'product_ids'		=> '',
		'category_slug'		=> 'unicase-all-categories',
		'carousel_items'	=> 4,
		'disable_touch_drag'=> false,
    ), $atts));

    $html = '';
    if( function_exists( 'unicase_products_carousel' ) ) {
		ob_start();
		unicase_products_carousel( $title, $type, $product_content, $category_slug, $carousel_items, $disable_touch_drag, $product_ids );
		$html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'unicase_products_carousel' , 'shortcode_vc_products_carousel' );

endif;