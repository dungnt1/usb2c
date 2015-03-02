<?php

class Illusion_AdBanner_Block_Adminhtml_Adbanner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    /**
     *
     */
    public function __construct(){
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'illusion_adbanner';
        $this->_controller = 'adminhtml_adbanner';

        $this->_updateButton('back', 'onclick', 'setLocation(\''.$this->getUrl('*/*/index').'\')');
        $this->_updateButton('save', 'label', Mage::helper('illusion_adbanner')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('illusion_adbanner')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            ";
    }

    /**
     * @return string
     */
    public function getHeaderText(){
        if( Mage::registry('adbanner_data') && Mage::registry('adbanner_data')->getId() ) {
            return Mage::helper('illusion_adbanner')->__("Edit AdBanner '%s'", $this->htmlEscape(Mage::registry('adbanner_data')->getTitle()));
        } else {
            return Mage::helper('illusion_adbanner')->__('Add AdBanner');
        }
    }
}