<?php
/**
 * Template functions used for the site footer.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_is_handheld_footer' ) ) {
	/**
	 * Displays HandHeld Header
	 */
	function unicase_is_handheld_footer() {
		return apply_filters( 'unicase_is_handheld_footer', true );
	}
}

if( ! function_exists( 'unicase_footer_top_widgets' ) ) {
	/**
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_footer_top_widgets() {
		?>
		<div class="footer-top-widgets">
			<div class="row">
				<?php 
				if( is_active_sidebar( 'footer-top-widgets-1' ) ) {
					dynamic_sidebar( 'footer-top-widgets-1' );
				}
				?>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_footer_bottom_widgets' ) ) {
	/**
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_footer_bottom_widgets() {
		?>
		<div class="footer-bottom-widgets">
			<div class="row">
				<?php 
				if( is_active_sidebar( 'footer-bottom-widgets-1' ) ) {
					dynamic_sidebar( 'footer-bottom-widgets-1' );
				}
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_logo' ) ) {
	function unicase_footer_logo() {
		unicase_site_branding();
	}
}

if ( ! function_exists( 'unicase_footer_contact_info' ) ) {
	function unicase_footer_contact_info() {
		?>
		<div class="footer-contact-info">
			<p><?php echo apply_filters( 'unicase_footer_contact_info', esc_html__( 'Nam libero tempore, cum soluta nobis est ses  eligendi optio cumque cum soluta nobis est ses  eligendi optio cumque.', 'unicase' ) ); ?></p>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_social_links' ) ) {
	function unicase_footer_social_links() {
		?>
		<div class="footer-social-links">
			<?php
				$social_icons_args = apply_filters( 'unicase_footer_social_icons_args', array(
					array(
						'id'		=> 'facebook',
						'title'		=> esc_html__( 'Facebook', 'unicase' ),
						'icon'		=> 'fa fa-facebook',
						'link'		=> '#'
					),
					array(
						'id'		=> 'twitter',
						'title'		=> esc_html__( 'Twitter', 'unicase' ),
						'icon'		=> 'fa fa-twitter',
						'link'		=> '#'
					),
					array(
						'id'		=> 'vine',
						'title'		=> esc_html__( 'Vine', 'unicase' ),
						'icon'		=> 'fa fa-vine',
						'link'		=> '#'
					),
					array(
						'id'		=> 'google-plus',
						'title'		=> esc_html__( 'Google Plus', 'unicase' ),
						'icon'		=> 'fa fa-google-plus',
						'link'		=> '#'
					),
					array(
						'id'		=> 'pinterest',
						'title'		=> esc_html__( 'Pinterest', 'unicase' ),
						'icon'		=> 'fa fa-pinterest',
						'link'		=> '#'
					),
					array(
						'id'		=> 'rss',
						'title'		=> esc_html__( 'RSS', 'unicase' ),
						'icon'		=> 'fa fa-rss',
						'link'		=> get_bloginfo( 'rss2_url' ),
					),
				) );
			?>
			<ul class="list-unstyled list-social-icons">
			<?php  foreach( $social_icons_args as $social_icon ) : ?>
				<?php if( !empty( $social_icon['link'] ) ) : ?>
				<li><a class="<?php echo esc_attr( $social_icon['icon'] ); ?>" title="<?php echo esc_attr( $social_icon['title'] );?>" href="<?php echo esc_url( $social_icon['link'] ); ?>"></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
			</ul><!-- /.list-social-icons -->
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_credit' ) ) {
	function unicase_footer_credit() {
		?>
		<div class="footer-copyright-text">
			<?php echo apply_filters( 'unicase_footer_copyright_text', esc_html__( '&copy; All rights reserved 2015', 'unicase' ) ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_payment_logo' ) ) {
	function unicase_footer_payment_logo() {
		apply_filters( 'unicase_footer_payment_logo', '' );
	}
}

if ( ! function_exists( 'unicase_footer_contact' ) ) {
	function unicase_footer_contact() {
		?>
		<div class="footer-contact">
			<?php unicase_footer_logo(); ?>
			<?php unicase_footer_contact_info(); ?>
			<?php unicase_footer_social_links(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_top' ) ) {
	function unicase_footer_content_top() {
		?>
		<div class="footer-top-contents-wrap">
			<div class="footer-top-contents">
				<?php unicase_footer_contact(); ?>
				<?php unicase_footer_top_widgets(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_middle' ) ) {
	function unicase_footer_content_middle() {
		?>
		<div class="footer-middle-contents-wrap">
			<div class="footer-middle-contents">
				<?php unicase_footer_bottom_widgets(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_bottom' ) ) {
	function unicase_footer_content_bottom() {
		?>
		<div class="footer-bottom-contents-wrap">
			<div class="footer-bottom-contents">
				<?php unicase_footer_credit(); ?>
				<?php unicase_footer_payment_logo(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_handheld_footer_bar' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 2.4.0
	 */
	function unicase_handheld_footer_bar() {
		$links = array(
			'my-account' => array(
				'priority' => 10,
				'callback' => 'unicase_handheld_footer_bar_account_link',
			),
			'search'     => array(
				'priority' => 20,
				'callback' => 'unicase_handheld_footer_bar_search',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'unicase_handheld_footer_bar_cart_link',
			)
		);
		if ( ! is_woocommerce_activated() || ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'myaccount' ) === -1 ) {
			unset( $links['my-account'] );
		}
		if ( ! is_woocommerce_activated() || ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'cart' ) === -1 || unicase_shop_catalog_mode() == true ) {
			unset( $links['cart'] );
		}

		if ( is_woocommerce_activated() && is_woocommerce_extension_activated( 'YITH_WCWL' ) ) {
			$links['wishlist'] = array(
				'priority' => 40,
				'callback' => 'unicase_handheld_footer_bar_wishlist_link',
			);
		}

		if( is_woocommerce_activated() && is_woocommerce_extension_activated( 'YITH_Woocompare' ) ) {
			$links['compare'] = array(
				'priority' => 50,
				'callback' => 'unicase_handheld_footer_bar_compare_link',
			);
		}

		$links = apply_filters( 'unicase_handheld_footer_bar_links', $links );
		if( ! empty( $links ) && unicase_is_handheld_footer() ) {
			?>
			<div class="uc-handheld-footer-bar hidden-md hidden-lg">
				<ul class="columns-<?php echo count( $links ); ?>">
					<?php foreach ( $links as $key => $link ) : ?>
						<li class="<?php echo esc_attr( $key ); ?>">
							<?php
							if ( $link['callback'] ) {
								call_user_func( $link['callback'], $key, $link );
							}
							?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'unicase_handheld_footer_bar_search' ) ) {
	/**
	 * The search callback function for the handheld footer bar
	 *
	 * @since 2.4.0
	 */
	function unicase_handheld_footer_bar_search() {
		?>
		<a class="has-icon" href="#">
			<i class="fa fa-search"></i><span class="sr-only"><?php echo esc_html__( 'Search', 'unicase' );?></span>
		</a>
		<?php
		unicase_product_search();
	}
}

if ( ! function_exists( 'unicase_handheld_footer_bar_cart_link' ) ) {
	/**
	 * The cart callback function for the handheld footer bar
	 *
	 * @since 2.4.0
	 */
	function unicase_handheld_footer_bar_cart_link() {
		if ( is_woocommerce_activated() ) {
		?>
			<a class="footer-cart-contents has-icon" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'unicase' ); ?>">
				<i class="fa fa-shopping-cart"></i><span class="cart-items-count count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</a>
		<?php
		}
	}
}

if ( ! function_exists( 'unicase_handheld_footer_bar_account_link' ) ) {
	/**
	 * The account callback function for the handheld footer bar
	 *
	 * @since 2.4.0
	 */
	function unicase_handheld_footer_bar_account_link() {
		if ( is_woocommerce_activated() ) {
		?>
			<a class="has-icon" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
				<i class="fa fa-user"></i><span class="sr-only"><?php echo esc_html__( 'My Account', 'unicase' );?></span>
			</a>
		<?php
		}
	}
}

if ( ! function_exists( 'unicase_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  2.4.0
	 * @uses  is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function unicase_product_search() {
		if ( is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}