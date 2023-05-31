jQuery( document ).ready(function() {

    function alljQueries(){
        // var enable = addtocart_sidebar.ecb_enable;
        var product = addtocart_sidebar.product;
        var cart_position = addtocart_sidebar.basekt_position;
        jQuery("body").on("added_to_cart",function() {
            jQuery.ajax({
                type : "post",
                url : addtocart_sidebar.ajaxurl,
                data : {action: "mcsfw_atcaiofw_cart"},
                beforeSend: function() {
                    console.log('beforeSend :>> ');
                    jQuery(".qty-btn").prop("disabled", true);
                },
                success : function(data){
                   var obj = jQuery.parseJSON(data);
                   jQuery(".sidemenu-peid").html(obj.htmlcart);
                   jQuery(".sidebar_cart_count").html(obj.htmlcount);
                   jQuery(".cart-count").html(obj.htmlcount);
    
                    setTimeout(function() {
                        jQuery(".sideMenuToggler").trigger('click');
                        // jQuery("body").addClass("cart_sidebar");
                        // jQuery(".sidemenu-peid").addClass("product_detail");
                        jQuery(".sidemenu-wrapper").addClass("show");
                        jQuery(".popup_overlay").addClass("display");
    
                        // if(jQuery('.sideMenuToggler').hasClass('atc_custom')){
                        //    jQuery('.sideMenuToggler').removeClass('atc_custom');
                        // }
                    }, 100);
                },
                complete: function() {
                    console.log('completeded :>> ');
                    alljQueries();
                    jQuery(".qty-btn").prop("disabled", false);
                },
            });
        });
    
        
        
        jQuery(".sideMenuToggler").on("click",function(){
            if(cart_position == "left"){
                jQuery(".sidemenu-content").addClass('left');
                jQuery(".sidemenu-content").animate({'width': '670px' , 'left': '0px'});
            }else{
                jQuery(".sidemenu-content").addClass('right');
                jQuery(".sidemenu-content").animate({'width': '670px' , 'right': '0px'});
            }
            // jQuery("body").addClass("cart_sidebar");
            // jQuery(".sidemenu-peid").addClass("product_detail");
            jQuery(".popup_overlay").addClass("display");
    
            // if(jQuery('.sideMenuToggler').hasClass('atc_custom')){
            //    jQuery('.sideMenuToggler').removeClass('atc_custom');
            // }
        });
    
        if(product == ''){
            jQuery('.cart_footer_spro').hide();
        }else{
            jQuery('.cart_footer_spro').show();
        }
    
        /* Update Product Quantity */
        jQuery('body').on('change','.pqty_total',function () {
            jQuery( document.body ).trigger( 'update_checkout' );
            var qty = jQuery(this).val();
            var product_key = jQuery(this).attr('pro_qty_key');
            jQuery.ajax({
                type : "post",
                url : addtocart_sidebar.ajaxurl,
                data : {
                    action: "mcsfw_atcpro_qty_val",
                    qty: qty,
                    product_key:product_key
                },
                success : function(data){
                    jQuery( document.body ).trigger( 'added_to_cart', [ data.fragments, data.cart_hash ] );
                    alljQueries();
                    setTimeout(function() {
                        jQuery(".mcsfw_atc_success_message").slideDown(1000);
                        jQuery(".mcsfw_atc_success_message").html('Item updated.');
                    }, 900);
                    setTimeout(function() {
                        jQuery('.mcsfw_atc_success_message').slideUp(1000);
                    }, 5000);
                }
            });
        });

    
        jQuery("#close-btn").click(function(){
        // jQuery(document.body).on('click', '#close-btn', function(){
            if(cart_position == "left"){
                jQuery(".sidemenu-content").animate({'width': '670px' , 'left': '-670px'});
                // jQuery(".sidemenu-content").removeClass('left');
            }else{
                jQuery(".sidemenu-content").animate({'width': '670px' , 'right': '-670px'});
                // jQuery(".sidemenu-content").removeClass('right');
            }
            
            jQuery(".sidemenu-wrapper").removeClass("show");
            // jQuery("body").removeClass("cart_sidebar");
            // jQuery(".sidemenu-peid").removeClass("product_detail");
            // jQuery(".background_overlay").removeClass("overlay_disable");
            jQuery(".popup_overlay").removeClass("display");
            // jQuery('.sideMenuToggler').addClass('atc_custom');
        });
    
        /* Remove Product */
        jQuery(".tit .mcsfw_remove").click( function (e) {
            e.preventDefault();
            var product_id = jQuery(this).attr("data-product_id");
            jQuery.ajax({
                type : "post",
                url: addtocart_sidebar.ajaxurl,
                data: {
                    action: 'mcsfw_remove_product_from_cart',
                    product_id: product_id,
                    // cart_item_key: cart_item_key
                },
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    jQuery(".sidemenu-peid").html(obj.htmlcart);
                    jQuery(".sidebar_cart_count").html(obj.htmlcount);
                    jQuery(".cart-count").html(obj.htmlcount);
                    alljQueries();
        
                    // jQuery( document.body ).trigger( 'removed_from_cart', [ response.fragments, response.cart_hash ] );
                }
            });
        });
        
    
        jQuery('body').on('click', '.mcsfw_continue_shopping_btn', function(){
            if(cart_position == "left"){
                jQuery(".cart_container").animate({'width': '430px' , 'left': '-430px'});
            }else{
                jQuery(".cart_container").animate({'width': '430px' , 'right': '-430px'});
            }
            // jQuery("body").removeClass("cart_sidebar");
            // jQuery(".sidemenu-peid").removeClass("product_detail");
            jQuery(".popup_overlay").addClass("display");
            // jQuery('.sideMenuToggler').addClass('atc_custom');
        });
    
        // jQuery(".popup_overlay").click(function() {
        //     jQuery("#close-btn").click();
        // });
    
        jQuery('.product_slide_cart').on('click', function (e) {
            e.preventDefault();
    
            var jQuerythisbutton = jQuery(this),
                product_id = jQuerythisbutton.attr('data-product_id'),
                product_qty =  jQuerythisbutton.attr('data-quantity'),
                variation_id = jQuerythisbutton.attr('variation-id');
    
            var data = {
                action: 'mcsfw_add_to_cart_slider_pro',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                variation_id: variation_id,
            };
    
            jQuery(document.body).trigger('adding_to_cart', [jQuerythisbutton, data]);
    
            jQuery.ajax({
                type: 'post',
                url: addtocart_sidebar.ajaxurl,
                data: data,
                success: function (response) {
                    jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, jQuerythisbutton]);
                    alljQueries();
                },
            });
    
            return false;
        });


        function added_to_cart(){
            jQuery.ajax({
                type : "post",
                url : addtocart_sidebar.ajaxurl,
                data : {action: "mcsfw_atcaiofw_cart"},
                beforeSend: function() {
                    console.log('added_to_cart beforeSend :>> ');
                    jQuery(".qty-btn").prop("disabled", true);
                },
                success : function(data){
                    var obj = jQuery.parseJSON(data);
                    jQuery(".sidemenu-peid").html(obj.htmlcart);
                    jQuery(".sidebar_cart_count").html(obj.htmlcount);
                    jQuery(".cart-count").html(obj.htmlcount);
    
                    setTimeout(function() {
                        jQuery(".sideMenuToggler").trigger('click');
                        // jQuery(".sidemenu-peid").addClass("product_detail");
                        jQuery(".sidemenu-wrapper").addClass("show");
                        jQuery(".popup_overlay").addClass("display");
    
                        // if(jQuery('.sideMenuToggler').hasClass('atc_custom')){
                        //     jQuery('.sideMenuToggler').removeClass('atc_custom');
                        // }
                    }, 100);
                },
                complete: function() {
                    console.log('added_to_cart completeded :>> ');
                    jQuery(".qty-btn").prop("disabled", false);
                    alljQueries();
                },
            });
        }
        function updateQty(qty, product_key){
            jQuery( document.body ).trigger( 'update_checkout' );
            jQuery.ajax({
                type : "post",
                url : addtocart_sidebar.ajaxurl,
                data : {
                    action: "mcsfw_atcpro_qty_val",
                    qty: qty,
                    product_key:product_key
                },
                beforeSend: function() {
                    console.log('brefore added_to_cart :>> ');
                    jQuery(".qty-btn").prop("disabled", true);
                },
                success: function(data){
                    // console.log('data :>> ', data);
                    // jQuery( document.body ).trigger( 'added_to_cart', [ data.fragments, data.cart_hash ] );
                    // setTimeout(function() {
                    //     jQuery(".mcsfw_atc_success_message").slideDown();
                    //     jQuery(".mcsfw_atc_success_message").html('Item updated.');
                    // }, 600);
                    // setTimeout(function() {
                    //     jQuery('.mcsfw_atc_success_message').slideUp();
                    //     // alljQueries();
                    // }, 1000);
                },
                complete: function() {
                    added_to_cart();
                    console.log('called added_to_cart :>> ');
                    jQuery(".qty-btn").prop("disabled", false);
                    console.log('called alljQueries :>> ');
                },
            });
        }

        function incrementValue(e) {
            e.preventDefault();
            var fieldName = jQuery(e.target).data('field');
            var parent = jQuery(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val());
            var product_key = parent.find('input[name=' + fieldName + ']').attr('pro_qty_key');
            
            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                // var increUpdateVal = (currentVal + 1);
                console.log('parent.find :>> ', parent.find('input[name=' + fieldName + ']').val());
                console.log('increUpdateVal :>> ', (currentVal + 1));
                updateQty((currentVal + 1), product_key);
            } else {
                parent.find('input[name=' + fieldName + ']').val(1);
                // updateQty(1, product_key);
            }
        }
        
        function decrementValue(e) {
            e.preventDefault();
            var fieldName = jQuery(e.target).data('field');
            var parent = jQuery(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val());
            var product_key = parent.find('input[name=' + fieldName + ']').attr('pro_qty_key');
        
            if (!isNaN(currentVal) && currentVal > 1) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                var decreUpdateVal = (currentVal - 1);
                updateQty((currentVal - 1), product_key);
            } else {
                parent.find('input[name=' + fieldName + ']').val(1);
                // updateQty(1, product_key);
            }
        }

        jQuery('.quantity-plus').on('click', function(e){
            incrementValue(e);
        })

        jQuery('.quantity-minus').on('click', function(e){
            decrementValue(e);
        });
        
    }
    alljQueries();
});
