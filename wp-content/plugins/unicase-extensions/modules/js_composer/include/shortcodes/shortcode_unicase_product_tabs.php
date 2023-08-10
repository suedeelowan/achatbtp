<?php
if ( !function_exists( 'shortcode_vc_product_tabs' ) ):

function shortcode_vc_product_tabs( $atts, $content = null ){

	extract(shortcode_atts(array(
		'tab_title_1'		=> '',
		'tab_content_1'		=> '',
		'tab_title_2'		=> '',
		'tab_content_2'		=> '',
		'tab_title_3'		=> '',
		'tab_content_3'		=> '',
		'product_items'		=> 3,
		'product_columns'	=> 3
    ), $atts));

	$tabs = array(
		array(
			'shortcode'		=> $tab_content_1,
			'title'			=> $tab_title_1,
		),
		array(
			'shortcode'		=> $tab_content_2,
			'title'			=> $tab_title_2,
		),
		array(
			'shortcode'		=> $tab_content_3,
			'title'			=> $tab_title_3,
		),
	);

    $html = '';
    if( function_exists( 'unicase_homepage_tabs' ) ) {
		ob_start();
		unicase_homepage_tabs( $tabs, $product_items, $product_columns );
		$html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'unicase_product_tabs' , 'shortcode_vc_product_tabs' );

endif;