<?php
 
class Illusion_AjaxCartWishlistCompare_Block_Cartdelete extends Mage_Catalog_Block_Product_Abstract{

    /**
     * Set Template
     */
    public function __construct() {
        parent::__construct();
        $this->setTemplate('ajaxcartwishlistcompare/ajaxcart.phtml');
    }

    /**
     * Prepare Layout
     * @return Mage_Catalog_Block_Product_Abstract|void
     */
    protected function _prepareLayout(){
        parent::_prepareLayout();
    }

    /**
     * Get Pager
     * @return string
     */
    public function getPagerHtml(){
        return $this->getChildHtml('pager');
    }

    /**
     * Get Back Url
     * @return string
     */
    public function getBackUrl(){
        return $this->getUrl('customer/account/');
    }

    /**
     * Get Invite Button
     * @return string
     */
    public function getInviteButtonHtml(){
        return $this->getChildHtml('invite_button');
    }
}
