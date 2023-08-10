<?php

require UNICASE_EXTENSIONS_DIR . '/modules/theme-shortcodes/class-unicase-query-shortcode.php';

#-----------------------------------------------------------------
# Shortcodes using [query] calss
#-----------------------------------------------------------------

// [blog] shortcode
//................................................................
if ( ! function_exists( 'blog_query' ) ) :
	function blog_query( $args = null, $content = null ) {

		return custom_wp_query( $args, $content );
	}
	
	add_shortcode( 'blog', 'blog_query' );
endif;

// [shop] shortcode
//................................................................
if ( ! function_exists( 'shop_query' ) ) :
	function shop_query( $args = null, $content = null ) {

		if( class_exists( 'WooCommerce' ) ){
			
			$catalog_ordering_args = WC()->query->get_catalog_ordering_args();

			if( $args == null ){
				$args = array();
			}

			if( is_array( $args ) ){
				$args = array_merge( $args, $catalog_ordering_args );
			}

			$args['wc_get_template'] = true;
		}

		$args['template'] = 'archive-product.php';

		if( ! isset( $args['columns'] ) || empty( $args['columns'] ) ) {
			$args['columns'] = 3;
		}

		global $woocommerce_loop;

		$woocommerce_loop['columns'] = $args['columns'];

		// post type
		if ( !isset( $args['post_type'] ) || empty( $args['post_type'] ) ) {
			$args['post_type'] = 'product';
		}

		// orderby
		if ( !isset( $args['orderby'] ) || empty( $args['orderby'] ) ) {
			$args['orderby'] = 'menu_order'; // default by sort order
		}
		
		if ( !isset( $args['order'] ) || empty( $args['order'] ) ) {
			$args['order'] = 'ASC'; // default order
		}
		
		// categories 
		if ( isset( $args['category'] ) ) {
			$args['taxonomy_slug'] = 'product_category';
			unset($args['category']);
		}

		return custom_wp_query( $args, $content );
	}
	
	add_shortcode('shop', 'shop_query');
endif;

// [compare] shortcode
//................................................................
if( ! function_exists( 'unicase_compare_page' ) ) {
	
	function unicase_compare_page() {
		ob_start();
		if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
			global $yith_woocompare;
			
			if( function_exists( 'wc_get_template' ) ) {
				wc_get_template( 'compare.php', array( 
					'products' 			  => $yith_woocompare->obj->get_products_list(), 
					'fields' 			  => $yith_woocompare->obj->fields(),
					'repeat_price' 		  => get_option( 'yith_woocompare_price_end' ),
					'repeat_add_to_cart'  => get_option( 'yith_woocompare_add_to_cart_end' )
				) );
			}
		} else {
			echo '<p class="alert alert-danger">' . esc_html__( 'You need to enable YITH Compare plugin for product comparison to work', 'unicase-extensions' ) . '</p>';
		}
		
		return ob_get_clean();
	}
}
add_shortcode( 'unicase_compare_page', 'unicase_compare_page' );

if ( ! function_exists( 'unicase_vc_terms' ) ) :

	function unicase_vc_terms( $atts, $content = null ){

		$atts = shortcode_atts( array(
			'taxonomy'     => 'category',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 0,
			'include'      => '',
			'exclude'      => '',
			'number'       => 0,
			'offset'       => 0,
			'name'         => '',
			'slug'         => '',
			'hierarchical' => true,
			'child_of'     => 0,
			'parent'       => ''
		), $atts, 'unicase_terms' );

		// Unset empty optional args
		$optional_args = array( 'include', 'exclude', 'name', 'slug', 'parent' );

		foreach( $optional_args as $optional_arg ) {
			if ( empty ( $atts[ $optional_arg ] ) ) {
				unset( $atts[ $optional_arg ] );
			}
		}

		// Check for comma separated and convert into arrays
		$comma_separated_args = array( 'taxonomy', 'include', 'exclude', 'name', 'slug' );

		foreach ( $comma_separated_args as $comma_separated_arg ) {
			if ( !empty( $atts[ $comma_separated_arg ] ) ) {
				$atts[$comma_separated_arg] = explode( ',', $atts[$comma_separated_arg] );
			}
		}

		//Cast int or number
		$int_args = array( 'hide_empty', 'number', 'offset', 'hierarchical', 'child_of', 'parent' );

		foreach ( $int_args as $int_arg ) {
			if ( !empty( $atts[ $int_arg ] ) ) {
				$atts[ $int_arg ] = (int) $atts[ $int_arg ];
			}
		}

		$terms = get_terms( $atts );

		$html = '';

		foreach ( $terms as $term ) {
			$html .= '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>';
		}

		if ( ! empty( $html ) ) {
			$html = '<ul>' . $html . '</ul>';
		}

	    return $html;
	}

	add_shortcode( 'unicase_terms' , 'unicase_vc_terms' );

endif;