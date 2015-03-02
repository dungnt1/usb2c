<?php

/**
 * Class Illusion_Settings_IndexController
 */
require_once 'Mage/Contacts/controllers/IndexController.php';
class Illusion_Settings_IndexController extends Mage_Contacts_IndexController {

    /**
     * Function for processing ajax requests from contact form (footer block)
     */
    public function ajaxAction(){

        $name = $email = $comment = '';
        $isAjax = (int)$this->getRequest()->isAjax();

        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('data')) {
            $session            = Mage::getSingleton('core/session');
            $customerSession    = Mage::getSingleton('customer/session');

            $postData = $this->getRequest()->getPost('data');
            parse_str($postData, $post);


            if ( $post ) {
                $translate = Mage::getSingleton('core/translate');
                $translate->setTranslateInline(false);

                try {
                    $postObject = new Varien_Object();
                    $postObject->setData($post);

                    $error = false;

                    $ret = '';

                    if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                        $ret = array("type" => "error", "msg" => $this->__('Name is required field.'));
                    }

                    if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                        $ret = array("type" => "error", "msg" => $this->__('Comment is required field.'));
                    }

                    if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                        $ret = array("type" => "error", "msg" => $this->__('Email is required field.'));
                    }

                    if(empty($ret)){
                        $mailTemplate = Mage::getModel('core/email_template');
                        /* @var $mailTemplate Mage_Core_Model_Email_Template */
                        $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                            ->setReplyTo($post['email'])
                            ->sendTransactional(
                                Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                                Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                                Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                                null,
                                array('data' => $postObject)
                            );

                        if (!$mailTemplate->getSentSuccess()) {
                            throw new Exception();
                        }

                        $translate->setTranslateInline(true);
                        $ret = array("type" => "ok", "msg" => $this->__('Your message has been sent successfully!'));
                    }

                } catch (Exception $e) {
                    $translate->setTranslateInline(true);
                    $ret = array("type" => "error", "msg" => $this->__('Unable to submit your request. Please, try again later'));
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($ret));


        }
    }
}