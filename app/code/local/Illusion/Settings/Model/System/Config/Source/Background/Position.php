<?php

class Illusion_Settings_Model_System_Config_Source_Background_Position{

    public function toOptionArray()
    {
        return array(
            array('value' => 'left',	'label' => Mage::helper('illusion_settings')->__('Top Left')),
            array('value' => 'center',	'label' => Mage::helper('illusion_settings')->__('Top Center')),
            array('value' => 'right',	'label' => Mage::helper('illusion_settings')->__('Top Right')),
        );
    }
}