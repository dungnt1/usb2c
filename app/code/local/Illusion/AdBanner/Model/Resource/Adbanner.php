<?php

class Illusion_AdBanner_Model_Resource_Adbanner extends Mage_Core_Model_Resource_Db_Abstract{

    public function _construct(){
        $this->_init('illusion_adbanner/adbanner', 'adbanner_id');
    }
}