<?php

class Illusion_AjaxLayeredNavigation_Block_Catalogsearch_Layer_Filter_Decimal extends Mage_CatalogSearch_Block_Layer_Filter_Decimal {
      public function __construct()
    {
        parent::__construct();
        $enableModule = Mage::helper('illusion_ajaxlayerednavigation/data')->getStoreConfigField('enabled');
        if($enableModule){
            $this->setTemplate('ajaxlayerednavigation/attribute.phtml');
        }
    }
}
