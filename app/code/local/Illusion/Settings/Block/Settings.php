<?php

class Illusion_Settings_Block_Settings extends Mage_Core_Block_Template{

    /**
     * Function which return config value for give string
     * @param $optionString
     * @return mixed
     */
    public function getBlockConfig($optionString){
        return $this->helper('illusion_settings')->getConfig($optionString);
    }

    /**
     * Return current url
     * @return string
     */
    public function getCurrentUrl(){
        return strtok(Mage::helper('core/url')->getCurrentUrl(), '?');
    }

    /**
     * Return true/false if category exists
     * @param $category
     * @return mixed
     */
    public function getAppearsInCategory($category){
        $currentCategory = Mage::registry('current_category');
        if(!$currentCategory){
            return;
        }

        $currentCategoryPath = $currentCategory->getPath();
        $currentCategoryList = explode('/', $currentCategoryPath);
        $exists = false;

        foreach($currentCategoryList as $currentCategoryItem){
            if($currentCategoryItem == $category->getId()){
                $exists = true;
            }
        }

        return $exists;
    }



}