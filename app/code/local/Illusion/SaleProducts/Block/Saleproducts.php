<?php

class Illusion_SaleProducts_Block_Saleproducts extends Mage_Catalog_Block_Product_List{

    public function _prepareLayout(){
        return parent::_prepareLayout();
    }

    protected function _getProductCollection(){
        $qty = Mage::getStoreConfig('sale_products/settings/qty');
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $collection = Mage::getResourceModel('catalog/product_collection');;

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('visibility', array(
                Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
                Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
            ))
            ->addFinalPrice()
            ->addAttributeToFilter('special_price', array('neq' => ""))
            ->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayDate))
            ->addAttributeToFilter('special_to_date', array('or'=> array(
                0 => array('date' => true, 'from' => $todayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
            ), 'left')
            ->setPageSize($qty)
            ->setCurPage(1);
//          ->order(new Zend_Db_Expr('RAND()')) //in case we would like to sort products randomly
        ;

//        $collection->addAttributeToSelect('*')
//            ->addFieldToFilter('visibility', array(
//                Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
//                Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
//            )) //showing just products visible in catalog or both search and catalog
//            ->addFinalPrice()
////                        ->addAttributeToSort('price', 'asc') //in case we would like to sort products by price
//            ->getSelect()
//            ->where('price_index.final_price < price_index.price')
//            ->limit($qty);

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