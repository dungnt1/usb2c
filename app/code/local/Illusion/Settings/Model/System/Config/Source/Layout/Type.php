<?php

class Illusion_Settings_Model_System_Config_Source_Layout_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'wide_layout',	'label' => Mage::helper('illusion_settings')->__('Wide')),
            array('value' => 'boxed_layout',	'label' => Mage::helper('illusion_settings')->__('Boxed'))
        );
    }
}