<?php
class Illusion_AjaxLayeredNavigation_Helper_Data extends Mage_Core_Helper_Abstract {

    //delete white space
    public function trim($str) {
        $str = strip_tags($str);
        $str = str_replace('"', '', $str);
        return trim($str, " -");
    }

    public function getBaseUrlFilter() {
        $baseUrl = explode('?', Mage::helper('core/url')->getCurrentUrl());
        $baseUrl = $baseUrl[0];
        $baseUrl = trim($baseUrl);
        return $baseUrl;
    }

    public function FormatPrice($price) {
        return
            Mage::getModel('directory/currency')->formatTxt(
                $price,
                array('display' => Zend_Currency::NO_SYMBOL)
            );
    }

    public function prepareParams($params) {
        $url = "";
        foreach ($params as $key => $val) {
            if ($key == 'id') {
                continue;
            }
            if (strpos($key,'first')!== false) {
                continue;
            }
            if (strpos($key,'last')!== false) {
                continue;
            }
            if (strpos($key,'rate')!== false) {
                continue;
            }
            $url.='&'.$key.'='.$val;
        }
        return $url;
    }

    public function getStoreConfigField($field = null) {
        $fieldValue  = Mage::getStoreConfig('illusion_ajaxlayerednavigation/config/'.$field);
        if($fieldValue)
            return $fieldValue;
        return false;
    }

    public function getJsRemoveItem() {
        $js = ' <script type ="text/javascript">
                jQuery(function() {
                    //remove Item
                        jQuery(".block-layered-nav .btn-remove").each(function(){
                            var urlRemove = jQuery(this).attr("href");
                            jQuery(this).attr("link",urlRemove);
                            jQuery(this).bind("click",function(){
                                jQuery(this).attr("onclick",ajaxLayeredNavigation(urlRemove));
                                return false;
                            });
                        });
                     //remove all item
                    jQuery(".block-layered-nav .actions a").each(function(){
                        var linkRemoveAll = jQuery(this).attr("href");
                        jQuery( this ).attr("link",linkRemoveAll);
                        jQuery(this).bind("click",function(){
                            jQuery(this).attr("onclick",ajaxLayeredNavigation(linkRemoveAll));
                            return false;
                        });
                    });
                });
            </script>
            <div id ="wrapper">
                <div id="loading" style ="position: fixed;top: 50%;left: 50%;"></div>
            </div>
            ';
        return $js;
    }

    public function getToolbarForTagProductJs() {
        $js = '<script type ="text/javascript">
              jQuery(".tags-list a").each(function(){
                        var TagUrl = jQuery(this).attr("href");
                        jQuery( this ).attr("link",TagUrl);
                        jQuery(this).bind("click",function(){
                            jQuery(this).attr("onclick",ajaxLayeredNavigation(TagUrl));
                            return false;
                        });
              });
              //view mode product
                    jQuery(".view-mode a").each(function(){
                        var viewModeUrl = jQuery(this).attr("href");
                        jQuery( this ).attr("link",viewModeUrl);
                        jQuery(this).bind("click",function(){
                            jQuery(this).attr("onclick",ajaxLayeredNavigation(viewModeUrl));
                            return false;
                        });
                    });

                    //sort by
                    jQuery(".sort-by select").removeAttr("onchange");
                    jQuery(".sort-by select").live("change",function(){
                        var selectUrl = jQuery(".sorter select").val();
                        ajaxLayeredNavigation(selectUrl);
                        return false;
                    });
                    //demention sort by

                    jQuery(".sort-by a").each(function(){
                        var dementionUrl = jQuery(this).attr("href");
                        jQuery( this ).attr("link",dementionUrl);
                        jQuery(this).bind("click",function(){
                            jQuery(this).attr("onclick",ajaxLayeredNavigation(dementionUrl));
                            return false;
                        });
                    });
                    //show per page
                    jQuery(".limiter select").removeAttr("onchange");
                    jQuery(".limiter select").live("change",function(){
                        var perUrl = jQuery(this).val();
                        ajaxLayeredNavigation(perUrl);
                        return false;
                    });

                    //pagination page
                    jQuery(".pages a").each(function(){
                        var href = jQuery(this).attr("href");
                        jQuery( this ).attr("link",href);
                        jQuery(this).bind("click",function(){
                            jQuery(this).attr("onclick",ajaxLayeredNavigation(href));
                            return false;
                        });
                    });

        </script>';
        return $js;
    }

    //check if is ajax request
    public function isAjax() {
        return (boolean) ((isset($_SERVER['HTTP_X_REQUESTED_WITH'])) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
}