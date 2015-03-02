<?php

class Illusion_AjaxLayeredNavigation_Model_Layerednavigationajax extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('illusion_ajaxlayerednavigation');
    }
}