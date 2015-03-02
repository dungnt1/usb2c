<?php

class Illusion_AcceptCookies_Block_AcceptCookies extends Mage_Core_Block_Template{

    public function getCookieName(){
        return Mage::getStoreConfig('cookies/config/cookiename');
    }

    public function getCookieLifeTime(){
        return Mage::getStoreConfig('cookies/config/cookielifetime');
    }

    public function isActivePopUp(){
        return Mage::getStoreConfig('cookies/config/isactive');
    }

    public function getTitleAC(){
        return Mage::getStoreConfig('cookies/config/title_ac');
    }

    public function getTitleRM(){
        return Mage::getStoreConfig('cookies/config/title_rm');
    }

    public function getText(){
        return Mage::getStoreConfig('cookies/config/message');
    }
}