<?php

class Illusion_AdBanner_Block_Adminhtml_Adbanner_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{

    public function __construct()
    {
        parent::__construct();
        $this->setId('adbanner_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('illusion_adbanner')->__('AdBanner Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('illusion_adbanner')->__('AdBanner Information'),
            'title'     => Mage::helper('illusion_adbanner')->__('AdBanner Information'),
            'content'   => $this->getLayout()->createBlock('illusion_adbanner/adminhtml_adbanner_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}