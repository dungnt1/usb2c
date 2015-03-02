<?php

class Illusion_Settings_Block_Video extends Mage_Core_Block_Template{

    protected $_product = null;

    function getProduct(){

        if (!$this->_product) {
            $this->_product = Mage::registry('product');
        }

        return $this->_product;
    }
}