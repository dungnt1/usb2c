<?php

class Illusion_Settings_Model_System_Config_Source_Color_Validate extends Mage_Core_Model_Config_Data{

    public function save(){
        $v = $this->getValue();
        if ($v == 'rgba(0, 0, 0, 0)'){
            $this->setValue('transparent');
        }
        return parent::save();
    }
}