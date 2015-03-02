<?php

class Illusion_Settings_Block_Adminhtml_System_Config_Form_Fields_Preview extends Mage_Adminhtml_Block_System_Config_Form_Field{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){
        $id = $element->getHtmlId();
        $html = parent::_getElementHtml($element);
        $media = Mage::getBaseUrl('media');


        $html .= '<br/>
        <p class="note" ><span>Click to see <a target="_blank" id="item_preview_'.$id.'" href="'.$media.'">preview</a></span></p>

        <script>
        var previewModel'.$id.' = Class.create();

        previewModel'.$id.'.prototype = {
            initialize : function()
            {
                this.thisElement = $("'.$element->getHtmlId().'");
                this.previewElement = $("item_preview_'.$id.'");
                this.loadedFonts = "";

                this.refreshPreview();
                this.bindChange();
            },
            bindChange : function()
            {
                Event.observe(this.thisElement, "change", this.refreshPreview.bind(this));
                Event.observe(this.thisElement, "keyup", this.refreshPreview.bind(this));
                Event.observe(this.thisElement, "keydown", this.refreshPreview.bind(this));
            },
            refreshPreview : function()
            {
                var url = "'.$media.'illusion/settings/config/";
                $(this.previewElement).setAttribute(\'href\', url + this.thisElement.value + ".jpg");
            }

        }

        item_preview_'.$id.' = new previewModel'.$id.'();
        </script>
        ';

        return $html;
    }
}