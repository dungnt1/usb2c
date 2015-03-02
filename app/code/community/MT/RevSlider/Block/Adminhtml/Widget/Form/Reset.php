<?php
/**
 * @category    MT
 * @package     MT_RevSlider
 * @copyright   Copyright (C) 2008-2014 MagentoThemes.net. All Rights Reserved.
 * @license     GNU General Public License version 2 or later
 * @author      MagentoThemes.net
 * @email       support@magentothemes.net
 */

class MT_RevSlider_Block_Adminhtml_Widget_Form_Reset
    extends Mage_Adminhtml_Block_Widget
    implements Varien_Data_Form_Element_Renderer_Interface{

    public function __construct(){
        parent::__construct();
        $this->setTemplate('mt/revslider/widget/form/reset.phtml');
    }

    public function render(Varien_Data_Form_Element_Abstract $element){
        return $this->toHtml();
    }

    protected function _prepareLayout(){
        $this->setChild('resetBtn', $this->getLayout()->createBlock('adminhtml/widget_button', '', array(
            'id'        => 'resetScaleBtn',
            'label'     => Mage::helper('revslider')->__('Reset'),
            'type'      => 'button',
            'onclick'   => 'revLayer.resetScale()'
        )));

        return parent::_prepareLayout();
    }
}
