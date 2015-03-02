<?php

class Illusion_BestsellerProducts_Block_Bestsellerproducts extends Mage_Catalog_Block_Product_List{

    public function _prepareLayout(){
        return parent::_prepareLayout();
    }

    public function getProducts(){
        $qty = Mage::getStoreConfig('bestseller_products/settings/qty');
        $storeId    = Mage::app()->getStore()->getId();
        $products = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image', 'rating_summary'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->setOrder('ordered_qty', 'desc');

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