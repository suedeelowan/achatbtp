<?php

if ( !function_exists( 'shortcode_vc_banner' ) ):

function shortcode_vc_banner( $atts, $content = null ){

	extract( shortcode_atts( array(
		'banner_image'           	=> '',
		'banner_image_bg_pos'		=> '',
		'banner_link'            	=> '',
		'banner_link_target'     	=> '_self',
		'banner_hover_animation' 	=> '',
		'banner_text_position'   	=> '',
		'wrap_container'			=> '', 
		'el_class'               	=> '',
		'background_color'			=> '',
		'background_size'			=> '',
		'background_repeat'			=> '',
		'color'						=> '',
		'height'					=> '',
		'banner_text_el_class'		=> '',
    ), $atts ) );

    $element = 'unicase_banner';

    $css_class = trim( 'unicase-banner-wrapper ' . $el_class . ' ' . $banner_text_position );

    if( !empty( $banner_text_el_class ) ) {
    	$banner_text_el_class = ' ' . $banner_text_el_class;
    }

	$banner = '';
	
	if( !empty( $content ) ) {
		$banner_content = function_exists( 'wpb_js_remove_wpautop' ) ? wpb_js_remove_wpautop( $content, true ) : $content ;
		$banner = '<div class="caption"><div class="banner-text' . esc_attr( $banner_text_el_class ). '">' . $banner_content . '</div></div>';
	}

	$unicase_banner_style_attr = '';
	
	if( !empty( $height ) ) {
		$unicase_banner_style_attr .= 'height:' . $height . 'px;';
	}

	if( !empty( $unicase_banner_style_attr ) ) {
		$unicase_banner_style_attr = 'style="' . esc_attr( $unicase_banner_style_attr ) . '"';
	}

	$banner = '<div class="unicase-banner" ' . $unicase_banner_style_attr . '>' . $banner . '</div>';

	if( $wrap_container == '1' ) {
		$banner = '<div class="container">' . $banner . '</div>';
	}

	$banner_image_bg_url = '';
	
	if( !empty( $banner_image ) ) {
		$banner_image_src = wp_get_attachment_image_src( $banner_image, 'full' );

		if( isset( $banner_image_src[0] ) ) {
			$banner_image_bg_url = $banner_image_src[0];
		}
	}

	$style_attr = '';

	if( ! empty( $banner_image_bg_url ) ) {
		$style_attr .= 'background-image:url(' . esc_url( $banner_image_bg_url ) . ');';

		if( ! empty( $banner_image_bg_pos ) ) {
			$style_attr .= 'background-position:' . $banner_image_bg_pos . ';';
		}

		if( !empty( $background_size ) ) {
			$style_attr .= 'background-size:' . $background_size . ';';
		} else {
			$style_attr .= 'background-size:cover;';
		}

		if( !empty( $background_repeat ) ) {
			$style_attr .= 'background-repeat:' . $background_repeat . ';';
		} else {
			$style_attr .= 'background-repeat:no-repeat;';
		}
	}

	if( !empty( $background_color ) ) {
		$style_attr .= 'background-color:' . $background_color  . ';';
	}

	if( !empty( $color ) ) {
		$style_attr .= 'color:' . $color . ';';
	}

	if( ! empty( $style_attr ) ) {
		$style_attr = 'style="' . esc_attr( $style_attr ) . '"';
	}

	if( !empty( $banner_link ) ) {
		$banner = '<a class="' . esc_attr( $css_class ) . '" ' . $style_attr. ' href="' . esc_url( $banner_link ) . '" target="' . esc_attr( $banner_link_target ) . '">'  . $banner . '</a>';
	} else {
		$banner = '<div class="' . esc_attr( $css_class ) . '" ' . $style_attr . '>' . $banner . '</div>';
	}

	return $banner;
}

add_shortcode( 'unicase_banner' , 'shortcode_vc_banner' );
endif;