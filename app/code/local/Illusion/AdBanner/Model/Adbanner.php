<?php

class Illusion_AdBanner_Model_Adbanner extends Mage_Core_Model_Abstract{

    protected $_eventPrefix = 'illusion_adbanner';
    protected $_eventObject = 'adbanner';

    public function _construct(){
        parent::_construct();
        $this->_init('illusion_adbanner/adbanner');
    }
}