<?php
/**
 * @category    MT
 * @package     MT_RevSlider
 * @copyright   Copyright (C) 2008-2014 MagentoThemes.net. All Rights Reserved.
 * @license     GNU General Public License version 2 or later
 * @author      MagentoThemes.net
 * @email       support@magentothemes.net
 */

class MT_RevSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Slider_Preview
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{

    public function _getValue(Varien_Object $row){
        return sprintf('<a href="%s" title="%s" target="_blank">%s</a>',
            Mage::helper('revslider')->getFrontendUrl('revslider/index/preview', array('id' => $row->getId())),
            Mage::helper('revslider')->__('Click to see preview'),
            Mage::helper('revslider')->__('Preview')
        );
    }
}
