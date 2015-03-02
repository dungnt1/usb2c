<?php

$content = '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia. Suspendisse sollicitudin velit sed leo</p>';

$stores = Mage::getModel('core/store')->getCollection()->addFieldToFilter('store_id', array('gt'=>0))->getAllIds();

$block = Mage::getModel('cms/block');
$block->setTitle('Shortly About Us');
$block->setIdentifier('illusion_about_us_block');
$block->setStores(0);
$block->setIsActive(1);
$block->setContent($content);
$block->save();
