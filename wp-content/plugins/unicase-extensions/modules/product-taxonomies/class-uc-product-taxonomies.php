<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists( 'UC_Product_Taxonomies' ) ) {
	/**
	 * Handles taxonomies for Unicase Theme
	 *
	 * @class 		UC_Product_Taxonomies
	 * @version		1.0.2
	 * @package		Unicase
	 * @category	Class
	 */
	class UC_Product_Taxonomies {

		/**
		 * Constructor
		 */
		public function __construct() {

			// hook into the init action and call create_book_taxonomies when it fires
			add_action( 'init', array( $this, 'register_product_taxonomies' ), 0 );

			add_action( 'admin_enqueue_scripts', array( $this, 'load_wp_media_files' ), 0 );

			// Brand/term ordering
			add_action( "create_term", array( $this, 'create_term' ), 5, 3 );
			add_action( "delete_term", array( $this, 'delete_term' ), 5 );

			// Add form
			add_action( 'product_label_add_form_fields', array( $this, 'add_label_fields' ) );
			add_action( 'product_label_edit_form_fields', array( $this, 'edit_label_fields' ), 10, 2 );
			add_action( 'created_term', array( $this, 'save_label_fields' ), 10, 3 );
			add_action( 'edit_term', array( $this, 'save_label_fields' ), 10, 3 );

			// Add columns
			add_filter( 'manage_edit-product_label_columns', array( $this, 'product_label_columns' ) );
			add_filter( 'manage_product_label_custom_column', array( $this, 'product_label_column' ), 10, 3 );
		}


		/**
		 * Loads WP Media Files
		 *
		 * @access public
		 * @return void
		 */
		public function load_wp_media_files() {
			wp_enqueue_media();
		}

		/**
		 * Create brand and product label taxonomy for the post type "product"
		 *
		 * @access public
		 * @return void
		 */
		public function register_product_taxonomies() {

			// Add new taxonomy, Product Label, NOT hierarchical (like tags)

			$labels = array(
				'name'                       => _x( 'Labels', 'taxonomy general name', 'unicase-extensions' ),
				'singular_name'              => _x( 'Label', 'taxonomy singular name', 'unicase-extensions' ),
				'search_items'               => __( 'Search Labels', 'unicase-extensions' ),
				'popular_items'              => __( 'Popular Labels', 'unicase-extensions' ),
				'all_items'                  => __( 'All Labels', 'unicase-extensions' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Label', 'unicase-extensions' ),
				'update_item'                => __( 'Update Label', 'unicase-extensions' ),
				'add_new_item'               => __( 'Add New Label', 'unicase-extensions' ),
				'new_item_name'              => __( 'New Label Name', 'unicase-extensions' ),
				'separate_items_with_commas' => __( 'Separate labels with commas', 'unicase-extensions' ),
				'add_or_remove_items'        => __( 'Add or remove labels', 'unicase-extensions' ),
				'choose_from_most_used'      => __( 'Choose from the most used labels', 'unicase-extensions' ),
				'not_found'                  => __( 'No labels found.', 'unicase-extensions' ),
				'menu_name'                  => __( 'Labels', 'unicase-extensions' ),
			);

			$args = array(
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'label' ),
			);

			register_taxonomy( 'product_label', 'product', $args );
		}

		/**
		 * Order term when created (put in position 0).
		 *
		 * @access public
		 * @param mixed $term_id
		 * @param mixed $tt_id
		 * @param mixed $taxonomy
		 * @return void
		 */
		public function create_term( $term_id, $tt_id = '', $taxonomy = '' ) {
			if ( $taxonomy != 'product_label' && ! taxonomy_is_product_attribute( $taxonomy ) )
				return;

			$meta_name = taxonomy_is_product_attribute( $taxonomy ) ? 'order_' . esc_attr( $taxonomy ) : 'order';

			update_woocommerce_term_meta( $term_id, $meta_name, 0 );
		}

		/**
		 * When a term is deleted, delete its meta.
		 *
		 * @access public
		 * @param mixed $term_id
		 * @return void
		 */
		public function delete_term( $term_id ) {

			$term_id = (int) $term_id;

			if ( ! $term_id )
				return;

			global $wpdb;
			$wpdb->query( "DELETE FROM {$wpdb->woocommerce_termmeta} WHERE `woocommerce_term_id` = " . $term_id );
		}

		/**
		 * Label Background and Text Color.
		 *
		 * @access public
		 * @return void
		 */
		public function add_label_fields() {
			?>
			<div class="form-field">
				<label class="label_background_color"><?php _e( 'Background Color', 'unicase-extensions' ); ?></label>
				<input name="label_background_color" id="label_background_color" type="text" value autocomplete="off">
				<p class="description"><?php echo __( 'Background color as a hex value. For example : #000000 is black and #FFFFFF is white', 'unicase-extensions' ); ?></p>
			</div>
			<div class="form-field">
				<label class="label_text_color"><?php _e( 'Text Color', 'unicase-extensions' ); ?></label>
				<input name="label_text_color" id="label_text_color" type="text" value autocomplete="off">
				<p class="description"><?php echo __( 'Text color as a hex value. For example : #000000 is black and #FFFFFF is white', 'unicase-extensions' ); ?></p>
			</div>
			<?php
		}

		/**
		 * Edit label fields
		 *
		 * @access public
		 * @param mixed $term Term (brand) being edited
		 * @param mixed $taxonomy Taxonomy of the term being edited
		 */
		public function edit_label_fields( $term, $taxonomy ) {

			$background_color 	= get_woocommerce_term_meta( $term->term_id, 'background_color', true );
			$text_color 		= get_woocommerce_term_meta( $term->term_id, 'text_color', true );
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php _e( 'Background Color', 'unicase-extensions' ); ?></label></th>
				<td>
					<input name="label_background_color" id="label_background_color" type="text" value="<?php echo $background_color;?>" autocomplete="off">
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php _e( 'Text Color', 'unicase-extensions' ); ?></label></th>
				<td>
					<input name="label_text_color" id="label_text_color" type="text" value="<?php echo $text_color;?>" autocomplete="off">
				</td>
			</tr>
			<?php
		}

		/**
		 * save_label_fields function.
		 *
		 * @access public
		 * @param mixed $term_id Term ID being saved
		 * @param mixed $tt_id
		 * @param mixed $taxonomy Taxonomy of the term being saved
		 * @return void
		 */
		public function save_label_fields( $term_id, $tt_id, $taxonomy ) {

			if ( isset( $_POST['label_background_color'] ) )
				update_woocommerce_term_meta( $term_id, 'background_color', $_POST['label_background_color'] );

			if ( isset( $_POST['label_text_color'] ) )
				update_woocommerce_term_meta( $term_id, 'text_color', $_POST['label_text_color'] );

			delete_transient( 'wc_term_counts' );
		}

		/**
		 * Background and Text Color column added to product label admin.
		 *
		 * @access public
		 * @param mixed $columns
		 * @return array
		 */
		public function product_label_columns( $columns ) {
			$new_columns          = array();
			$new_columns['background_color'] = __( 'BG Color', 'unicase-extensions' );
			$new_columns['text_color'] = __( 'Text Color', 'unicase-extensions' );

			unset( $columns['description'] );
			unset( $columns['cb'] );
			unset( $columns['posts'] );

			return array_merge( $columns, $new_columns);
		}

		/**
		 * Backgroudn and Text Color column value added to product label admin.
		 *
		 * @access public
		 * @param mixed $columns
		 * @param mixed $column
		 * @param mixed $id
		 * @return array
		 */
		public function product_label_column( $columns, $column, $id ) {

			if ( $column == 'background_color' ) {

				$background_color 	= get_woocommerce_term_meta( $id, 'background_color', true );

				$columns .= $background_color;

			}elseif ( $column == 'text_color' ) {

				$text_color 	= get_woocommerce_term_meta( $id, 'text_color', true );

				$columns .= $text_color;

			}

			return $columns;
		}

	}
}

new UC_Product_Taxonomies();