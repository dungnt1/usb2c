<?php

class Illusion_Featuredproducts_Block_Featuredproducts extends Mage_Catalog_Block_Product_List{


    public function _prepareLayout(){
        return parent::_prepareLayout();
    }

    public function getIllusionfeaturedproducts()
    {
        if (!$this->hasData('illusionfeaturedproducts')) {
            $this->setData('illusionfeaturedproducts', Mage::registry('illusionfeaturedproducts'));
        }
        return $this->getData('illusionfeaturedproducts');
    }

    public function getProducts(){

        $_rootCatID = Mage::app()->getStore()->getRootCategoryId();
        $storeId    = Mage::app()->getStore()->getId();
        $qty = Mage::getStoreConfig('featured_products/settings/qty');

//        $products = Mage::getResourceModel('catalog/product_collection')
//            ->joinField('category_id','catalog/category_product','category_id','product_id=entity_id',null,'left')
//            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
//            ->addMinimalPrice()
//            ->addUrlRewrite()
//            ->addTaxPercents()
//            ->addStoreFilter()
//            ->addAttributeToFilter('category_id', array('in' => $_rootCatID))
//            ->addAttributeToFilter("featured_product", array('eq' => '1'));
//
//        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
//        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->setStoreId($storeId)
            ->addFieldToFilter('featured_product', array('eq' => '1'));

        $products->setPageSize($qty)->setCurPage(1);
        $this->setProductCollection($products);

    }

    public function getRatingSummary($_product){
        $storeId = Mage::app()->getStore()->getId();
        $summaryData = Mage::getModel('review/review_summary')
            ->setStoreId($storeId)
            ->load($_product->getId());

        return $summaryData;
    }
}