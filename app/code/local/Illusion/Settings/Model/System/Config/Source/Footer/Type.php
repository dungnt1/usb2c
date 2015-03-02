<?php

class Illusion_Settings_Model_System_Config_Source_Footer_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'footer_1',	'label' => Mage::helper('illusion_settings')->__('Footer 1')),
            array('value' => 'footer_2',	'label' => Mage::helper('illusion_settings')->__('Footer 2')),
            array('value' => 'footer_3',	'label' => Mage::helper('illusion_settings')->__('Footer 3'))
        );
    }
}