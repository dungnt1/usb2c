<?php

class Illusion_NewsletterPopup_Model_Subscriber extends Mage_Newsletter_Model_Subscriber{

    public function getCouponCode(){
        if (!Mage::getStoreConfig('newsletterpopup/coupon/isactive')) return '';

        $model = Mage::getModel('salesrule/rule');
        $model->load(Mage::getStoreConfig('newsletterpopup/coupon/roleid'));
        $massGenerator = $model->getCouponMassGenerator();
        $massGenerator->setData(array(
            'rule_id' => Mage::getStoreConfig('newsletterpopup/coupon/roleid'),
            'qty' => 1,
            'length'    => Mage::getStoreConfig('newsletterpopup/coupon/length'),
            'format'    => Mage::getStoreConfig('newsletterpopup/coupon/format'),
            'prefix'    => Mage::getStoreConfig('newsletterpopup/coupon/prefix'),
            'suffix'    => Mage::getStoreConfig('newsletterpopup/coupon/suffix'),
            'dash'      => Mage::getStoreConfig('newsletterpopup/coupon/dash'),
            'uses_per_coupon' => 1,
            'uses_per_customer' => 1
        ));
        $massGenerator->generatePool();
        $generated = $massGenerator->getGeneratedCount();
        $latestCoupon = max($model->getCoupons());
        $couponData = $latestCoupon->getData();
        if ($generated != 1)
            Mage::throwException($this->__('There was a problem with coupon generation.'));

        return $couponData['code'];
    }
}