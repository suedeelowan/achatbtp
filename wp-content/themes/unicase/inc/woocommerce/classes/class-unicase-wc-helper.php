<?php
/**
 * Unicase Helper Class for WooCommerce
 */

class Unicase_WC_Helper {

	public static function init() {

		add_action( 'wp_ajax_woocommerce_json_search_simple_products', 	array( __CLASS__, 'json_search_simple_products' ) );

		// Accessories Ajax Add to Cart for Variable Products
		add_action( 'wp_ajax_nopriv_unicase_variable_add_to_cart',		array( __CLASS__, 'add_to_cart' ) );
		add_action( 'wp_ajax_unicase_variable_add_to_cart',				array( __CLASS__, 'add_to_cart' ) );

		// Accessories Ajax Total Price Update
		add_action( 'wp_ajax_nopriv_unicase_accessories_total_price',	array( __CLASS__, 'accessory_checked_total_price' ) );
		add_action( 'wp_ajax_unicase_accessories_total_price',			array( __CLASS__, 'accessory_checked_total_price' ) );

		// Add Accessories Tab
		add_action( 'woocommerce_product_write_panel_tabs',				array( __CLASS__, 'add_product_accessories_panel_tab' ) );
		add_action( 'woocommerce_product_data_panels',					array( __CLASS__, 'add_product_accessories_panel_data' ) );

		// Save Accessories Tab
		add_action( 'woocommerce_process_product_meta_simple',			array( __CLASS__, 'save_product_accessories_panel_data' ) );
		add_action( 'woocommerce_process_product_meta_variable',		array( __CLASS__, 'save_product_accessories_panel_data' ) );
		add_action( 'woocommerce_process_product_meta_grouped',			array( __CLASS__, 'save_product_accessories_panel_data' ) );
		add_action( 'woocommerce_process_product_meta_external',		array( __CLASS__, 'save_product_accessories_panel_data' ) );

		add_filter( 'woocommerce_product_tabs',							array( __CLASS__, 'modify_product_tabs' ) );

	}

	/**
	 * Search for products and echo json.
	 *
	 * @param string $term (default: '')
	 * @param string $post_types (default: array('product'))
	 */
	public static function json_search_simple_products( $term = '', $include_variations = false ) {
		check_ajax_referer( 'search-products', 'security' );

		$term = wc_clean( empty( $term ) ? stripslashes( $_GET['term'] ) : $term );

		if ( empty( $term ) ) {
			wp_die();
		}

		$data_store = WC_Data_Store::load( 'product' );
		$ids        = $data_store->search_products( $term, '', (bool) $include_variations );

		if ( ! empty( $_GET['exclude'] ) ) {
			$ids = array_diff( $ids, (array) $_GET['exclude'] );
		}

		if ( ! empty( $_GET['include'] ) ) {
			$ids = array_intersect( $ids, (array) $_GET['include'] );
		}

		if ( ! empty( $_GET['limit'] ) ) {
			$ids = array_slice( $ids, 0, absint( $_GET['limit'] ) );
		}

		$product_objects = array_filter( array_map( 'wc_get_product', $ids ), 'wc_products_array_filter_editable' );
		$products        = array();

		foreach ( $product_objects as $product_object ) {
			if ( ! $product_object->is_type( 'simple' ) ) {
				continue;
			}
			$products[ $product_object->get_id() ] = rawurldecode( $product_object->get_formatted_name() );
		}

		wp_send_json( apply_filters( 'woocommerce_json_search_found_products', $products ) );
	}

	public static function add_product_accessories_panel_tab() {
		?>
		<li class="accessories_options accessories_tab show_if_simple show_if_variable">
			<a href="#accessories_product_data"><span><?php echo esc_html__( 'Accessories', 'unicase' ); ?></span></a>
		</li>
		<?php
	}

	public static function add_product_accessories_panel_data() {
		global $post;
		?>
		<div id="accessories_product_data" class="panel woocommerce_options_panel">
			<div class="options_group">
				<p class="form-field">
					<label for="accessory_ids"><?php _e( 'Accessories', 'unicase' ); ?></label>
					<select class="wc-product-search" multiple="multiple" style="width: 50%;" id="accessory_ids" name="accessory_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'unicase' ); ?>" data-action="woocommerce_json_search_simple_products" data-exclude="<?php echo intval( $post->ID ); ?>">
						<?php
							$product_ids = array_filter( array_map( 'absint', (array) get_post_meta( $post->ID, '_accessory_ids', true ) ) );

							foreach ( $product_ids as $product_id ) {
								$product = wc_get_product( $product_id );
								if ( is_object( $product ) ) {
									echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
								}
							}
						?>
					</select> <?php echo wc_help_tip( esc_html__( 'Accessories are products which you recommend to be bought along with this product.', 'unicase' ) ); ?>
				</p>
			</div>
		</div>
		<?php
	}

	public static function save_product_accessories_panel_data( $post_id ) {
		$accessories = isset( $_POST['accessory_ids'] ) ? array_map( 'intval', (array) $_POST['accessory_ids'] ) : array();
		update_post_meta( $post_id, '_accessory_ids', $accessories );
	}

	public static function get_accessories( $product ) {
		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
			$product_id = isset( $product->id ) ? $product->id : 0;
		} else {
			$product_id = $product->get_id();
		}
		$accessory_ids = get_post_meta( $product_id, '_accessory_ids', true );
		return apply_filters( 'unicase_product_accessory_ids', (array) maybe_unserialize( $accessory_ids ), $product );
	}

	/**
	 * AJAX add to cart.
	 */
	public static function add_to_cart() {
		$product_id        = apply_filters( 'unicase_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
		$variation_id      = empty( $_POST['variation_id'] ) ? 0 : $_POST['variation_id'];
		$variation         = empty( $_POST['variation'] ) ? 0 : $_POST['variation'];
		$passed_validation = apply_filters( 'unicase_add_to_cart_validation', true, $product_id, $quantity );
		$product_status    = get_post_status( $product_id );

		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) && 'publish' === $product_status ) {

			do_action( 'woocommerce_ajax_added_to_cart', $product_id );

			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				wc_add_to_cart_message( $product_id );
			}

			// Return fragments
			WC_AJAX::get_refreshed_fragments();

		} else {

			// If there was an error adding to the cart, redirect to the product page to show any errors
			$data = array(
				'error'       => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
			);

			wp_send_json( $data );

		}

		die();
	}

	/**
	 * AJAX total price display.
	 */
	public static function accessory_checked_total_price() {
		global $woocommerce;
		$price = empty( $_POST['price'] ) ? 0 : $_POST['price'];

		if( $price ) {
			$price_html = wc_price( $price );
			echo wp_kses_post( $price_html );
		}

		die();
	}

	public static function modify_product_tabs( $tabs ) {

		global $product, $post;

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
			$product_id = isset( $product->id ) ? $product->id : 0;
		} else {
			$product_id = $product->get_id();
		}

		$accessories = Unicase_WC_Helper::get_accessories( $product );

		if ( sizeof( $accessories ) !== 0 && array_filter( $accessories ) && $product->is_type( array( 'simple', 'variable' ) ) ) {
			$tabs['accessories'] = array(
				'title'		=> esc_html__( 'Accessories', 'unicase' ),
				'priority'	=> 5,
				'callback'	=> 'unicase_product_accessories_tab',
			);
		}

		return $tabs;
	}
}

Unicase_WC_Helper::init();
