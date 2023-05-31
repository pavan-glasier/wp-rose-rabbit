<?php 
//Add a filter to get the cart count
add_filter('woocommerce_add_to_cart_fragments', 'woo_cart_but_count');
/**
 * Add AJAX Shortcode when cart contents update
 */

 
 function woo_cart_but_count($fragments) {
    ob_start();
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url(); ?>
    <span class="cart-count"><?php echo $cart_count; ?></span>
    <?php $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}


function woo_cart_count_icon(){
    ob_start(); ?>
    <button class="bar-btn sideMenuToggler d-xl-inline-block cart-menu-icon">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
        <span class="cart-count">0</span>
    </button>
    <?php return ob_get_clean();
}
add_shortcode('woo_cart_count', 'woo_cart_count_icon');

