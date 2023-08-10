<?php
if ( !function_exists( 'shortcode_vc_blog_carousel' ) ):

function shortcode_vc_blog_carousel( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'title'				=> '',
		'limit'				=> '',
		'orderby' 			=> 'date',
	    'order' 			=> 'desc',
	    'disable_touch_drag'=> false,
	    'id'				=> '',
		'category'			=> '',
    ), $atts));

    if( empty( $id ) ) {
		$id = 0;
	}

	if( empty($category) ) {
		$category = 0;
	}

    $args = array(
		'title'					=> $title,
		'limit'					=> $limit,
		'orderby' 				=> $orderby,
		'order' 				=> $order,
		'disable_touch_drag'	=> $disable_touch_drag,
		'id'					=> $id,
		'category'				=> $category,
	);

    $html = '';
    if( function_exists( 'unicase_blog_carousel' ) ) {
		ob_start();
		unicase_blog_carousel( $args );
		$html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'unicase_blog_carousel' , 'shortcode_vc_blog_carousel' );

endif;