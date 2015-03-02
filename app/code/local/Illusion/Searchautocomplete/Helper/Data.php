<?php

class Illusion_Searchautocomplete_Helper_Data extends Mage_Core_Helper_Abstract{

    public function getSuggestUrl(){

        return $this->_getUrl('searchautocomplete/suggest/result', array(
            '_secure' => Mage::app()->getFrontController()->getRequest()->isSecure()
        ));

    }

    public function getStyle()
    {
    //$style='';
    $style='
    <style>
        .ajaxsearch{border-radius:4px;background:'.Mage::getStoreConfig('searchautocomplete/preview/background').';border:solid '.Mage::getStoreConfig('searchautocomplete/settings/border_color').' ' .Mage::getStoreConfig('searchautocomplete/settings/border_width').'px}
        .ajaxsearch .suggest{padding:1% 4%; background:'.Mage::getStoreConfig('searchautocomplete/suggest/background').'; color:'.Mage::getStoreConfig('searchautocomplete/suggest/suggest_color').'}
        .ajaxsearch .suggest .amount{color:'.Mage::getStoreConfig('searchautocomplete/suggest/count_color').'}
        .ajaxsearch .preview {cursor:pointer; background:'.Mage::getStoreConfig('searchautocomplete/preview/background').'; display: inline-block; margin: 2%; padding: 2%; width: 96%;}
        .ajaxsearch .preview a {margin-left:10px; color:'.Mage::getStoreConfig('searchautocomplete/preview/pro_title_color').'; font-weight:300;}
        .ajaxsearch .preview .description {color:'.Mage::getStoreConfig('searchautocomplete/preview/pro_description_color').'}
        .ajaxsearch .preview img {float:left; border:solid '.Mage::getStoreConfig('searchautocomplete/preview/image_border_width').'px '.Mage::getStoreConfig('searchautocomplete/preview/image_border_color').' }
        .ajaxsearch .preview.selected {background-color:'.Mage::getStoreConfig('searchautocomplete/settings/hover_background').'}
    </style>';
    return $style;
    }
}
