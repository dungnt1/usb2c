<?php
class Illusion_Searchautocomplete_Block_Ajaxsearch extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSearchautocomplete()     
     { 
        if (!$this->hasData('searchautocomplete')) {
            $this->setData('searchautocomplete', Mage::registry('searchautocomplete'));
        }
        return $this->getData('searchautocomplete');
        
    }
}
