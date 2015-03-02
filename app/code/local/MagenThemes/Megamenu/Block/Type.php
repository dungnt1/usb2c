<?php
/******************************************************
 * @author http://www.9magentothemes.com
 * @copyright (C) 2012- 9MagentoThemes.Com
 * @license PHP files are GNU/GPL
 *******************************************************/
?>
<?php
class MagenThemes_Megamenu_Block_Type extends Mage_Core_Block_Template
{
    protected $_hasContent = true;
    protected $_hasLink = true;
    protected $_type = null;
    protected $_menu = null;
    protected $_level = 0;
    protected $_routeName = null;
    protected $_paramName = null;

    public function setMenu($menu, $level=0) {
        $this->_menu = $menu;
        $this->_level = $level;
        return $this;
    }

    public function hasContent() {
        if($this->_hasContent == true) {
            return true;
        }
        return false;
    }

    public function hasLink() {
        if($this->_hasLink == true) {
            return true;
        }
        return false;
    }

    public function getContentType() {
        if($this->hasContent()) {
            return $this->getLayout()->createBlock('cms/block')->setBlockId($this->_menu->getArticle())->toHtml();
        }
        return null;
    }

    public function getWidgetType() {
        if($this->hasContent()) {
            $widget = Mage::getModel('widget/widget_instance')->load($this->_menu->getArticle());
            $pg = $widget->getPageGroups();
            return $this->getLayout()->createBlock($widget->getType())
                ->setTemplate($pg[0]['page_template'])
                ->setData($widget->getWidgetParameters())
                ->setPageId(2)
                ->toHtml();
        }
        return null;
    }

    public function getObjectType() {
        return $this->getLayout()->getBlock('megamenu.nav')->getType($this->_type);
    }

    public function getModelOfType() {
        return $this->getObjectType()->getModel();
    }

    public function getUrlType() {
        return Mage::getModel($this->getModelOfType())->load($this->_menu->getArticle())->getUrl();
    }

    public function getCategorySummary() {
        return Mage::getModel($this->getModelOfType())->load($this->_menu->getArticle(), array('summary'))->getSummary();
    }

    private function _getObjectType($type) {
        return $this->getLayout()->getBlock('megamenu.nav')->getType($type);
    }

    public function activeMenu($param) {
        if($this->_routeName == null) {
            return false;
        }

        if($this->getRequest()->getRouteName() == $this->_routeName) {
            if($this->_paramName == null) {
                return false;
            }

            if($this->getRequest()->getParam($this->_paramName) == $param) {
                return true;
            }
        }
        return false;
    }

    public function drawItem()
    {
        $html = '';
        if($this->_type == null) {
            return $html;
        }

        if(!$this->_menu instanceof MagenThemes_Megamenu_Model_Megamenu) {
            return $html;
        }

        if($this->_menu->getStatus() == MagenThemes_Megamenu_Model_Status::STATUS_DISABLED) {
            return $html;
        }

        if($this->_level == 0) {
            $html .= '<li class="root ';
            if($this->activeMenu($this->_menu->getArticle()))
                $html .= 'active ';
            if($this->_menu->hasChild(true))
                $html .= 'parent';
            $html .= '" ';
        } else {
            if($this->_menu->isGroup()) {
                $html .= '<li class="group ';
                if($this->activeMenu($this->_menu->getArticle()))
                    $html .= 'active ';
                $html .= '" ';
            } else {
                $html .= '<li ';
                if($this->activeMenu($this->_menu->getArticle())) {
                    $html .= 'class="active" ';
                }
            }
        }
        if($this->_menu->hasChild(true)) {
            if(!$this->_menu->isGroup() && $this->_level != 0) {
                $html .= 'onmouseover="megamenu.showSubMegamenu(this, 1);" onmouseout="megamenu.showSubMegamenu(this, 0);" class="parent"';
            }
        }
        $html .= '>';
        if($this->_menu->getType() == 'external_link') {
            $html .= '<a class="megamenu-title" ';
            if($this->_menu->getUrl())
                $html .= 'href="'.$this->_menu->getUrl().'" ';
            if($this->_menu->getNofollow() == 1) {
                $html .= 'rel="nofollow"';
            }
            $html .= '>';
            if($this->_menu->getImage())
                $html .= '<img alt="'.$this->_menu->getTitle().'" src="'.Mage::getBaseUrl('media').$this->_menu->getImage().'" width="13" height="13" class="icon-megamenu" />';
            else
                if($this->_level != 0)
                    $html .= '<span class="no-icon-megamenu"></span>';
            $html .= '<span>'.$this->_menu->getTitle();
            if($this->_menu->getLabel()){
                $label = $this->_menu->getLabel() == 'label1' ? $this->__('New') : $this->__('Hot!');
                $html .= '<span class="menu-label '.$this->_menu->getLabel().' pin-bottom">'.$label.'</span>';
            }
            $html .='</span></a>';
        } else {
            if($this->_menu->showTitle()) {
                $html .= '<a href="'.$this->getUrlType().'" class="megamenu-title" ';
                if($this->_menu->getNofollow() == 1) {
                    $html .= 'rel="nofollow" ';
                }
                if(!$this->hasLink())
                    $html .= 'onclick="return false;"';
                $html .= '>';
                if($this->_menu->getImage())
                    $html .= '<img alt="'.$this->_menu->getTitle().'" src="'.Mage::getBaseUrl('media').$this->_menu->getImage().'" width="13" height="13" class="icon-megamenu" />';
                else
                    if($this->_level != 0)
                        $html .= '<span class="no-icon-megamenu"></span>';
                $html .= '<span>'.$this->_menu->getTitle().'';
                if($this->_menu->getLabel()){
                    $label = $this->_menu->getLabel() == 'label1' ? $this->__('New') : $this->__('Hot!');
                    $html .= '<span class="menu-label '.$this->_menu->getLabel().' pin-bottom">'.$label.'</span>';
                }
                $html .='</span>';
                if($this->_level == 0) {
                    if($this->_menu->hasChild(true)){
                        $html .= '<i class="icon-angle-down pf_left_5"></i>';
                    }
                }
                $html .='</a>';
            }
            if($this->_menu->isContent()){
                if($this->_menu->getType() == 'widget'){
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($this->_menu->getType())->getBlock())
                        ->setMenu($this->_menu, $this->_level+1)
                        ->getWidgetType();
                }else{
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($this->_menu->getType())->getBlock())
                        ->setMenu($this->_menu, $this->_level+1)
                        ->getContentType();
                }
            }
        }
        if($this->_menu->hasChild(true) && $this->_menu->showSub()) {
            if($this->_level != 0 && !$this->_menu->isGroup()) {
                $html .= '<div class="sub-megamenu" ';
            } else {
                $html .= '<div class="childcontent" ';
            }

            if($this->_menu->getWidth()) {
                $html .= 'style="width:'.$this->_menu->getWidth().'px;"';
            }

            $html .= '>';

            $colPositions = array();
            if($this->_menu->getSubitemWidth()) {
                $colPositions = Mage::helper('megamenu')->getColpositions($this->_menu->getSubitemWidth());
            }

            if(count($colPositions)) {
                foreach($colPositions as $col => $width) {
                    $html .= '<ul class="'.$col.'" style="width:'.$width.'px">';
                    $childItemsWidthCol = $this->_menu->getChildItem($col);
                    foreach($childItemsWidthCol as $childItem) {
                        $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                            ->setMenu($childItem, $this->_level+1)
                            ->drawItem();
                    }
                    $html .= '</ul>';
                }
            } else {
                $html .= '<ul style="width:'.$this->_menu->getWidth().'px">';
                $childItemsWidthCol = $this->_menu->getChildItem();
                foreach($childItemsWidthCol as $childItem) {
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                        ->setMenu($childItem, $this->_level+1)
                        ->drawItem();
                }
                $html .= '</ul>';
            }

            $html .= '</div>';
        }
        $html .= '</li>';
        return $html;
    }

    public function drawItemLink()
    {
        $notCurrent = 'd_none';
        $html = '';
        if($this->_type == null) {
            return $html;
        }

        if(!$this->_menu instanceof MagenThemes_Megamenu_Model_Megamenu) {
            return $html;
        }

        if($this->_menu->getStatus() == MagenThemes_Megamenu_Model_Status::STATUS_DISABLED) {
            return $html;
        }


        if($this->_level == 0) {
            $html .= '<li class="m_bottom_10 sidelink';
            if($this->activeMenu($this->_menu->getArticle())){
                $notCurrent = '';
                $html .= ' active current ';
            }
            if($this->_menu->hasChild(true))
                $html .=  ' has_sub_menu ';
            $html .= '" ';
        } else {
            if($this->_menu->isGroup()) {
                $html .= '<li class="m_bottom_10 sidelink';
                if($this->activeMenu($this->_menu->getArticle())){
                    $html .= ' active current ';
                }
                if($this->_menu->hasChild(true))
                    $html .=  ' has_sub_menu';
                $html .= '" ';
            } else {
                $html .= '<li ';
                if($this->activeMenu($this->_menu->getArticle())) {
                    $html .= 'class="active current" ';
                }
            }
        }
        if($this->_menu->hasChild(true)) {
            if(!$this->_menu->isGroup() && $this->_level != 0) {
                $html .= 'onmouseover="megamenu.showSubMegamenu(this, 1);" onmouseout="megamenu.showSubMegamenu(this, 0);" class="parent"';
            }
        }
        $html .= '>';
        if($this->_menu->getType() == 'external_link') {
            $html .= '<a class="d_block relative fs_large color_light_2 color_blue_hover side_menu_text_color" ';
            if($this->_menu->getUrl())
                $html .= 'href="'.$this->_menu->getUrl().'" ';
            if($this->_menu->getNofollow() == 1) {
                $html .= 'rel="nofollow"';
            }
            $html .= '>';
            if($this->_menu->getImage())
                $html .= '';
            else
                if($this->_level != 0)
                    $html .= '<span class="no-icon-megamenu"></span>';
            $html .= '<span>'.$this->_menu->getTitle();
            if($this->_menu->getLabel()){
                $label = $this->_menu->getLabel() == 'label1' ? $this->__('New') : $this->__('Hot!');
                $html .= '<span class="menu-label '.$this->_menu->getLabel().' pin-bottom">'.$label.'</span>';
            }
            $html .='</span></a>';
        } else {
            if($this->_menu->showTitle()) {
                $html .= '<a href="'.$this->getUrlType().'" class="d_block relative fs_large color_light_2 color_blue_hover side_menu_text_color" ';
                if($this->_menu->getNofollow() == 1) {
                    $html .= 'rel="nofollow" ';
                }
                if(!$this->hasLink())
                    $html .= 'onclick="return false;"';
                $html .= '>';
                if($this->_menu->getImage())
                    $html .= '';
                else
                    if($this->_level != 0)
                        $html .= '<span class="no-icon-megamenu"></span>';
                $html .= '<span>'.$this->_menu->getTitle().'';
                if($this->_menu->getLabel()){
                    $label = $this->_menu->getLabel() == 'label1' ? $this->__('New') : $this->__('Hot!');
                    $html .= '<span class="menu-label '.$this->_menu->getLabel().' pin-bottom">'.$label.'</span>';
                }
                $html .='</span>';
//                if($this->_level == 0) {
//                    if($this->_menu->hasChild(true)){
//                        $html .= '<i class="icon-angle-down pf_left_5"></i>';
//                    }
//                }
                $html .='</a>';
            }
            if($this->_menu->isContent()){
                if($this->_menu->getType() == 'widget'){
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($this->_menu->getType())->getBlock())
                        ->setMenu($this->_menu, $this->_level+1)
                        ->getWidgetType();
                }else{
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($this->_menu->getType())->getBlock())
                        ->setMenu($this->_menu, $this->_level+1)
                        ->getContentType();
                }
            }
        }
        if($this->_menu->hasChild(true) && $this->_menu->showSub()) {
//            if($this->_level != 0 && !$this->_menu->isGroup()) {
//                $html .= '<div class="sub-megamenu" ';
//            } else {
//                $html .= '<div class="childcontent" ';
//            }
//
//            if($this->_menu->getWidth()) {
//                $html .= 'style="width:'.$this->_menu->getWidth().'px;"';
//            }
//
//            $html .= '>';

            $colPositions = array();
            if($this->_menu->getSubitemWidth()) {
                $colPositions = Mage::helper('megamenu')->getColpositions($this->_menu->getSubitemWidth());
            }

            if(count($colPositions)) {
                $html .= '<ul class="'.$notCurrent.'  m_top_10">';
                foreach($colPositions as $col => $width) {
                    $childItemsWidthCol = $this->_menu->getChildItem($col);
                    foreach($childItemsWidthCol as $childItem) {
                        $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                            ->setMenu($childItem, $this->_level+1)
                            ->drawItemLink();
                    }

                }
                $html .= '</ul>';
            } else {
                $html .= '<ul class="'.$notCurrent.'  m_top_10">';
                $childItemsWidthCol = $this->_menu->getChildItem();
                foreach($childItemsWidthCol as $childItem) {
                    $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                        ->setMenu($childItem, $this->_level+1)
                        ->drawItemLink();
                }
                $html .= '</ul>';
            }

//            $html .= '</div>';
        }
        $html .= '</li>';
        return $html;
    }

    public function drawDrillItem()
    {
        $html = '';
        if($this->_type == null) {
            return $html;
        }

        if(!$this->_menu instanceof MagenThemes_Megamenu_Model_Megamenu) {
            return $html;
        }

        if($this->_menu->getStatus() == MagenThemes_Megamenu_Model_Status::STATUS_DISABLED) {
            return $html;
        }

        if($this->_level == 0) {
            $html .= '<li class="item ';
            if($this->activeMenu($this->_menu->getArticle()))
                $html .= 'active ';
            if($this->_menu->hasChild(true))
                $html .= 'hasChild';
            $html .= '" ';
        } else {
            if($this->_menu->isGroup()) {
                $html .= '<li class="group ';
                if($this->activeMenu($this->_menu->getArticle()))
                    $html .= 'active ';
                $html .= '" ';
            } else {
                $html .= '<li ';
                if($this->activeMenu($this->_menu->getArticle())) {
                    $html .= 'class="active" ';
                }
            }
        }
        $html .= '>';
        if($this->_menu->getType() == 'external_link') {
            $html .= '<a class="megamenu-title" ';
            if($this->_menu->getUrl())
                $html .= 'href="'.$this->_menu->getUrl().'" ';
            if($this->_menu->getNofollow() == 1) {
                $html .= 'rel="nofollow"';
            }
            $html .= '>';
            if($this->_menu->getImage())
                $html .= '<img alt="'.$this->_menu->getTitle().'" src="'.Mage::getBaseUrl('media').$this->_menu->getImage().'" width="13" height="13" class="icon-megamenu" />';

            $html .= $this->_menu->getTitle().'</a>';
        } else {
            if($this->_menu->showTitle() && $this->_menu->getType()!='static_block') {
                $html .= '<a href="'.$this->getUrlType().'" class="megamenu-title" ';
                if($this->_menu->getNofollow() == 1) {
                    $html .= 'rel="nofollow" ';
                }
                if(!$this->hasLink())
                    $html .= 'onclick="return false;"';
                $html .= '>';
                if($this->_menu->getImage())
                    $html .= '<img alt="'.$this->_menu->getTitle().'" src="'.Mage::getBaseUrl('media').$this->_menu->getImage().'" width="13" height="13" class="icon-megamenu" />';

                $html .= $this->_menu->getTitle();
                if($this->_menu->getLabel()){
                    $label = $this->_menu->getLabel() == 'label1' ? $this->__('New') : $this->__('Hot!');
                    $html .= '<label class="menu-label '.$this->_menu->getLabel().' pin-bottom">'.$label.'</label>';
                }
                $html .='</a>';
            }

        }
        if($this->_menu->hasChild(true) && $this->_menu->showSub()) {
            if($this->_level != 0 && !$this->_menu->isGroup()) {
                $html .= '<div class="childcontent" ';
            } else {
                $html .= '<div class="childcontent" ';
            }
            $html .= '>';

            $colPositions = array();
            if($this->_menu->getSubitemWidth()) {
                $colPositions = Mage::helper('megamenu')->getColpositions($this->_menu->getSubitemWidth());
            }

            if(count($colPositions)) {
                foreach($colPositions as $col => $width) {
                    $html .= '<ul class="'.$col.'">';
                    $childItemsWidthCol = $this->_menu->getChildItem($col);
                    foreach($childItemsWidthCol as $childItem) {
                        if($childItem->getType() != 'widget'){
                            $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                                ->setMenu($childItem, $this->_level+1)
                                ->drawDrillItem();
                        }
                    }
                    $html .= '</ul>';
                }
            } else {
                $html .= '<ul>';
                $childItemsWidthCol = $this->_menu->getChildItem();
                foreach($childItemsWidthCol as $childItem) {
                    if($childItem->getType() != 'widget'){
                        $html .= $this->getLayout()->createBlock($this->_getObjectType($childItem->getType())->getBlock())
                            ->setMenu($childItem, $this->_level+1)
                            ->drawDrillItem();
                    }
                }
                $html .= '</ul>';
            }

            $html .= '</div>';
        }
        $html .= '</li>';
        return $html;
    }
}