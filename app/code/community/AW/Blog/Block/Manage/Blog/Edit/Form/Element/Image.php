<?php

class AW_Blog_Block_Manage_Blog_Edit_Form_Element_Image extends Varien_Data_Form_Element_Abstract
{
    public function __construct($data)
    {
        parent::__construct($data);
        $this->setType('hidden');
    }

    public function getElementHtml()    {
        $html = '';
        $media_url  = Mage::getBaseUrl('media');
        $upload_folder_path = str_replace("/",DS, Mage::getBaseDir("media").DS.'blog'.DS);


        if ($this->getValue()) {

            $img_path = $upload_folder_path.$this->getValue();
            if (file_exists($img_path)) {
                $img_src = $media_url.'blog/'.$this->getValue();
                $html .= '<img src="'.$img_src.'"/>';
            }

        }
        $html.= parent::getElementHtml();


        return $html;
    }
}