<?php

class Illusion_AjaxLayeredNavigation_Block_Catalog_Layer_Filter_Category extends Mage_Catalog_Block_Layer_Filter_Category {
      public function __construct()
    {
        parent::__construct();
        if(Mage::getStoreConfig('illusion_ajaxlayerednavigation/config/enabled')){
            $this->setTemplate('ajaxlayerednavigation/attribute.phtml');
        }
    }
}
