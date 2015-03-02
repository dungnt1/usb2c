<?php

$content = '
<section class="page_title translucent_bg_red image_fixed t_align_c relative wrapper">
    <img src="{{skin url=\'images/page_404.jpg\'}}" alt="" class="page_404 d_xs_none">
    <h1 class="color_light fw_light m_bottom_12">Error 404 Page</h1>
    <!--breadcrumbs-->
    <p class="color_grey_light_3">This Page Could Not Be Found :(</p>
</section>
<!--content-->
<section class="section_offset">
    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-5 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 m_xs_bottom_30">
                <h5 class="fw_light color_dark m_bottom_20">Useful Links</h5>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                        <ul class="vr_list_type_4 color_dark fw_light">
                            <li class="m_bottom_12">
                                <a href="/" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    Home
                                </a>
                            </li>
                            <li class="m_bottom_12">
                                <a href="#" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    About Us
                                </a>
                            </li>
                            <li class="m_bottom_12">
                                <a href="#" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    Services
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
                        <ul class="vr_list_type_2 color_dark fw_light">
                            <li class="m_bottom_12">
                                <a href="#" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    Portfolio
                                </a>
                            </li>
                            <li class="m_bottom_12">
                                <a href="{{store url=\'blog\'}}" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    Blog
                                </a>
                            </li>
                            <li class="m_bottom_12">
                                <a href="{{store url=\'contacts\'}}" class="color_dark d_inline_b">
                                    <span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
                                        <i class="icon-angle-right"></i>
                                    </span>
                                    Contact
                                </a>
                            </li>
                        </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 m_xs_bottom_30">
                <h5 class="fw_light color_dark m_bottom_20">Search</h5>
                <p class="fw_light m_bottom_23">Please use our search form below: </p>
                <!--searchform-->
                <form method="get" action="{{store url="catalogsearch/result"}}" id="search_mini_form" class="relative type_2 f_left type_3 f_xs_none t_xs_align_l m_xs_bottom_15" role="search">
                    <input type="text" placeholder="Search" class="input-text r_corners fw_light bg_light w_full" value="" name="q" id="search" autocomplete="off">
                    <button type="submit" class="color_grey_light color_purple_hover tr_all">
                        <i class="icon-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
';

$block = Mage::getModel('cms/page');
$block->setTitle('Illusion 404 Page');
$block->setIdentifier('illusion_no_route');
$block->setRootTemplate('noroute');
$block->setStores(0);
$block->setIsActive(1);
$block->setContent($content);
$block->save();

