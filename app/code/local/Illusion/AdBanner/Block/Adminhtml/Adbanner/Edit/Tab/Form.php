<?php

class Illusion_AdBanner_Block_Adminhtml_Adbanner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $this->setForm($form);

        $fieldset = $form->addFieldset('adbanner_form', array('legend'=>Mage::helper('illusion_adbanner')->__('AdBanner information')));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldset->addField('image', 'image', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Image'),
            'required'  => false,
            'name'      => 'image',
        ));

        $fieldset->addField('link', 'text', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Link'),
            'required'  => false,
            'name'      => 'link',
        ));

        $fieldset->addField('advcode', 'editor', array(
            'name'      => 'advcode',
            'label'     => Mage::helper('illusion_adbanner')->__('Advertisement Code'),
            'title'     => Mage::helper('illusion_adbanner')->__('Advertisement Code'),
            'style'     => 'width:700px; height:200px;',
            'wysiwyg'   => false,
            'required'  => false,
        ));

        $fieldset->addField('advmode', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Advertisement Mode'),
            'name'      => 'advmode',
            'values'    => array(
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('Code'),
                ),

                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Image'),
                ),
            ),
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Enabled'),
                ),

                array(
                    'value'     => 2,
                    'label'     => Mage::helper('illusion_adbanner')->__('Disabled'),
                ),
            ),
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'store_id[]',
                'label' => $this->__('Store View'),
                'required' => TRUE,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(FALSE, TRUE),
            ));
        }

        $fieldset1 = $form->addFieldset('adbanner_form1', array('legend'=>Mage::helper('illusion_adbanner')->__('AdBanner Position(s)')));

        $fieldset1->addField('position_left', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Left Column'),
            'name'      => 'position_left',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));

        $fieldset1->addField('position_content', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Content Column'),
            'name'      => 'position_content',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));

        $fieldset1->addField('position_right', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Right Column'),
            'name'      => 'position_right',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));

        $fieldset2 = $form->addFieldset('adbanner_form2', array('legend'=>Mage::helper('illusion_adbanner')->__('AdBanner on Page(s)')));

        $fieldset2->addField('position_home', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Home Page'),
            'name'      => 'position_home',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));

        $fieldset2->addField('position_category', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Category Page'),
            'name'      => 'position_category',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));

        $fieldset2->addField('position_product', 'select', array(
            'label'     => Mage::helper('illusion_adbanner')->__('Product Page'),
            'name'      => 'position_product',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('illusion_adbanner')->__('Yes'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('illusion_adbanner')->__('No'),
                ),
            ),
        ));





		if ( Mage::registry('adbanner_data') ) {
            $form->setValues(Mage::registry('adbanner_data')->getData());
        }

        return parent::_prepareForm();
    }
}