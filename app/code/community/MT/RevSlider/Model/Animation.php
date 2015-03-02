<?php
/**
 * @category    MT
 * @package     MT_RevSlider
 * @copyright   Copyright (C) 2008-2014 MagentoThemes.net. All Rights Reserved.
 * @license     GNU General Public License version 2 or later
 * @author      MagentoThemes.net
 * @email       support@magentothemes.net
 */

class MT_RevSlider_Model_Animation extends Mage_Core_Model_Abstract{
    public function _construct(){
        parent::_construct();
        $this->_init('revslider/animation');
    }

    public function loadByName($name){
        return $this->_getResource()->loadByName($this, $name);
    }

    protected function _afterLoad(){
        $this->setData('params', Mage::helper('core')->jsonDecode($this->getData('params')));
        return parent::_afterLoad();
    }
}
