<?php

class Illusion_Settings_Model_System_Config_Source_Slider_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'revolution',	'label' => Mage::helper('illusion_settings')->__('Revolution')),
            array('value' => 'smart',	'label' => Mage::helper('illusion_settings')->__('Smart Sliders'))
        );
    }
}

