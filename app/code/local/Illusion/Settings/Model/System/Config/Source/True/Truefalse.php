<?php

class Illusion_Settings_Model_System_Config_Source_True_Truefalse{

    public function toOptionArray()
    {
        return array(

            array('value' => 'true',	'label' => Mage::helper('illusion_settings')->__('Yes')),
            array('value' => 'false',	'label' => Mage::helper('illusion_settings')->__('No'))

        );
    }
}