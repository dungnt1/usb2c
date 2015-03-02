<?php

class Illusion_NewProducts_Block_Newproducts extends Mage_Catalog_Block_Product_List{

    public function _prepareLayout(){
        return parent::_prepareLayout();
    }

    protected function _getProductCollection(){
        $qty = Mage::getStoreConfig('new_products/settings/qty');
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate))
            ->addAttributeToFilter('news_to_date', array('or'=> array(
                0 => array('date' => true, 'from' => $todayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->addAttributeToSort('news_from_date', 'desc')
            ->setPageSize($qty)
            ->setCurPage(1);

        $this->setProductCollection($collection);

        return $collection;
    }

    public function getRatingSummary($_product){
        $storeId = Mage::app()->getStore()->getId();
        $summaryData = Mage::getModel('review/review_summary')
            ->setStoreId($storeId)
            ->load($_product->getId());

        return $summaryData;
    }
}