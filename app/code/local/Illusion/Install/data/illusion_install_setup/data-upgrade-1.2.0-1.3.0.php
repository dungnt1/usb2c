<?php

$content = '
<ul class="hr_list stripe_list fs_small illusion_block_header_top_links">
    <li><a href="{{store url=\'blog\'}}">Blog</a></li>
    <li><a href="{{store url=\'contacts\'}}">Contact</a></li>
    <li><a href="{{store url=\'customer/account\'}}">My Account</a></li>
    <li><a href="{{store url=\'wishlist\'}}">My Wishlist</a></li>
</ul>
';

$block = Mage::getModel('cms/block');
$block->setTitle('Top Links');
$block->setIdentifier('illusion_header_top_links_block');
$block->setStores(0);
$block->setIsActive(1);
$block->setContent($content);
$block->save();

