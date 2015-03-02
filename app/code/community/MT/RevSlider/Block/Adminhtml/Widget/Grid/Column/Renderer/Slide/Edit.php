<?php
/**
 * @category    MT
 * @package     MT_RevSlider
 * @copyright   Copyright (C) 2008-2014 MagentoThemes.net. All Rights Reserved.
 * @license     GNU General Public License version 2 or later
 * @author      MagentoThemes.net
 * @email       support@magentothemes.net
 */

class MT_RevSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Slide_Edit
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{

    public function _getValue(Varien_Object $row){
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
            'label'     => Mage::helper('revslider')->__('Edit'),
            'onclick'   => sprintf('setLocation(\'%s\')',
                $this->getUrl('*/*/addSlide', array('sid' => $row->getSliderId(), 'id' => $row->getId()))
            )
        ));

        return $button->toHtml();
    }
}
