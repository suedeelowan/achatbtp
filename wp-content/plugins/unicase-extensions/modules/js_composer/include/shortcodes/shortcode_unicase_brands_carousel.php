<?php

if ( !function_exists( 'shortcode_vc_brands_carousel' ) ):

function shortcode_vc_brands_carousel( $atts, $content = null ){

	extract( shortcode_atts( array(
		'title' 			=> '',
	    'limit' 			=> '12',
	    'has_no_products'	=> false,
	    'orderby' 			=> 'date',
	    'order' 			=> 'desc',
	    'include_ids'		=> '',
	    'disable_touch_drag'=> false,
    ), $atts ) );

	$html = '';
    if( function_exists( 'unicase_brands_carousel' ) ) {
		ob_start();
		unicase_brands_carousel( $title, $limit, $has_no_products, $orderby, $order, $include_ids, $disable_touch_drag );
		$html = ob_get_clean();
    }

	return $html;

}

add_shortcode( 'unicase_brands_carousel' , 'shortcode_vc_brands_carousel' );

endif;