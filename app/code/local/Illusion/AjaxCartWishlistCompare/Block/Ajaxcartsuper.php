<?php

class Illusion_AjaxCartWishlistCompare_Block_Ajaxcartsuper extends Mage_Catalog_Block_Product_Abstract{

    /**
     * Prepare Layout
     * @return Mage_Catalog_Block_Product_Abstract
     */
    public function _prepareLayout(){
		return parent::_prepareLayout();
    }

    /**
     * Get Ajax Cart
     * @return mixed
     */
    public function getAjaxcartsuper(){
        if (!$this->hasData('ajaxcartsuper')) {
            $this->setData('ajaxcartsuper', Mage::registry('ajaxcartsuper'));
        }
        return $this->getData('ajaxcartsuper');
    }
}