<?php
class Illusion_Settings_Model_System_Config_Source_Appearance_Bg{

    public function toOptionArray(){
        return array(
            array(
	            'value'=>'stretch',
	            'label' => Mage::helper('illusion_settings')->__('stretch')),
            array(
	            'value'=>'tile',
	            'label' => Mage::helper('illusion_settings')->__('tile')),
        );
    }

}
