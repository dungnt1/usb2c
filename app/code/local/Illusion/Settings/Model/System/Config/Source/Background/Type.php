<?php

class Illusion_Settings_Model_System_Config_Source_Background_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'no-repeat',	'label' => Mage::helper('illusion_settings')->__('no-repeat')),
            array('value' => 'repeat',	    'label' => Mage::helper('illusion_settings')->__('repeat')),
            array('value' => 'repeat-x',	'label' => Mage::helper('illusion_settings')->__('repeat-x')),
            array('value' => 'repeat-y',	'label' => Mage::helper('illusion_settings')->__('repeat-y')),
        );
    }
}