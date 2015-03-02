<?php

class Illusion_Settings_Model_System_Config_Source_Font_Size
{
    public function toOptionArray()
    {
        return array(
            array('value' => '10px',	'label' => Mage::helper('illusion_settings')->__('10 px')),
            array('value' => '12px',	'label' => Mage::helper('illusion_settings')->__('12 px')),
            array('value' => '13px',	'label' => Mage::helper('illusion_settings')->__('13 px')),
            array('value' => '14px',	'label' => Mage::helper('illusion_settings')->__('14 px')),
            array('value' => '16px',	'label' => Mage::helper('illusion_settings')->__('16 px')),
        );
    }
}