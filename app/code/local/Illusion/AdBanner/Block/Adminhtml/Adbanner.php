<?php

class Illusion_AdBanner_Block_Adminhtml_Adbanner extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct(){
        $this->_controller = 'adminhtml_adbanner';
        $this->_blockGroup = 'illusion_adbanner';
        $this->_headerText = $this->helper('illusion_adbanner')->__('AdBanner manager');
        $this->_addButtonLabel = $this->helper('illusion_adbanner')->__('Add AdBanner');
        parent::__construct();
    }
}