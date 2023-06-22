<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<!--Start Cart-->
<section class="vs-product-wrapper product-details space-top bg-gradient-1">
    <div class="container-fluid">
        <div class="row gx-60">
            <div class="col-lg-6 backbgcart">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card1 px-0 pt-4 pb-0 mt-3 mb-3">
                                <h2 id="heading">Lorem ipsum dolor sit.</h2>
                                <form id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>1</strong></li>
                                        <li id="personal"><strong>2</strong></li>
                                        <li id="payment"><strong>3</strong></li>
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <br> <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Lorem ipsum dolor sit:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 1 - 3</h2>
                                                </div>
                                            </div>
                                            <label class="fieldlabels">Mobile Number:</label>
                                            <input type="number" name="number" placeholder="Enter Mobile Number" />
                                            <label class="fieldlabels">OTP:</label>
                                            <div class="otp-flex">
                                                <input type="text" name="uname" placeholder="" />
                                                <input type="text" name="uname" placeholder="" />
                                                <input type="text" name="uname" placeholder="" />
                                                <input type="text" name="uname" placeholder="" />
                                            </div>
                                        </div>
                                        <button type="button" class="next vs-btn style7" name="next"
                                            value="Next">Next</button>
                                        <!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Personal Information:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 2 - 3</h2>
                                                </div>
                                            </div>
                                            <label class="fieldlabels">Address: </label>
                                            <textarea></textarea>
                                            <label class="fieldlabels">Location: </label>
                                            <input type="text" name="lname" placeholder="" />
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.383112256553!2d72.50348831188215!3d23.009701416719665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b19de060de3%3A0x392e95e370777bb3!2sGlasier%20Inc!5e0!3m2!1sen!2sin!4v1683113858049!5m2!1sen!2sin"
                                                width="100%" height="200" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                        <button type="button" class="previous vs-btn style7 mt-5" name="previous"
                                            value="Previous">Previous</button>
                                        <button type="button" class="next vs-btn style7" name="next"
                                            value="Next">Next</button>
                                        <!-- <input type="button" name="next" class="next action-button" value="Next" />
                                 <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Image Upload:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 3 - 3</h2>
                                                </div>
                                            </div>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cards-2.png"
                                                class="mb-3 mt-3">

                                            <div class="redio-button">
                                                <input type="radio" class="inputwid" name="number"
                                                    placeholder="Enter Card Holder Name" />
                                                <span class="redio-button-span">Online Payment</span>
                                            </div>

                                            <div class="redio-button">
                                                <input type="radio" class="inputwid" name="number"
                                                    placeholder="Enter Card Holder Name" />
                                                <span class="redio-button-span">Cash on Delevriy</span>
                                            </div>
                                        </div>
                                        <button type="button" class="next vs-btn style7 mt-5" name="previous"
                                            value="previous">previous</button>
                                        <button type="button" class="next vs-btn style7 mb-5" name="next"
                                            value="Submit">Submit</button>

                                        <!-- <input type="button" name="next" class="next action-button" value="Submit" />
                                 <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> -->
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            
			<div class="col-lg-6 backbgcart1">
				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
				
					<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
						<thead>
							<tr>
								<th class="product-remove"><span
										class="screen-reader-text"><?php esc_html_e( 'Remove item', 'woocommerce' ); ?></span></th>
								<th class="product-thumbnail"><span
										class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'woocommerce' ); ?></span></th>
								<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
								<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
								<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
								<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				
							<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
									?>
							<tr
								class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				
								<td class="product-remove">
									<?php
												echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													'woocommerce_cart_item_remove_link',
													sprintf(
														'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
														esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
														esc_html__( 'Remove this item', 'woocommerce' ),
														esc_attr( $product_id ),
														esc_attr( $_product->get_sku() )
													),
													$cart_item_key
												);
											?>
								</td>
				
								<td class="product-thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				
										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										}
										?>
								</td>
				
								<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
									<?php
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
										}
				
										do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
				
										// Meta data.
										echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
				
										// Backorder notification.
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
										}
										?>
								</td>
				
								<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
									<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
								</td>
				
								<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
									<?php
										if ( $_product->is_sold_individually() ) {
											$min_quantity = 1;
											$max_quantity = 1;
										} else {
											$min_quantity = 0;
											$max_quantity = $_product->get_max_purchase_quantity();
										}
				
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $max_quantity,
												'min_value'    => $min_quantity,
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
				
										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
										?>
								</td>
				
								<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
									<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
								</td>
							</tr>
							<?php
								}
							}
							?>
				
							<?php do_action( 'woocommerce_cart_contents' ); ?>
				
							<tr>
								<td colspan="6" class="actions">
				
									<?php if ( wc_coupons_enabled() ) { ?>
									<div class="coupon">
										<label for="coupon_code"
											class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input
											type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
											placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit"
											class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
											name="apply_coupon"
											value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
										<?php do_action( 'woocommerce_cart_coupon' ); ?>
									</div>
									<?php } ?>
				
									<button type="submit"
										class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
										name="update_cart"
										value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
				
									<?php do_action( 'woocommerce_cart_actions' ); ?>
				
									<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
								</td>
							</tr>
				
							<?php do_action( 'woocommerce_after_cart_contents' ); ?>
						</tbody>
					</table>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</form>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mb-5">
                            <h3 class="widget_title1 mt-5">Latest post</h3>
                            <div class="recent-post">
                                <div class="media-img1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/subproduct/1.jpg"
                                        alt="Blog Image">
                                </div>
                                <div class="media-body">
                                    <div class="tit1">
                                        <h4 class="post-title">
                                            Creamy Facial Wash
                                        </h4>
                                        <a href="#">
                                            <p class="sideprice">₹ 14,400</p>
                                        </a>
                                    </div>
                                    <span class="sideml">40 ML</span>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/subproduct/1.jpg"
                                        alt="Blog Image">
                                </div>
                                <div class="media-body">
                                    <div class="tit1">
                                        <h4 class="post-title">
                                            Creamy Facial Wash
                                        </h4>
                                        <a href="#">
                                            <p class="sideprice">₹ 14,400</p>
                                        </a>
                                    </div>
                                    <span class="sideml">40 ML</span>
                                </div>
                            </div>
                            <h3 class="widget_title1 mt-5">Latest post</h3>
                            <div class="recent-post">
                                <div class="media-img1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/subproduct/1.jpg"
                                        alt="Blog Image">
                                </div>
                                <div class="media-body">
                                    <div class="tit1">
                                        <h4 class="post-title">
                                            Creamy Facial Wash
                                        </h4>
                                        <a href="#" class="vs-btn mobilecart"> ADDED TO CART </a>
                                    </div>
                                    <span class="sideml">40 ML</span>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/subproduct/1.jpg"
                                        alt="Blog Image">
                                </div>
                                <div class="media-body">
                                    <div class="tit1">
                                        <h4 class="post-title">
                                            Creamy Facial Wash
                                        </h4>
                                        <a href="#" class="vs-btn mobilecart"> ADDED TO CART </a>
                                    </div>
                                    <span class="sideml">40 ML</span>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img1">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/subproduct/1.jpg"
                                        alt="Blog Image">
                                </div>
                                <div class="media-body">
                                    <div class="tit1">
                                        <h4 class="post-title">
                                            Creamy Facial Wash
                                        </h4>
                                        <a href="#" class="vs-btn mobilecart"> ADDED TO CART </a>
                                    </div>
                                    <span class="sideml">40 ML</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Cart-->

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
    <?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>