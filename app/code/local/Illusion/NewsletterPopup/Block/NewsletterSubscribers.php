<?php

class Illusion_NewsletterPopup_Block_NewsletterSubscribers extends Mage_Core_Block_Template{

    public function getCookieName(){
        return Mage::getStoreConfig('newsletterpopup/general/cookiename');
    }

    public function getCookieLifeTime(){
        return Mage::getStoreConfig('newsletterpopup/general/cookielifetime');
    }

    public function isActivePopUp(){
        return Mage::getStoreConfig('newsletterpopup/general/isactive');
    }

    public function getTheme(){
        return Mage::getStoreConfig('newsletterpopup/general/theme');
    }

    public function getTitle(){
        return Mage::getStoreConfig('newsletterpopup/general/title');
    }

    public function getText(){
        return Mage::getStoreConfig('newsletterpopup/general/message');
    }
}