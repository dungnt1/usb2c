<?php
class Illusion_Settings_Block_Adminhtml_System_Config_Form_Fields_Fonts extends Mage_Adminhtml_Block_System_Config_Form_Field{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){

        $id = $element->getHtmlId();
        $html = parent::_getElementHtml($element);

        $html .= '<br/><div id="reviversettings_gfont_preview'.$id.'" style="font-size:20px; margin-top:10px;">This is your font style preview</div>
        <script>
        var googleFontPreviewModel'.$id.' = Class.create();

        googleFontPreviewModel'.$id.'.prototype = {
            initialize : function()
            {
                this.fontElement = $("'.$element->getHtmlId().'");
                this.previewElement = $("reviversettings_gfont_preview'.$id.'");
                this.loadedFonts = "";

                this.refreshPreview();
                this.bindFontChange();
            },
            bindFontChange : function()
            {
                Event.observe(this.fontElement, "change", this.refreshPreview.bind(this));
                Event.observe(this.fontElement, "keyup", this.refreshPreview.bind(this));
                Event.observe(this.fontElement, "keydown", this.refreshPreview.bind(this));
            },
            refreshPreview : function()
            {
                if ( this.loadedFonts.indexOf( this.fontElement.value ) > -1 ) {
                    this.updateFontFamily();
                    return;
                }

                var ss = document.createElement("link");
                ss.type = "text/css";
                ss.rel = "stylesheet";
                ss.href = "//fonts.googleapis.com/css?family=" + this.fontElement.value;
                document.getElementsByTagName("head")[0].appendChild(ss);

                this.updateFontFamily();

                this.loadedFonts += this.fontElement.value + ",";
            },
            updateFontFamily : function()
            {
                $(this.previewElement).setStyle({ fontFamily: this.fontElement.value });
            }
        }

        googleFontPreview'.$id.' = new googleFontPreviewModel'.$id.'();
        </script>
        ';
        return $html;
    }
}