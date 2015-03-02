<?php

/**
 * Class Illusion_Settings_SubscriberController
 */
class Illusion_Settings_SubscriberController extends Mage_Core_Controller_Front_Action {

    /**
     * Function for processing ajax request from newsletter (footer block)
     */
    public function subscribeAction(){
        $isAjax = (int)$this->getRequest()->isAjax();

        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $session            = Mage::getSingleton('core/session');
            $customerSession    = Mage::getSingleton('customer/session');
            $email              = (string) $this->getRequest()->getPost('email');

            try {
                if (!Zend_Validate::is($email, 'EmailAddress')) {
                    if($isAjax) {
                        $ret = array("type" => "error", "msg" => $this->__('Please enter a valid email address.'));
                    } else {
                        Mage::throwException($this->__('Please enter a valid email address.'));
                    }

                }

                if (Mage::getStoreConfig(Mage_Newsletter_Model_Subscriber::XML_PATH_ALLOW_GUEST_SUBSCRIBE_FLAG) != 1 &&
                    !$customerSession->isLoggedIn()) {
                    if($isAjax) {
                        $ret = array("type" => "error", "msg" => $this->__('Sorry, but administrator denied subscription for guests. Please register.', Mage::helper('customer')->getRegisterUrl()));
                    } else {
                        Mage::throwException($this->__('Sorry, but administrator denied subscription for guests. Please register.', Mage::helper('customer')->getRegisterUrl()));
                    }
                }

                $ownerId = Mage::getModel('customer/customer')
                    ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                    ->loadByEmail($email)
                    ->getId();
                if ($ownerId !== null && $ownerId != $customerSession->getId()) {
                    if($isAjax) {
                        $ret = array("type" => "error", "msg" => $this->__('This email address is already assigned to another user.'));
                    } else {
                        Mage::throwException($this->__('This email address is already assigned to another user.'));
                    }
                }

                $status = Mage::getModel('newsletter/subscriber')->subscribe($email);
                if ($status == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
                    if($isAjax) {
                        $ret = array("type" => "ok", "msg" => $this->__('Confirmation request has been sent.'));
                    } else {
                        $session->addSuccess($this->__('Confirmation request has been sent.'));
                    }
                } else {
                    if($isAjax) {
                        $ret = array("type" => "ok", "msg" => $this->__('Thank you for your subscription.'));
                    } else {
                        $session->addSuccess($this->__('Thank you for your subscription.'));
                    }
                }
            }
            catch (Mage_Core_Exception $e) {
                if($isAjax) {
                    $ret = array("type" => "error", "msg" => $this->__('There was a problem with the subscription: %s', $e->getMessage()));
                } else {
                    $session->addException($e, $this->__('There was a problem with the subscription: %s', $e->getMessage()));
                }
            }
            catch (Exception $e) {
                if($isAjax) {
                    $ret = array("type" => "error", "msg" => $this->__('There was a problem with the subscription.'));
                } else {
                    $session->addException($e, $this->__('There was a problem with the subscription.'));
                }
            }
        }

        // return or redirect
        if($isAjax) {
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($ret));
        } else {
            $this->_redirectReferer();
        }
    }
}