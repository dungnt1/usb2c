<?php

class Illusion_Brands_Model_System_Config_Source_Brands
{
	protected $_options;

	public function toOptionArray()
	{
		if (!$this->_options)
		{
			$attributeCode = Mage::getStoreConfig('brands/general/attr_id');
			$attributeModel = Mage::getSingleton('eav/config')
				->getAttribute('catalog_product', $attributeCode);

			$options = array();
			foreach ($attributeModel->getSource()->getAllOptions(false, true) as $o)
			{
				$this->_options[] =
					array('value' => $o['label'], 'label' => $o['label']);
			}
		}
		return $this->_options;
	}
}