<?php

class Illusion_Brands_Model_System_Config_Source_Linktosearch
{
	public function toOptionArray()
	{
		return array(
			array('value' => 3,				'label' => Mage::helper('illusion_brands')->__('-- No Link --')),
			array('value' => 1,				'label' => Mage::helper('illusion_brands')->__('Quick Search Results')),
			array('value' => 2,				'label' => Mage::helper('illusion_brands')->__('Advanced Search Results')),
		);
	}
}