<?php
require_once 'Mage/Catalog/controllers/ProductController.php';

class Illusion_AjaxQuickView_ProductController extends Mage_Catalog_ProductController{

    public function quickViewAction() {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            $this->_redirect('/');
        }

        if ($product = $this->_initProduct()) {
            $this->loadLayout()->renderLayout();
//            $this->getResponse()->setBody($this->getLayout()->createBlock('illusion_ajaxquickview/product')->toHtml());
        } else {
            echo Mage::helper('catalog')->__('Product not found');
        }
    }
}