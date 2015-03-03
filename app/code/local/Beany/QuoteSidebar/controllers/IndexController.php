<?php
class Beany_QuoteSidebar_IndexController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		echo 123; die(123);
		$params = $this->getRequest()->getParams();
		mail('vuquanghoang@hotmail.com', 'quick quote from usb2c', $params['name'] . ' quoted ' . $params['quantity'] . ' ' . ' of capacity ' . $params['capacity']);
	} 
}