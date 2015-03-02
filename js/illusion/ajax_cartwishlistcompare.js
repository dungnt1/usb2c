//<![CDATA[

function AddToCartOnListProduct() {
    //'.category-products .btn-cart, .crosssell .btn-cart,.cms-home .btn-cart'
    var is_view = jQuery('#product_addtocart_form').attr('method');
    var is_list_compare = jQuery('.catalog-product-compare-index').length;
    var is_checkout_page = jQuery('.checkout-cart-index').length;
    var is_wishlist_page = jQuery('.wishlist-index-index').length;
    if(is_view || is_list_compare >0 || is_checkout_page >0 || is_wishlist_page>0) return false;
    jQuery('.btn-cart').each(function(){
        var linkToCart = jQuery(this).attr('onclick');
        var effectToCart = jQuery('.effect_to_cart').attr('value');
        if(linkToCart){
            linkToCart = linkToCart.replace("setLocation('","").replace("')","");
            //jQuery(this).attr('name',linkToCart);
            jQuery(this).removeAttr('onclick')
            jQuery(this).on('click',function(){
                //getProductInfoFromCart(linkToCart,'type_product=1');
                var base_url = jQuery('#ajaxconfig_info a').attr('href');
                if(linkToCart.search('checkout/cart/add')!= -1 || linkToCart.search('ajaxcartsuper/ajaxcart/add') !=-1) {
                    linkToCart =  linkToCart.replace('checkout/cart', 'ajaxcartsuper/ajaxcart');
                    ajaxToCart(linkToCart,"",jQuery(this));
                    var img = jQuery(this).closest('li').find('img:first');
                    if(!img.length) {
                        img = jQuery(this).closest('.actions').parent().find('.product-image');
                        if(!img.length){
                            img = jQuery(this).closest('.actions').parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).closest('.actions').parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).closest('.actions').parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).parent().parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
                        if(!img.length){
                            img = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }

                        if(!img.length){
                            img = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.product-image');
                        }
                    }
                    if(effectToCart==1) {
                        flyToCart(jQuery(img), jQuery('.top-cart-contain'));
                    }

                } else {
                    location.href = linkToCart;
                    return false;
                }
            });
        }
    });
}
    
function AddToCartOnProductView() {
    var is_view = jQuery('#product_addtocart_form').attr('method');
    if(is_view) {
        productAddToCartForm.submit = function(button,url){
            if(this.validator && this.validator.validate()){
                var form = this.form;
                var oldUrl = form.action;
                if (url) {
                    form.action = url;
                }
                var e = null;
                // ajax code
                if(!url){
                    url = jQuery('#product_addtocart_form').attr('action');
                }
                var data = jQuery('#product_addtocart_form').serialize();

                var fileInput = jQuery('#product_addtocart_form input[type="file"]');
                if(fileInput.length>0) {
                    var file = fileInput[0].files[0];
                }
                
                if(!file) {
                    ajaxToCart(url,data,'view');
                } else {
                    //jQuery('#product_addtocart_form').attr('target', '_blank')
                    form.submit();
                }
                //End ajax code
                this.form.action = oldUrl;
                if (e) {
                    throw e;
                }
            }
            return false;
        }
    }
}

function getProductIdFrom(url) {
    if(url.search('form_key')!=-1) {
        var a = url.search('/form_key/');
        var p = url.search('/product/');
        var form_key= url.substring(p,a); 
        var product_id = form_key.replace('/product/','');
        return product_id;
    }
    var myURLArray = url.split('/');
    var lastChunk = '';
    while (myURLArray.length > 0 && lastChunk == '') {
      lastChunk = myURLArray.pop();
    }
    return lastChunk;
}


function getProductInfoFromCart(linkToCart) {
	
    jQuery.ajax({
        url: linkToCart,
        type: 'GET',
        data: {},
        beforeSend: function(){
            showLoadingAnimation();
        },
        success: function(data) {
            hideLoadingAnimation();
            var htmlObject = jQuery(data);
            var formCart = htmlObject.find('.main-container').html();
            showProductOption(formCart);
            return false;
        }
    });
}

//compare product
function addProductCompare() {
    jQuery('.link-compare').each(function(){
        var compareUrl = jQuery(this).attr('href');
        if(compareUrl.search('product_compare/add/product')!=-1){
            jQuery(this).bind('click',function(){
                ajaxToCart(compareUrl,'','');
                return false;
            });
        }
    });
}
//wishlist product
function addProductToCartFromWishlist() {
      jQuery('li .link-cart').each(function(){
        var addToCartWishlistUrl = jQuery(this).attr('href');
        jQuery(this).bind('click',function(){
                ajaxToCart(addToCartWishlistUrl,'','');
            return false;
        });
    });
}

function addProductWishlist() {
    jQuery('a.link-wishlist').each(function(){
    var wishlistUrl = jQuery(this).attr('href');
    if(wishlistUrl.search('wishlist/index/add/product')!=-1){
    jQuery(this).bind('click',function(){
        var isLogin = jQuery('#ajaxconfig_info input').attr('value');
        if(isLogin !=1){
            location.href = wishlistUrl;
            return false;
        }
        ajaxToCart(wishlistUrl,'','');
        return false;
    });
    }
    });
}

function addToWishlistCompareOnProductView() {
    var haveLogin = jQuery('#ajaxconfig_info input').attr('value');
    if(haveLogin ==1){
        jQuery('.product-options-bottom .link-wishlist').removeAttr('onclick');
    }
    
    jQuery('.product-options-bottom .link-wishlist, .product-options-bottom .link-compare').bind('click',function(){
        var link = jQuery(this).attr('href');
        ajaxToCart(link,'','');
        return false;
    });
}

function removeCompareProductLink(){

      jQuery('#compare-items li .btn-remove').each(function(){
        var removeCompareUrl = jQuery(this).attr('href');
        try {
            if(removeCompareUrl.search('product_compare/remove/product')!=-1) {
            jQuery(this).removeAttr('href');
            jQuery(this).removeAttr('onclick');
            jQuery(this).on('click',function(){
                var confirm_content = jQuery('.confirm_delete_product').attr('value');
                 if(confirm(confirm_content)){
                      ajaxToCart(removeCompareUrl,'','');
                 };
                return false;
            });
        }
        } catch (exception) { 
        }
    });
}

function removeWislishProductLink(){
      jQuery('#wishlist-sidebar li .btn-remove').each(function(){
        var removeWishlistUrl = jQuery(this).attr('href');
        if(removeWishlistUrl.search('wishlist/index/remove')!=-1) {
        jQuery(this).attr('href','javascript:void(0)');
        jQuery(this).removeAttr('onclick');
        jQuery(this).on('click',function(){
             var confirm_content = jQuery('.confirm_delete_product').attr('value');
             if(confirm(confirm_content)){
                 ajaxToCart(removeWishlistUrl,'','');
             }
            return false;
        });
        }
    });
}


function showLoadingAnimation(){
    var loading_bg = jQuery('#ajaxconfig_info button').attr('name');
    var opacity = jQuery('#ajaxconfig_info button').attr('value');
    var loading_image = jQuery('#ajaxconfig_info img').attr('src');
    var style_wrapper =  "position: fixed; top:0; left:0; filter: alpha(opacity=70); z-index:99999;background-color:"+loading_bg+"; width:100%; height:100%; opacity:"+opacity+"";
    var loading = '<div id ="wraper_ajax" style ="'+style_wrapper+'" ><div  class ="loadding_ajaxcart" style ="z-index:999999;position:fixed; top:50%; left:50%;"><img src="'+loading_image+'"/></div></div>';
    if(jQuery('#wraper_ajax').length==0) {
        jQuery('body').append(loading);
    }
    //jQuery('.header-container').append(loading);
}

function showLoadingAnimationWishlist(){
    var loading_bg = jQuery('#ajaxconfig_info button').attr('name');
    var opacity = jQuery('#ajaxconfig_info button').attr('value');
    var loading_image = jQuery('#ajaxconfig_info img').attr('src');
    var style_wrapper =  "position: fixed;top:0;left:0;filter: alpha(opacity=70); z-index:99999;background-color:"+loading_bg+"; width:100%;height:100%;opacity:"+opacity+"";
    var loading = '<div id ="wraper_ajax_wishlist" style ="'+style_wrapper+'" ><div  class ="loadding_ajaxcart_wishlist" style ="z-index:999999;position:fixed; top:50%; left:50%;"><img src="'+loading_image+'"/></div></div>';
    jQuery('.my-wishlist').append(loading);
    //jQuery('.header-container').append(loading);
}

function showBoxInfo(product_info) {
    var base_url = jQuery('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'checkout/cart';
    var title_shopping_cart = jQuery('.title_shopping_cart').attr('value');
    var title_shopping_continue = jQuery('.title_shopping_continue').attr('value');
    var title_add_to_cart = jQuery('.title_add_to_cart').attr('value');
    var  str = "<div class ='wrapper_box'>";
    str += "<div><p class ='info'>"+title_add_to_cart+"</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping' class='r_corners' onclick='hideLoadingAnimation();'>"+title_shopping_continue+"</a></div>";
    str += "<div><a href='"+cart_url+"'  id ='shopping_cart'>"+title_shopping_cart+"</a></div></div>";
    //jQuery('.loadding_ajaxcart').html(str);
    jQuery(str).insertAfter('#wraper_ajax');
    jQuery('#wraper_ajax').css('opacity',0.8);
}

function showBoxInfoWishlist(product_info) {
    var base_url = jQuery('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'wishlist/'
    var str = "<div class ='wrapper_box pop_wishlist1'>";
    var title_shopping_continue = jQuery('.title_shopping_continue').attr('value');
    var title_shopping_wishlist = jQuery('.title_shopping_wishlist').attr('value');
    var title_add_to_wishlist = jQuery('.title_add_to_wishlist').attr('value');
    str += "<div><p class ='info'>"+title_add_to_wishlist+"</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping' class='r_corners' onclick='hideLoadingAnimation()'>"+title_shopping_continue+"</a></div>";
    str += "<div><a href='"+cart_url+"' id='shopping_cart'  >"+title_shopping_wishlist+"</a></div></div>";
    jQuery('.loadding_ajaxcart').html(str);
    jQuery(str).insertAfter('#wraper_ajax');
    jQuery('#wraper_ajax').css('opacity',0.8);
}

function showBoxInfoCompare(product_info) {
    var base_url = jQuery('#ajaxconfig_info a').attr('href');
    var cart_url = base_url+ 'catalog/product_compare/index/'
    var str = "<div class ='wrapper_box pop_compare1'>";
    var title_shopping_continue = jQuery('.title_shopping_continue').attr('value');
    var title_shopping_compare = jQuery('.title_shopping_compare').attr('value');
    var title_add_to_compare = jQuery('.title_add_to_compare').attr('value');
    str += "<div><p class ='info'>"+title_add_to_compare+"</p></div>";
    str += "<div id ='product_info_box'>"+product_info+"</div>";
    str += "<div><a href= 'javascript:void(0)'  id ='continue_shopping' onclick='hideLoadingAnimation();'>"+title_shopping_continue+"</a></div>";
    str += "<div><a id='shopping_cart' target='_blank' href='"+cart_url+"'>"+title_shopping_compare+"</a></div></div>";
 
    jQuery('.loadding_ajaxcart').html(str);
    jQuery(str).insertAfter('#wraper_ajax');
    jQuery('#wraper_ajax').css('opacity',0.8);
}

function showProductOption(product_info) {
    var str = "<div class ='wrapper_box pop_up_product_option'>";
        str += product_info ;
        str +='</div>' ;
    jQuery('.loadding_ajaxcart').html(str);
    jQuery(str).insertAfter('#wraper_ajax');
    jQuery('#wraper_ajax').css('opacity',0.8);
    jQuery('#productHaveOption').html(product_info);

}

function hideLoadingAnimation() {
    jQuery('.loadding_ajaxcart,#wraper_ajax,.wrapper_box').remove();
}

function showMiniAjaxCart() {
    jQuery('#mini_cart_block').show();
}

function hideMiniAjaxCart() {
    jQuery('#mini_cart_block').slideUp()
    jQuery('#mini_cart_block').hide();
}

function changeDelelteUrl() {
    var str = '<script type ="text/javascript">\n\
                                   jQuery("#cart-sidebar a.btn-remove").each(function(){\n\
                                        var delUrl = jQuery(this).attr("href");\n\
                                        jQuery(this).attr("href","#"); \n\
                                        jQuery(this).on("click",function(){\n\
                                            jQuery(this).attr("onclick",ajaxToCart(delUrl,"","view"));\n\
                                                return false;                               \n\
                                        });   \n\
                                });\n\
                                \n\
                    </script>';
    return str;
}

function receive(saveData) {
    if (saveData == null) {
            alert("DATA IS UNDEFINED!");  // displays every time
    }
    console.log("Success is " + saveData);  // 'Success is undefined'
}

/**
 *
 * @param url
 * @param data
 * @param mine
 */
function ajaxToCart(url,data,mine) {
	var using_ssl = jQuery('.using_ssl').attr('value');
    url = url.replace('checkout/cart', 'ajaxcartwishlistcompare/ajaxcart');
	  //cross domain request possible fix
    url = url.replace(/http[^:]*:/, document.location.protocol);
	if(using_ssl==1) { 
		url = url.replace("http://", "https://");
	}
    try {
        jQuery.ajax({
            url: url,
            dataType: 'jsonP',
            type : 'post',
            data : data,
            crossDomain: true,
            beforeSend: function(){
                showLoadingAnimation();
            },
            success: function(data){
                if(data.status==1) {
//                    alert('data.status=1');
                    var base_url = jQuery('#ajaxconfig_info a').attr('href');

                    if(data.illusion_header_cart){
                        jQuery('.shoppingcart').html('');
                        jQuery('.shoppingcart').html(data.illusion_header_cart);
                    }
                    
                    if(data.sidebar_cart) {
                        $$('.sidebar .block-cart').each(function (el){
                            el.replace(data.sidebar_cart);
                        });
                        if(mine=='view') {
                             if(jQuery('#ajax_cart_super_product_view').attr('class')=='popup') {
                                 window.parent.insertContentToParent('.sidebar .block-cart',data.sidebar_cart);
                                 window.parent.deleteCartInSidebar();        
                            }
                        }
                    }
                    if(data.top_link){
                        var topCartContent =    jQuery(data.top_link).find('.top-link-cart').html();
                        jQuery('.top-link-cart').html('');
                        jQuery('.top-link-cart').html(topCartContent);
                        if(mine=='view') {
                             if(jQuery('#ajax_cart_super_product_view').attr('class')=='popup') {
                                window.parent.insertContentTopLinkToParent('.quick-access ul.links',data.top_link);
                             }
                        }
                    }
                    //show minicart
                    if(data.mini_cart) {
                        jQuery('#mini_cart_block').html('');
                        jQuery('#mini_cart_block').html(data.mini_cart);
                    }
                    
                    if(data.checkout_cart){
                        jQuery('.col-main .cart').html('');
                        jQuery('.col-main .cart').append(data.checkout_cart);
                    }  
                    
             
                    //compare type
                    if(data.type_sidebar == 'compare'){
                        $$('#compare-block').each(function (el){
                            el.replace(data.sidebar_compare);
                        });
						removeCompareProductLink();
                        if(data.product_info) {
                            showBoxInfoCompare(data.product_info);
                            return false;
                        }else {
                            hideLoadingAnimation();
                        }
                    }
                    
                    if(data.type_sidebar == 'wishlist'){
						if(jQuery('.wishlist-index-index').length) {
								var wishlist_url = location.href;
								if(using_ssl==1) { 
									wishlist_url = wishlist_url.replace("http://", "https://");
								}	
								showLoadingAnimationWishlist();
								jQuery.get( wishlist_url, function( data ) {
									var form_wishlist = jQuery(data).find('.my-wishlist').html();
									jQuery('.my-wishlist').html(form_wishlist);
								});
						}
                        if(!jQuery('.sidebar .block-wishlist').length){
                            jQuery('<div class="block block-wishlist"></div>').insertAfter('.sidebar .block-cart');
                        }
                        $$('.sidebar .block-wishlist').each(function (el){
                            el.replace(data.wishlist_sidebar);
                        });
						
                    	$$('.quick-access ul.links').each(function (el){
                            el.replace(data.top_link);
                        });
                         
						removeWislishProductLink();
                        if(data.product_info) {
                            showBoxInfoWishlist(data.product_info);
                            return false;
                        }else {
                            hideLoadingAnimation();
                        }
                    }
                    if(data.product_info) {
                        showBoxInfo(data.product_info);
                    }else {
                        hideLoadingAnimation();
                    }
                 
                } else {
                    if(data.status==0){
                        if(!confirm(data.message)){
                            hideLoadingAnimation();
                            return false;
                        }
                        hideLoadingAnimation();
                        if(data.url_wislist) {
                            location.href = data.url_wislist;
                            return false;
                        }
                    }
                     if(data.type_product_ajax==1){
                        location.href = url;
                        return false;
                    }
                }
                deleteCartInSidebar();
            //parent.jQuery.fn.fancybox.close();
            return false;
            }
        });
    } catch (e) {
        alert('error here');
        setLocation(url);
    }
   
}

function insertContentToParent(element,data) {
     $$('.sidebar .block-cart').each(function (el){
        el.replace(data);
    });
    //jQuery('.sidebar').append(changeDelelteUrl());
    return false;
}

function insertContentTopLinkToParent(element,data) {
     $$(element).each(function (el){
        el.replace(data);
    });
    return false;
}

function insertContentMiniCartToParent(element,data) {
    jQuery(element).html('');
    jQuery(element).append(data);
    jQuery('#mini_cart_block').show();
    deleteCartInSidebar();
    return false;
}


//delete product out of cart in checkout page
function deleteCartInCheckoutPage(){ 
    jQuery('.checkout-cart-index a.btn-remove').removeAttr('onclick');
    jQuery(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").click(function(event) {
        event.preventDefault();
        var confirm_content = jQuery('.confirm_delete_product').attr('value');
        if(!confirm(confirm_content)){
            return false;
        }
         var delUrl = jQuery(this).attr("href");
            delUrl = delUrl.replace("checkout/cart/delete", "ajaxcartsuper/index/cartdelete");
			
		var using_ssl = jQuery('.using_ssl').attr('value');
		  //cross domain request possible fix
		delUrl = delUrl.replace(/http[^:]*:/, document.location.protocol);
		if(using_ssl==1) { 
			delUrl = delUrl.replace("http://", "https://");
		}
		
        jQuery.ajax({
            url: delUrl,
			dataType: 'jsonP',
			crossDomain: true,
            type: 'POST',
            data: {},
            beforeSend:function(){
               showLoadingAnimation();
            },
            success: function(xhr) {
				var form_cart = xhr['form_cart'];
				var top_cart = '<div class ="top-cart-contain">'+xhr["top_cart"]+'</div>';
                $('ajaxcart-checkout-content').innerHTML = form_cart;
                $('ajaxcart-checkout-content').insert(form_cart);
                var cart_content = $('ajaxcart-checkout-content').down('.cart_content').innerHTML;
                 jQuery('.top-link-cart').html(cart_content);
                 $$('.top-cart-contain').each(function (el){
                     el.replace(top_cart);
                 });
                var full_cart_content = $('ajaxcart-checkout-content').down('.ajaxcart_checkout_content').innerHTML;
                $$('.cart').each(function (el){
                    el.replace(full_cart_content);
                });
                hideLoadingAnimation();
                jQuery('#ajaxcart-checkout-content').html('');
            },
			complete: function(xhr) {
				getQuote();
				getDiscountCodes();
				slideEffectAjax();
			}
        });
        
    });
   
    return false;
}

function getDiscountCodes() {
    jQuery('#discount-coupon-form').attr('id','discount-coupon-form-ajax');
    var discountFormAjax = new VarienForm('discount-coupon-form-ajax');
    discountForm.submit = function (isRemove) {
        if (isRemove) {
            $('coupon_code').removeClassName('required-entry');
            $('remove-coupone').value = "1";
        } else {
            $('coupon_code').addClassName('required-entry');
            $('remove-coupone').value = "0";
        }
        return VarienForm.prototype.submit.bind(discountFormAjax)();
    }
}

function getQuote() {
    jQuery('#shipping-zip-form').attr('id','shipping-zip-form-ajax');
    var coShippingMethodFormAjax = new VarienForm('shipping-zip-form-ajax');
    coShippingMethodForm.submit = function () {
        var country = $F('country');
        var optionalZip = false;

        for (i=0; i < countriesWithOptionalZip.length; i++) {
            if (countriesWithOptionalZip[i] == country) {
                optionalZip = true;
            }
        }
        if (optionalZip) {
            $('postcode').removeClassName('required-entry');
        }
        else {
            $('postcode').addClassName('required-entry');
        }
        if (this.validator.validate()) {
            this.form.submit();
        }
        console.log(countriesWithOptionalZip.length);
    }.bind(coShippingMethodFormAjax);
}

function slideEffectAjax() {
      jQuery('.top-cart-wrapper').mouseenter(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideDown();
        });
        //hide submenus on exit
        jQuery('.top-cart-wrapper').mouseleave(function() {
            jQuery(this).find(".top-cart-content").stop(true, true).slideUp();
        });
}

function deleteCartInSidebar() {
    var is_checkout_page = jQuery('.checkout-cart-index').length;
    if(is_checkout_page>0) return false;
    jQuery('#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove').each(function(){
        var delUrl = jQuery(this).attr('href');
        jQuery(this).attr('href','#');
        jQuery(this).attr('onclick','');
        if(delUrl.search('checkout/cart/delete')!=-1) {
            jQuery(this).on('click',function(){
                  var confirm_content = jQuery('.confirm_delete_product').attr('value');
                  if(confirm(confirm_content)){
                        jQuery(this).attr('onclick',ajaxToCart(delUrl,'','view'));
                 };
                return false;
            });              
        }
    });
}  

jQuery(document).ready(function(){
    var enable_module = jQuery('#enable_module').val();
    if(enable_module==0 || !enable_module) return false;
    //add Class to wishlist link 
    jQuery('.quick-access ul li a').each(function(){
        var link = jQuery(this).attr('href');
        if(link.search('/wishlist/')!=-1){
            jQuery(this).addClass('top_link_wishlist');
        }
    });
    var checkout_url = jQuery('.top-link-checkout').attr('href')+'onepage';
    jQuery('.top-link-checkout').attr('href',checkout_url);
    //delete product out of cart
    deleteCartInSidebar();
    //delete product out of cart in checkout page
    deleteCartInCheckoutPage();
    //compare link
    addProductCompare();
    removeCompareProductLink();
      
    //wishlist link 
    addToWishlistCompareOnProductView();
    addProductWishlist();
    //addProductToCartFromWishlist();
    removeWislishProductLink();
    //hideMiniAjaxCart();
    //add product to cart on list product 
    AddToCartOnListProduct();
    //Add to cart in product view page
    AddToCartOnProductView();
    //hover on link cart 

    jQuery('#continue_shopping, #shopping_cart').bind('click', function(){
        hideLoadingAnimation();
        jQuery('#mini_cart_block').show();
        if(jQuery('#ajax_cart_super_product_view').attr('class')=='popup') {
            parent.jQuery.fancybox.close();
        }
    }); 
    

    jQuery('#wraper_ajax').bind('click',function(){
        jQuery('#wraper_ajax, .wrapper_box').remove();
    })
    //hide mini cart on popup
    jQuery('.ajaxcartsuper-index-productview #mini_cart_block').hide();
    //hover on mini cart 
    slideEffectAjax();
});

jQuery(document).ajaxComplete(function(){
    var enable_module = jQuery('#enable_module').val();
    if(enable_module==0 || !enable_module) return false;
    //hide mini cart on popup
    jQuery('.ajaxcartsuper-index-productview #mini_cart_block').hide();
    AddToCartOnListProduct();
    deleteCartInSidebar();
    removeCompareProductLink();
    removeWislishProductLink();
    addProductToCartFromWishlist();
    addProductCompare();
    addProductWishlist();
    //deleteCartInCheckoutPage();

})

//]]>