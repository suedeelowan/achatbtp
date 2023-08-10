<?php
/**
 * Single Product Accessories
 *
 * This template can be overridden by copying it to yourtheme/templates/shop/single-product/tabs/accessories.php.
 *
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$loop_columns = apply_filters( 'unicase_accessories_loop_columns', 4 );
$posts_per_page = 4;

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
	global $woocommerce_loop;
	$woocommerce_loop['columns'] = $loop_columns;
} else {
	wc_set_loop_prop( 'columns', $loop_columns );
}

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
	$current_product_id = isset( $product->id ) ? $product->id : 0;
} else {
	$current_product_id = $product->get_id();
}
$accessories = Unicase_WC_Helper::get_accessories( $product );
array_unshift( $accessories, $current_product_id );

if ( sizeof( $accessories ) === 0 && !array_filter( $accessories ) ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = apply_filters( 'unicase_accessories_query_args', array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => 'post__in',
	'post__in'            => $accessories,
	'meta_query'          => $meta_query
) );

unset( $args['meta_query'] );

$products = new WP_Query( $args );

$add_to_cart_checkbox 	= '';
$total_price 			= 0;
$count 					= 0;

if ( $products->have_posts() ) : ?>

	<div class="accessories">

		<div class="unicase-wc-message"></div>
		<div class="accessories-wrapper">
			<div class="accessories-product columns-<?php echo esc_attr( $loop_columns ); ?>">

				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<?php
							global $product;

							// Ensure visibility
							if ( empty( $product ) || ! $product->is_visible() ) {
								return;
							}

							if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
								$product_id = isset( $product->id ) ? $product->id : 0;
								$product_type = isset( $product->product_type ) ? $product->product_type : 'simple';
							} else {
								$product_id = $product->get_id();
								$product_type = $product->get_type();
							}

							if ( $price_html = $product->get_price_html() ) {
								if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
									$display_price = $product->get_display_price();
								} else {
									$display_price = wc_get_price_to_display( $product );
								}
								$price_html = '<span class="accessory-price">' . wc_price( $display_price ) . $product->get_price_suffix() . '</span>';
							}

							$total_price += wc_get_price_to_display( $product );

							$prefix = '';

							$count++;

							$disabled_attr = ( $current_product_id == $product_id ) ? 'disabled' : '';
							$add_to_cart_checkbox .= '<div class="checkbox accessory-checkbox"><label><input checked type="checkbox" class="product-check" data-price="'  . $display_price . '" data-product-id="' . $product_id . '" data-product-type="' . $product_type . '" '. $disabled_attr .' /> <span class="product-title">' . $prefix . get_the_title() . '</span> - ' . $price_html . '</label></div>';
						?>

						<li <?php post_class(); ?>>

							<?php woocommerce_template_loop_product_link_open(); ?>
							<?php woocommerce_template_loop_product_thumbnail(); ?>
							<?php woocommerce_template_loop_product_title(); ?>
							<?php woocommerce_template_loop_price(); ?>
							<?php woocommerce_template_loop_product_link_close(); ?>

						</li>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

			</div>

			<div class="check-products">
				<?php echo ( $add_to_cart_checkbox ); ?>
			</div>

			<div class="accessories-product-total-price">
				<div class="total-price">
					<?php
						$total_price_text = apply_filters( 'unicase_accessories_product_total_price_text', esc_html__( 'Bundle Price for selected items', 'unicase' ) );
						$total_price_html = '<span class="total-price-html price">' . wc_price( $total_price ) . $product->get_price_suffix() . '</span>';
						$total_products_html = '<span class="total-products">' . $count . '</span>';
						$total_price = sprintf( '%s <span>%s</span>', $total_price_html, $total_price_text );
						echo wp_kses_post( $total_price );
					?>
				</div>
				<div class="accessories-add-all-to-cart">
					<button type="button" class="button btn btn-primary add-all-to-cart"><?php echo esc_html__( 'Add Bundle to cart', 'unicase' ); ?></button>
				</div>
			</div>
		</div>
		<?php
			$alert_message = apply_filters( 'unicase_accessories_product_cart_alert_message', array(
				'success'		=> sprintf( '<div class="woocommerce-message">%s <a class="button wc-forward" href="%s">%s</a></div>', esc_html__( 'Products was successfully added to your cart.', 'unicase' ), wc_get_cart_url(), esc_html__( 'View Cart', 'unicase' ) ),
				'empty'			=> sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'No Products selected.', 'unicase' ) ),
				'no_variation'	=> sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Product Variation does not selected.', 'unicase' ) ),
				'not_available'	=> sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Sorry, this product is unavailable.', 'unicase' ) ),
			) );
			ob_start(); ?>
			jQuery(document).ready(function($) {

				function accessory_checked_count(){
					var product_count = 0;
					$('.accessory-checkbox .product-check').each(function() {
						if( $(this).is(':checked') ) {
							if( $(this).data( 'price' ) !== '' ) {
								product_count++;
							}
						}
					});
					return product_count;
				}

				function accessory_checked_total_price(){
					var total_price = 0;
					$('.accessory-checkbox .product-check').each(function() {
						if( $(this).is(':checked') ) {
							if( $(this).data( 'price' ) !== '' ) {
								total_price += parseFloat( $(this).data( 'price' ) );
							}
						}
					});
					return total_price;
				}

				function accessory_checked_product_ids(){
					var product_ids = [];
					$('.accessory-checkbox .product-check').each(function() {
						if( $(this).is(':checked') ) {
							product_ids.push( $(this).data( 'product-id' ) );
						}
					});
					return product_ids;
				}

				function accessory_unchecked_product_ids(){
					var product_ids = [];
					$('.accessory-checkbox .product-check').each(function() {
						if( ! $(this).is(':checked') ) {
							product_ids.push( $(this).data( 'product-id' ) );
						}
					});
					return product_ids;
				}

				function accessory_checked_variable_product_ids(){
					var variable_product_ids = [];
					$('.accessory-checkbox .product-check').each(function() {
						if( $(this).is(':checked') && $(this).data( 'product-type' ) == 'variable' ) {
							variable_product_ids.push( $(this).data( 'product-id' ) );
						}
					});
					return variable_product_ids;
				}

				function accessory_is_variation_selected(){
					if( $(".single_add_to_cart_button").is(":disabled") ) {
						return false;
					}
					return true;
				}

				function accessory_is_variation_available(){
					if( $(".single_add_to_cart_button").length === 0 || $(".single_add_to_cart_button").hasClass("disabled") || $(".single_add_to_cart_button").hasClass("wc-variation-is-unavailable") ) {
						return false;
					}
					return true;
				}

				function accessory_is_product_available(){
					if( $(".single_add_to_cart_button").length === 0 || $(".single_add_to_cart_button").hasClass("disabled") ) {
						return false;
					}
					return true;
				}

				function accessory_refresh_fragments( response ){
					var this_page = window.location.toString();
					var fragments = response.fragments;
					var cart_hash = response.cart_hash;

					// Block fragments class
					if ( fragments ) {
						$.each( fragments, function( key ) {
							$( key ).addClass( 'updating' );
						});
					}

					// Replace fragments
					if ( fragments ) {
						$.each( fragments, function( key, value ) {
							$( key ).replaceWith( value );
						});
					}

					// Cart page elements
					$( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

						$( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

						$( document.body ).trigger( 'cart_page_refreshed' );
					});

					$( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
						$( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
					});
				}

				$( 'body' ).on( 'found_variation', function( event, variation ) {
					$('.accessory-checkbox .product-check').each(function() {
						if( $(this).is(':checked') && $(this).data( 'product-type' ) == 'variable' ) {
							$(this).data( 'price', variation.display_price );
							$(this).siblings( 'span.accessory-price' ).html( $(variation.price_html).html() );
						}
					});
				});

				$( 'body' ).on( 'woocommerce_variation_has_changed', function( event ) {
					var total_price = accessory_checked_total_price();
					$.ajax({
						type: "POST",
						async: false,
						url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
						data: { 'action': "unicase_accessories_total_price", 'price': total_price  },
						success : function( response ) {
							$( 'span.total-price-html .amount' ).html( response );
							$( 'span.total-products' ).html( accessory_checked_count() );
						}
					})
				});

				$( '.accessory-checkbox .product-check' ).on( "click", function() {
					var total_price = accessory_checked_total_price();
					$.ajax({
						type: "POST",
						async: false,
						url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
						data: { 'action': "unicase_accessories_total_price", 'price': total_price  },
						success : function( response ) {
							$( 'span.total-price-html .amount' ).html( response );
							$( 'span.total-products' ).html( accessory_checked_count() );

							var unchecked_product_ids = accessory_unchecked_product_ids();
							$( '.accessories ul.products > li' ).each(function() {
								$(this).show();
								for (var i = 0; i < unchecked_product_ids.length; i++ ) {
									if( $(this).hasClass( 'post-'+unchecked_product_ids[i] ) ) {
										$(this).hide();
									}
								}
							});
						}
					})
				});

				$('.accessories-add-all-to-cart .add-all-to-cart').click(function() {
					var accerories_all_product_ids = accessory_checked_product_ids();
					var accerories_variable_product_ids = accessory_checked_variable_product_ids();
					if( accerories_all_product_ids.length === 0 ) {
						var accerories_alert_msg = '<?php echo wp_kses_post( $alert_message['empty'] ); ?>';
					} else if( accerories_variable_product_ids.length > 0 && accessory_is_variation_selected() === false ) {
						var accerories_alert_msg = '<?php echo wp_kses_post( $alert_message['no_variation'] ); ?>';
					} else if( accerories_variable_product_ids.length > 0 && accessory_is_variation_available() === false ) {
						var accerories_alert_msg = '<?php echo wp_kses_post( $alert_message['not_available'] ); ?>';
					} else if( accerories_variable_product_ids.length === 0 && accessory_is_product_available() === false ) {
						var accerories_alert_msg = '<?php echo wp_kses_post( $alert_message['not_available'] ); ?>';
					} else {
						for (var i = 0; i < accerories_all_product_ids.length; i++ ) {
							if( ! $.inArray( accerories_all_product_ids[i], accerories_variable_product_ids ) ) {
								var variation_id  = $('.variations_form .variations_button').find('input[name^=variation_id]').val();
								var variation = {};
								if( $( '.variations_form' ).find('select[name^=attribute]').length ) {
									$( '.variations_form' ).find('select[name^=attribute]').each(function() {
										var attribute = $(this).attr("name");
										var attributevalue = $(this).val();
										variation[attribute] = attributevalue;
									});

								} else {

									$( '.variations_form' ).find('.select').each(function() {
										var attribute = $(this).attr("data-attribute-name");
										var attributevalue = $(this).find('.selected').attr('data-name');
										variation[attribute] = attributevalue;
									});

								}
								$.ajax({
									type: "POST",
									async: false,
									url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
									data: { 'action': "unicase_variable_add_to_cart", 'product_id': accerories_all_product_ids[i], 'variation_id': variation_id, 'variation': variation  },
									success : function( response ) {
										accessory_refresh_fragments( response );
									}
								})
							} else {
								$.ajax({
									type: "POST",
									async: false,
									url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
									data: { 'action': "woocommerce_add_to_cart", 'product_id': accerories_all_product_ids[i]  },
									success : function( response ) {
										accessory_refresh_fragments( response );
									}
								})
							}
						}
						var accerories_alert_msg = '<?php echo wp_kses_post( $alert_message['success'] ); ?>';
					}
					$( '.unicase-wc-message' ).html(accerories_alert_msg);
				});

			});
			<?php
			$custom_script = ob_get_clean();
			if( apply_filters( 'unicase_load_all_minifed_js', true ) ) {
				$script_handle = 'unicase-all';
			} else {
				$script_handle = 'unicase-js';
			}
			wp_add_inline_script( $script_handle, $custom_script );
		?>

	</div>

<?php endif;

wp_reset_postdata();
