<?php

class Illusion_Settings_Model_Catalog_Category extends Mage_Catalog_Model_Category {

    /**
     * @param bool $fullpath
     * @return bool|string
     */
    public function getThumbnailUrl($fullpath = false){

        $url = false;

        if ($image = $this->getThumbnail()) {

            if ($fullpath == true) {
                $url = Mage::getBaseUrl('media').'catalog/category/'.$image;
            } else {
                $url = $image;
            }
        }

        return $url;

    }
}