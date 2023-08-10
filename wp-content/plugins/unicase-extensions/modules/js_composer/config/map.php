<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package Unicase/VCExtensions
 *
 */

if ( function_exists( 'vc_map' ) ) :

	#-----------------------------------------------------------------
	# Unicase Terms
	#-----------------------------------------------------------------
	vc_map(	
		array(
			'name'        => esc_html__( 'Unicase Terms', 'unicase-extensions' ),
			'base'        => 'unicase_terms',
			'description' => esc_html__( 'Adds a shortcode for get_terms. Used to get terms including categories, product categories, etc.', 'unicase-extensions' ),
			'class'		  => '',
			'controls'    => 'full',
			'icon'        => '',
			'category'    => esc_html__( 'Unicase Elements', 'unicase-extensions' ),
			'params'      => array(
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Taxonomy', 'unicase-extensions' ),
					'param_name'   => 'taxonomy',
					'description'  => esc_html( 'Taxonomy name, or comma-separated taxonomies, to which results should be limited.', 'unicase-extensions' ),
					'value'        => 'category',
					'holder'       => 'div'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Order By', 'unicase-extensions' ),
					'param_name'   => 'orderby',
					'description'  => esc_html( 'Field(s) to order terms by. Accepts term fields (\'name\', \'slug\', \'term_group\', \'term_id\', \'id\', \'description\'). Defaults to \'name\'.', 'unicase-extensions' ),
					'value'        => 'name'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Order', 'unicase-extensions' ),
					'param_name'   => 'order',
					'description'  => esc_html( 'Whether to order terms in ascending or descending order. Accepts \'ASC\' (ascending) or \'DESC\' (descending). Default \'ASC\'.', 'unicase-extensions' ),
					'value'        => 'ASC'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Hide Empty ?', 'unicase-extensions' ),
					'param_name'   => 'hide_empty',
					'description'  => esc_html( 'Whether to hide terms not assigned to any posts. Accepts 1 or 0. Default 0.', 'unicase-extensions' ),
					'value'        => '0'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Include IDs', 'unicase-extensions' ),
					'param_name'   => 'include',
					'description'  => esc_html( 'Comma-separated string of term ids to include.', 'unicase-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Exclude IDs', 'unicase-extensions' ),
					'param_name'   => 'exclude',
					'description'  => esc_html( 'Comma-separated string of term ids to exclude. If Include is non-empty, Exclude is ignored.', 'unicase-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Number', 'unicase-extensions' ),
					'param_name'   => 'number',
					'description'  => esc_html( 'Maximum number of terms to return. Accepts 0 (all) or any positive number. Default 0 (all).', 'unicase-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Offset', 'unicase-extensions' ),
					'param_name'   => 'offset',
					'description'  => esc_html( 'The number by which to offset the terms query.', 'unicase-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Name', 'unicase-extensions' ),
					'param_name'   => 'name',
					'description'  => esc_html( 'Name or comma-separated string of names to return term(s) for.', 'unicase-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Slug', 'unicase-extensions' ),
					'param_name'   => 'slug',
					'description'  => esc_html( 'Slug or comma-separated string of slugs to return term(s) for.', 'unicase-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Hierarchical', 'unicase-extensions' ),
					'param_name'   => 'hierarchical',
					'description'  => esc_html( 'Whether to include terms that have non-empty descendants. Accepts 1 (true) or 0 (false). Default 1 (true)', 'unicase-extensions' ),
					'value'        => '1',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Child Of', 'unicase-extensions' ),
					'param_name'   => 'child_of',
					'description'  => esc_html( 'Term ID to retrieve child terms of. If multiple taxonomies are passed, child_of is ignored. Default 0.', 'unicase-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html( 'Parent', 'unicase-extensions' ),
					'param_name'   => 'parent',
					'description'  => esc_html( 'Parent term ID to retrieve direct-child terms of.', 'unicase-extensions' ),
					'value'        => '',
				)	
			)
		)
	);

	#-----------------------------------------------------------------
	# Unicase Banner Element
	#-----------------------------------------------------------------
	vc_map(	
		array(
			'name' 			=> esc_html__( 'Banner', 'unicase-extensions' ),
			'base' 			=> 'unicase_banner',
			'description' 	=> esc_html__( 'Add a banner to your page.', 'unicase-extensions' ),
			'class'			=> '',
			'controls' 		=> 'full', 
			'icon' 			=> '',
			'category' 		=> esc_html__( 'Unicase Elements', 'unicase-extensions' ),
		   	'params' 		=> array(
		      	array(
					 'type' 		=> 'textarea_html',
			         'heading' 		=> esc_html__( 'Caption', 'unicase-extensions' ),
			         'param_name' 	=> 'content',
			         'description' 	=> esc_html__( 'Enter banner caption', 'unicase-extensions' ),
			         'holder'		=> 'div',
		      	),

		      	array(
      				'type'			=> 'textfield',
      				'heading'		=> esc_html__( 'Height', 'unicase-extensions' ),
      				'param_name'	=> 'height',
      				'description'	=> esc_html__( 'Height of banner in pixels', 'unicase-extensions' )
  				),

				array(
		      		'type' 			=> 'dropdown',
		      		'heading' 		=> esc_html__( 'Banner Text Position', 'unicase-extensions' ),
		      		'param_name' 	=> 'banner_text_position',
		      		'value' 		=> array(
						esc_html__( 'Select', 'unicase-extensions' ) => '',
						esc_html__( 'Left', 'unicase-extensions' )	=> 'text-left',
						esc_html__( 'Right', 'unicase-extensions' )   => 'text-right',
						esc_html__( 'Center', 'unicase-extensions' )  => 'text-center',
					),
	      		),

	      		array(
	      			'type'			=> 'checkbox',
	      			'heading'		=> esc_html__( 'Wrap inside a container', 'unicase-extensions' ),
	      			'param_name'	=> 'wrap_container',
	      			'value'			=> array( 
	      				esc_html__( 'Yes', 'unicase-extensions' ) 	=> '1'
      				),
      			),

      			array(
					'type' 			=> 'attach_image',
		         	'heading' 		=> esc_html__( 'Banner Image', 'unicase-extensions' ),
		         	'param_name' 	=> 'banner_image',
		      	),

		      	array(
		      		'type'			=> 'textfield',
		      		'heading'		=> esc_html__( 'Background Position', 'unicase-extensions' ),
		      		'param_name'	=> 'banner_image_bg_pos',
		      		'description'	=> esc_html__( 'Background Position of banner image. Applicable only if banner image is added', 'unicase-extensions' ),
	      		),

  				array(
      				'type'			=> 'colorpicker',
      				'heading'		=> esc_html__( 'Background Color', 'unicase-extensions' ),
      				'param_name'	=> 'background_color',
      				'description'	=> esc_html__( 'Background color of banner', 'unicase-extensions' )
  				),

  				array(
      				'type'			=> 'textfield',
      				'heading'		=> esc_html__( 'Background Size', 'unicase-extensions' ),
      				'param_name'	=> 'background_size',
      				'description'	=> esc_html__( 'Background size attribute of banner image', 'unicase-extensions' )
  				),

  				array(
      				'type'			=> 'textfield',
      				'heading'		=> esc_html__( 'Background Repeat', 'unicase-extensions' ),
      				'param_name'	=> 'background_repeat',
      				'description'	=> esc_html__( 'Background repeat of banner image', 'unicase-extensions' )
  				),

  				array(
      				'type'			=> 'colorpicker',
      				'heading'		=> esc_html__( 'Color', 'unicase-extensions' ),
      				'param_name'	=> 'color',
      				'description'	=> esc_html__( 'Text color of Banner', 'unicase-extensions' )
  				),

  				array(
					 'type' 		=> 'textfield',
			         'heading' 		=> esc_html__( 'Banner Link', 'unicase-extensions' ),
			         'param_name' 	=> 'banner_link',
			         'description' 	=> esc_html__( 'Link to banner.', 'unicase-extensions' ),
			         'value' 		=> ''
		      	),
		      	
		      	array(
		      		'type' 			=> 'dropdown',
		      		'heading' 		=> esc_html__( 'On Click', 'unicase-extensions' ),
		      		'param_name' 	=> 'banner_link_target',
		      		'value' 		=> array(
						esc_html__( 'Select', 'unicase-extensions' ) => '',
						esc_html__( 'Open in same page', 'unicase-extensions' ) 	=> '_self',
						esc_html__( 'Open in new page', 'unicase-extensions' )   => '_blank'
					),
	      		),

				array(
					'type' 			=> 'textfield',
		         	'class' 		=> '',
		         	'heading' 		=> esc_html__( 'Caption Extra Class', 'unicase-extensions' ),
		         	'param_name' 	=> 'banner_text_el_class',
		         	'description' 	=> esc_html__( 'Add your extra classes here for the caption.', 'unicase-extensions' )
		      	),

		      	array(
					'type' 			=> 'textfield',
		         	'class' 		=> '',
		         	'heading' 		=> esc_html__( 'Extra Class', 'unicase-extensions' ),
		         	'param_name' 	=> 'el_class',
		         	'description' 	=> esc_html__( 'Add your extra classes here.', 'unicase-extensions' )
		      	),
		   	)
		) 
	);

	#-----------------------------------------------------------------
	# Unicase Blog Carousel Element
	#-----------------------------------------------------------------
	vc_map(	
		array(
			'name' => esc_html__( 'Blog Carousel', 'unicase-extensions' ),
			'base' => 'unicase_blog_carousel',
			'description' => esc_html__( 'Add a blog carousel to your page.', 'unicase-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => '',
			'category' => esc_html__( 'Unicase Elements', 'unicase-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
			        'heading' => esc_html__( 'Enter Carousel title', 'unicase-extensions' ),
			        'param_name' => 'title',
			        'holder' => 'div'
		      	),

				array(
					'type' => 'textfield',
			        'heading' => esc_html__( 'Number of Blog to display', 'unicase-extensions' ),
			        'param_name' => 'limit',
			        'holder' => 'div'
		      	),

		      	array(
					'type' => 'textfield',
			        'heading' => esc_html__( 'Order by', 'unicase-extensions' ),
			        'param_name' => 'orderby',
			        'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'unicase-extensions' ),
			        'value' => 'date',
		      	),

		      	array(
			 	   	'type' => 'textfield',
			        'heading' => esc_html__( 'Order', 'unicase-extensions' ),
			        'param_name' => 'order',
			        'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'unicase-extensions' ),
			        'value' => 'DESC',
		      	),

		      	array(
					'type' => 'textfield',
			        'heading' => __( 'ID (optional)', 'unicase-extensions' ),
			        'param_name' => 'id',
			        'holder' => 'div'
		      	),
		      	
		      	array(
					'type' => 'textfield',
			        'heading' => __( 'Category ID (optional)', 'unicase-extensions' ),
			        'param_name' => 'category',
			        'holder' => 'div'
		      	),

		      	array(
					'type' => 'checkbox',
					'param_name' => 'disable_touch_drag',
					'heading' => esc_html__( 'Disable Touch Drag', 'unicase-extensions' ),
					'description' => esc_html__( 'Enable/Disable Touch Drag.', 'unicase-extensions' ),
					'value' => array( esc_html__( 'Disable', 'unicase-extensions' ) => '1' )
				),
			)
		)
	);

	if( class_exists( 'WooCommerce' ) ) :
		
		#-----------------------------------------------------------------
		# Get All Product Categories
		#-----------------------------------------------------------------
		function get_all_product_categories() {
			$args = array(
				'orderby'    => 'date',
				'order'      => 'ASC',
				'hide_empty' => true,
				'include'    => '',
				'pad_counts' => true,
			);

			$terms = get_terms( 'product_cat', $args );

			$product_categories = array(
				esc_html__( 'Choose Category', 'unicase-extensions' ) => '',
				esc_html__( 'All Categories', 'unicase-extensions' ) => 'unicase-all-categories'
			);
			
			if( !empty( $terms ) ) :
				foreach( $terms as $term ) :
					$product_categories[$term->name] = $term->slug;
				endforeach;
			endif;

			return $product_categories;
		}

		#-----------------------------------------------------------------
		# Unicase Brands Carousel Element
		#-----------------------------------------------------------------
		vc_map(	
			array(
				'name' => esc_html__( 'Brands Carousel', 'unicase-extensions' ),
				'base' => 'unicase_brands_carousel',
				'description' => esc_html__( 'Add a brands carousel to your page.', 'unicase-extensions' ),
				'class'		=> '',
				'controls' => 'full',
				'icon' => '',
				'category' => esc_html__( 'Unicase Elements', 'unicase-extensions' ),
				'params' => array(
					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Carousel title', 'unicase-extensions' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),

					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Number of Brands to display', 'unicase-extensions' ),
				        'param_name' => 'limit',
				        'holder' => 'div'
			      	),

			      	array(
						'type' => 'checkbox',
						'param_name' => 'has_no_products',
						'heading' => esc_html__( 'Show only has products', 'unicase-extensions' ),
						'description' => esc_html__( 'Show only if products are available.', 'unicase-extensions' ),
						'value' => array( esc_html__( 'Allow', 'unicase-extensions' ) => 'false' )
					),

			      	array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Order by', 'unicase-extensions' ),
				        'param_name' => 'orderby',
				        'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'unicase-extensions' ),
				        'value' => 'date',
			      	),

			      	array(
				 	   	'type' => 'textfield',
				        'heading' => esc_html__( 'Order', 'unicase-extensions' ),
				        'param_name' => 'order',
				        'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'unicase-extensions' ),
				        'value' => 'DESC',
			      	),

			      	array(
						'type' => 'checkbox',
						'param_name' => 'disable_touch_drag',
						'heading' => esc_html__( 'Disable Touch Drag', 'unicase-extensions' ),
						'description' => esc_html__( 'Enable/Disable Touch Drag.', 'unicase-extensions' ),
						'value' => array( esc_html__( 'Disable', 'unicase-extensions' ) => '1' )
					),

			      	array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter the brand ids followed by comma(,) to display brands.', 'unicase-extensions' ),
				        'param_name' => 'include_ids',
				        'holder' => 'div'
			      	),
				)
			)
		);
	
		#-----------------------------------------------------------------
		# Unicase Product Tabs Element
		#-----------------------------------------------------------------
		vc_map(
			array(
				'name'			=> esc_html__( 'Product Tabs', 'unicase-extensions' ),
				'base'  		=> 'unicase_product_tabs',
				'description'	=> esc_html__( 'Add Product Tabs to your page.', 'unicase-extensions' ),
				'category'		=> esc_html__( 'Unicase Elements', 'unicase-extensions' ),
				'icon' 			=> '',
				'params' 		=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #1 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_1',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #1 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_1',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' )				=> '',
							esc_html__( 'Featured Products', 'unicase-extensions' )		=> 'featured_products' ,
							esc_html__( 'On Sale Products', 'unicase-extensions' )		=> 'sale_products' 	,
							esc_html__( 'Top Rated Products', 'unicase-extensions' )	=> 'top_rated_products' ,
							esc_html__( 'Recent Products', 'unicase-extensions' )		=> 'recent_products' 	,
							esc_html__( 'Best Selling Products', 'unicase-extensions' )	=> 'best_selling_products',
						),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #2 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_2',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #2 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_2',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' ) 				=> '',
							esc_html__( 'Featured Products', 'unicase-extensions' )		=> 'featured_products' ,
							esc_html__( 'On Sale Products', 'unicase-extensions' )		=> 'sale_products' 	,
							esc_html__( 'Top Rated Products', 'unicase-extensions' )	=> 'top_rated_products' ,
							esc_html__( 'Recent Products', 'unicase-extensions' )		=> 'recent_products' 	,
							esc_html__( 'Best Selling Products', 'unicase-extensions' )	=> 'best_selling_products',
						),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #3 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_3',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #3 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_3',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' ) 				=> '',
							esc_html__( 'Featured Products', 'unicase-extensions' )		=> 'featured_products' ,
							esc_html__( 'On Sale Products', 'unicase-extensions' )		=> 'sale_products' 	,
							esc_html__( 'Top Rated Products', 'unicase-extensions' )	=> 'top_rated_products' ,
							esc_html__( 'Recent Products', 'unicase-extensions' )		=> 'recent_products' 	,
							esc_html__( 'Best Selling Products', 'unicase-extensions' )	=> 'best_selling_products',
						),
					),

					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Product Items', 'unicase-extensions' ),
				        'param_name' => 'product_items',
				        'holder' => 'div'
			      	),

			      	array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Product Columns', 'unicase-extensions' ),
				        'param_name' => 'product_columns',
				        'holder' => 'div'
			      	),
				),
			)
		);

		#-----------------------------------------------------------------
		# Unicase Product Tabs Carousel Element
		#-----------------------------------------------------------------
		vc_map(
			array(
				'name'			=> esc_html__( 'Product Tabs Carousel', 'unicase-extensions' ),
				'base'  		=> 'unicase_product_tabs_carousel',
				'description'	=> esc_html__( 'Add Product Tabs Carousel to your page.', 'unicase-extensions' ),
				'category'		=> esc_html__( 'Unicase Elements', 'unicase-extensions' ),
				'icon' 			=> '',
				'params' 		=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'unicase-extensions' ),
						'param_name'	=> 'title',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'product_content',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' )				=> '',
							esc_html__( 'Featured Products', 'unicase-extensions' )		=> 'featured_products' ,
							esc_html__( 'On Sale Products', 'unicase-extensions' )		=> 'sale_products' 	,
							esc_html__( 'Top Rated Products', 'unicase-extensions' )	=> 'top_rated_products' ,
							esc_html__( 'Recent Products', 'unicase-extensions' )		=> 'recent_products' 	,
							esc_html__( 'Best Selling Products', 'unicase-extensions' )	=> 'best_selling_products',
						),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #1 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_1',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #1 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_1',
						'value'			=> get_all_product_categories(),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #2 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_2',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #2 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_2',
						'value'			=> get_all_product_categories(),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #3 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_3',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #3 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_3',
						'value'			=> get_all_product_categories(),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Tab #4 title', 'unicase-extensions' ),
						'param_name'	=> 'tab_title_4',
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Tab #4 Content, Show :', 'unicase-extensions' ),
						'param_name'	=> 'tab_content_4',
						'value'			=> get_all_product_categories(),
					),

					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Carousel Items', 'unicase-extensions' ),
				        'param_name' => 'carousel_items',
				        'holder' => 'div'
			      	),

			      	array(
						'type' => 'checkbox',
						'param_name' => 'disable_touch_drag',
						'heading' => esc_html__( 'Disable Touch Drag', 'unicase-extensions' ),
						'description' => esc_html__( 'Enable/Disable Touch Drag.', 'unicase-extensions' ),
						'value' => array( esc_html__( 'Disable', 'unicase-extensions' ) => '1' )
					),
				),
			)
		);

		#-----------------------------------------------------------------
		# Unicase Product Carousel Element
		#-----------------------------------------------------------------
		vc_map(
			array(
				'name'			=> esc_html__( 'Products Carousel', 'unicase-extensions' ),
				'base'  		=> 'unicase_products_carousel',
				'description'	=> esc_html__( 'Add Products Carousel to your page.', 'unicase-extensions' ),
				'category'		=> esc_html__( 'Unicase Elements', 'unicase-extensions' ),
				'icon' 			=> '',
				'params' 		=> array(
					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Carousel title', 'unicase-extensions' ),
				        'param_name' => 'title',
				        'holder' => 'div'
			      	),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Type', 'unicase-extensions' ),
						'param_name'	=> 'type',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' ) 		=> '',
							esc_html__( 'Type 1', 'unicase-extensions' )		=> 'type-1' ,
							esc_html__( 'Type 2', 'unicase-extensions' )		=> 'type-2' ,
						),
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Product Content', 'unicase-extensions' ),
						'param_name'	=> 'product_content',
						'value'			=> array(
							esc_html__( 'Select', 'unicase-extensions' ) 				=> '',
							esc_html__( 'Featured Products', 'unicase-extensions' )		=> 'featured_products' ,
							esc_html__( 'On Sale Products', 'unicase-extensions' )		=> 'sale_products' 	,
							esc_html__( 'Top Rated Products', 'unicase-extensions' )	=> 'top_rated_products' ,
							esc_html__( 'Recent Products', 'unicase-extensions' )		=> 'recent_products' 	,
							esc_html__( 'Best Selling Products', 'unicase-extensions' )	=> 'best_selling_products',
							esc_html__( 'Products by IDs', 'unicase-extensions' )		=> 'products',
						),
					),

					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Product IDs', 'unicase-extensions' ),
				        'description' => esc_html__( 'This is works only for Products by IDs shortcode.', 'unicase-extensions' ),
				        'param_name' => 'product_ids',
				        'holder' => 'div'
			      	),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__( 'Category', 'unicase-extensions' ),
						'param_name'	=> 'category_slug',
						'value'			=> get_all_product_categories(),
					),

					array(
						'type' => 'textfield',
				        'heading' => esc_html__( 'Enter Carousel Items', 'unicase-extensions' ),
				        'param_name' => 'carousel_items',
				        'holder' => 'div'
			      	),

			      	array(
						'type' => 'checkbox',
						'param_name' => 'disable_touch_drag',
						'heading' => esc_html__( 'Disable Touch Drag', 'unicase-extensions' ),
						'description' => esc_html__( 'Enable/Disable Touch Drag.', 'unicase-extensions' ),
						'value' => array( esc_html__( 'Disable', 'unicase-extensions' ) => '1' )
					),
				),
			)
		);

	endif;

endif;