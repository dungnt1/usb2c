<?php

class Illusion_Settings_Model_System_Config_Source_Menu_Type{

    public function toOptionArray()
    {
        return array(
            array('value' => 'sticky_menu',	'label' => Mage::helper('illusion_settings')->__('Sticky Menu')),
            array('value' => 'side_menu',	'label' => Mage::helper('illusion_settings')->__('Side Menu')),
            array('value' => 'none',	    'label' => Mage::helper('illusion_settings')->__('None'))
        );
    }
}