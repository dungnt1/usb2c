<?php

class Illusion_AjaxCartWishlistCompare_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Check if request is Ajax
     * @return bool
     */
    public function isAjax() {
        return (boolean) ((isset($_SERVER['HTTP_X_REQUESTED_WITH'])) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }

    /**
     * Empty Cart Html
     * @return string
     */
    public function getEmptyCartHtml() {
        $html = '<div class="col-main">
                    <div class="page-title">
                        <h1>'.$this->__("Shopping Cart is Empty").'</h1>
                    </div>
                    <div class="cart-empty">
                                <p>'.$this->__("You have no items in your shopping cart").'.</p>
                        <p>'.$this->__("Click").'<a href="'.Mage::getBaseUrl().'">'.$this->__("here").'</a>'.$this->__("to continue shopping").'.</p>
                    </div>
                 </div>';
        return $html;
    }

    /**
     * Get Continue Shopping Url
     * @return string
     */
    public function getContinueShoppingUrl(){
        $url = $this->getData('continue_shopping_url');
        if (is_null($url)) {
            $url = Mage::getSingleton('checkout/session')->getContinueShoppingUrl(true);
            if (!$url) {
                $url = Mage::getUrl();
            }
            $this->setData('continue_shopping_url', $url);
        }
        return $url;
    }

    /**
     * Product HTML
     * @param null $name
     * @param null $link
     * @param null $image
     * @return string
     */
    public function productHtml($name = NULL, $link = NULL, $image = NULL) {
        $html = "";
        $html .="<div class ='p_image'><img src ='".$image."' /></div>";
        $html .= "<div class ='p_name'><a href ='".$link."'>".$name."</a></div>";

        return $html;
    }
}