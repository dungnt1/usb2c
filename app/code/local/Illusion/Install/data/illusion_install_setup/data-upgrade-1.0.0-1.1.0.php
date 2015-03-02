<?php

$content = '
<ul class="vr_list_type_4 color_dark fw_light w_break">
    <li class="m_bottom_12">
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Order tracking
        </a>
    </li>
    <li class="m_bottom_12">
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Privacy policy
        </a>
    </li>
    <li class="m_bottom_12">
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Gift cards
        </a>
    </li>
    <li class="m_bottom_12">
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Shipping Info
        </a>
    </li>
    <li class="m_bottom_12">
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Returns &amp; refunds
        </a>
    </li>
    <li>
        <a href="#" class="color_dark d_inline_b">
            <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                <i class="icon-angle-right"></i>
            </span>
            Delivery info
        </a>
    </li>
</ul>
';

$block = Mage::getModel('cms/block');
$block->setTitle('Information');
$block->setIdentifier('illusion_information_block');
$block->setStores(0);
$block->setIsActive(1);
$block->setContent($content);
$block->save();

