<?php
$content = '
<ul class="hr_list d_inline_b">
<li class="m_right_5 m_sm_bottom_5"><img src="{{skin url=\'images/payment_1.png\'}}" alt=""/></li>
<li class="m_right_5 m_sm_bottom_5"><img src="{{skin url=\'images/payment_2.png\'}}" alt=""/></li>
<li class="m_right_5 m_sm_bottom_5"><img src="{{skin url=\'images/payment_3.png\'}}" alt=""/></li>
<li class="m_right_5 m_sm_bottom_5"><img src="{{skin url=\'images/payment_4.png\'}}" alt=""/></li>
<li class="m_right_5 m_sm_bottom_5"><img src="{{skin url=\'images/payment_5.png\'}}" alt=""/></li>
</ul>
';

$block = Mage::getModel('cms/block');
$block->setTitle('Credit Cards');
$block->setIdentifier('illusion_credit_card_footer_block');
$block->setStores(0);
$block->setIsActive(1);
$block->setContent($content);
$block->save();