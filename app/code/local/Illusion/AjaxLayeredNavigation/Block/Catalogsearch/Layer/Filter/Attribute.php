<?php
class Illusion_AjaxLayeredNavigation_Block_Catalogsearch_Layer_Filter_Attribute extends Mage_CatalogSearch_Block_Layer_Filter_Attribute
{
    public function __construct()
    {
        
        parent::__construct();
        
        $enableModule = Mage::helper('illusion_ajaxlayerednavigation')->getStoreConfigField('enabled');
        if($enableModule){
            $this->setTemplate('ajaxlayerednavigation/attribute.phtml');
        }
    }
}