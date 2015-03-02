<?php

class Illusion_AdBanner_Block_Adbanner extends Mage_Core_Block_Template{

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    /**
     * @return array|Illusion_Banner_Model_Resource_Banner_Collection
     */
    public function getBanners() {
        $collection = Mage::getModel('illusion_adbanner/adbanner')->getCollection();
        $collection->getSelect()
            ->where('find_in_set(0, store_id) OR find_in_set(?, store_id)', (int) (Mage::app()->getStore()->getId()))
            ->where('status=1');
        if (count($collection) > 0)
            return $collection;
        return array();
    }
    public function getAdbanner()
    {
        if (!$this->hasData('adbanner')) {
            $this->setData('adbanner', Mage::registry('adbanner'));
        }
        return $this->getData('adbanner');

    }

}