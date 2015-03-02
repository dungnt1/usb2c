<?php

class Illusion_Searchautocomplete_Model_Mysql4_Ajaxsearch_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct(){
        parent::_construct();
        $this->_init('searchautocomplete/searchautocomplete');
    }
}
