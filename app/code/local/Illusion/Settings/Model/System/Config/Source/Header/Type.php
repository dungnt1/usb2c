<?php

class Illusion_Settings_Model_System_Config_Source_Header_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'header_1',	'label' => Mage::helper('illusion_settings')->__('Header 1')),
            array('value' => 'header_2',	'label' => Mage::helper('illusion_settings')->__('Header 2')),
            array('value' => 'header_3',	'label' => Mage::helper('illusion_settings')->__('Header 3'))
        );
    }
}