<?php
class Illusion_Settings_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Get Config Options for Illusion Theme
     *
     * @param $optionString
     * @return mixed
     */
    public function getConfig($optionString){

        $store = Mage::app()->getStore();
        if($store){
            return Mage::getStoreConfig('illusion_settings/' . $optionString, $store);
        }else{
            return Mage::getStoreConfig('illusion_settings/' . $optionString);
        }

    }

    /**
     * Returns true, if color is specified and the value does not equal "transparent"
     *
     * @param string $color color code
     * @return bool
     */
    public function isColor($color){
        if ($color && $color != 'transparent')
            return true;
        else
            return false;
    }


    public function getCategories(){

        /** @var $helper Mage_Catalog_Helper_Category */
        $helper = Mage::helper('catalog/category');
        $categoriesCollection = $helper->getStoreCategories();

//        $obj = new Mage_Catalog_Block_Navigation();
//        $storeCategories = $obj->getStoreCategories();

        return $categoriesCollection;
    }

    /**
     * Get Magento default validation FE
     * @param $attribute
     * @return string
     */
    public function getValidation($attribute){
        $bValidator = '';
        $validateAttributeArray = explode(" ", Mage::helper('customer/address')->getAttributeValidationClass($attribute));
        foreach($validateAttributeArray as $validateAttribute){
            if($validateAttribute == 'required-entry'){
                $bValidator .= 'required';
            }
        }
        return $bValidator;
    }

    /**
     * @param $_product
     * @return New/Sale block for product
     */
    public function getNewSpecialBlock($_product){

        $html = '';

        if($_product){
            $specialPrice           = $_product->getSpecialPrice();
            $specialPriceFromDate   = $_product->getSpecialFromDate();
            $specialPriceToDate     = $_product->getSpecialToDate();
            $newsFromDate           = $_product->getNewsFromDate();
            $newsToDate             = $_product->getNewsToDate();
            $today                  = date("Y-m-d H:m:S");
            $isStock                = $_product->isAvailable();

            $html .= '<div class="labels_container">';
                if($newsFromDate && $newsToDate){
                    if($today >= $newsFromDate && $today <= $newsToDate){
                        $html .= '<block class="d_block label color_scheme new_color tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">'. $this->__("New").'</span></block>';
                    }
                }elseif($newsFromDate){
                    if($today >= $newsFromDate){
                        $html .= '<block class="d_block label color_scheme new_color tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">'. $this->__("New").'</span></block>';
                    }
                }
                if ($specialPrice){
                    if($today >= $specialPriceFromDate && $today <= $specialPriceToDate || $today >= $specialPriceFromDate && is_null($specialPriceToDate)){
                        $html .= '<block class="d_block label color_pink color_pink_hover sale_color tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">'. $this->__("Sale").'</span></block>';
                    }
                }
//                $html .= $_product->isSaleable() . ' - '.$isStock;
                if(!$isStock){
                    $html .= '<block class="d_block label color_pink color_pink_hover sold_color tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">'. $this->__("Sold").'</span></block>';
                }
            $html .= '</div>';
        }

        return $html;

    }

    public function getSpecialCounter($_product){
        $specialPrice           = $_product->getSpecialPrice();
        $specialPriceFromDate   = $_product->getSpecialFromDate();
        $specialPriceToDate     = $_product->getSpecialToDate();
        $today                  = date("Y-m-d H:m:S");
        $html = '';

        if ($specialPrice && $specialPriceToDate){
            if($today >= $specialPriceFromDate && $today <= $specialPriceToDate || $today >= $specialPriceFromDate && is_null($specialPriceToDate)){
                $strToTime = strtotime($specialPriceToDate);
                $day = date("j", $strToTime);
                $month = date("n", $strToTime) - 1;
                $year = date("Y", $strToTime);

                return array(
                    'year' => $year ? $year : '',
                    'month' => $month ? $month: '',
                    'day'   => $day ? $day: ''

                );
            }
        }

        return array();
    }

    /**
     * @param $_product
     * @param $image
     * @param $w
     * @param $h
     * @return Mage_Catalog_Helper_Image
     */
    public function getResize($_product, $image = null, $w, $h){
        if(!$image){
            return Mage::helper('catalog/image')->init($_product, 'image')->resize($w, $h)->setQuality(95);
        }else {
            return Mage::helper('catalog/image')->init($_product, 'image', $image)->resize($w, $h)->setQuality(95);
        }

    }
}