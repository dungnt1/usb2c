<?php

class Illusion_Settings_Model_System_Config_Source_Font_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'google',	'label' => Mage::helper('illusion_settings')->__('Google Fonts')),
            array('value' => 'custom',	'label' => Mage::helper('illusion_settings')->__('Custom Font'))
        );
    }
}