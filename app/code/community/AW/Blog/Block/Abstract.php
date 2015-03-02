<?php

abstract class AW_Blog_Block_Abstract extends Mage_Core_Block_Template
{
    const LINK_TYPE_FOOTER = 'footer';

    const LINK_TYPE_HEADER = 'top';

    protected static $_helper;

    protected static $_collection;

    protected static $_catUriParam = AW_Blog_Helper_Data::CATEGORY_URI_PARAM;

    protected static $_postUriParam = AW_Blog_Helper_Data::POST_URI_PARAM;

    protected static $_tagUriParam = AW_Blog_Helper_Data::TAG_URI_PARAM;

    protected function _construct()
    {
        if (!self::$_helper) {
            self::$_helper = Mage::helper('blog');
        }
        if (!self::$_collection) {
            self::$_collection = $this->_prepareCollection();
        }
    }

    protected function _processCollection($collection, $category = false)
    {
        /* add category to url */
        $categoryUrl = self::$_helper->isCategoryUrl();
        /* use short content for posts */
        $shortContent = self::$_helper->useShortContent();
        /* readMoreCount */
        $readMoreCount = (int)self::$_helper->readMoreCount();
        /* cache (run-time) all categories related to products */
        $this->_prepareRelatedCategories($collection);

        foreach ($collection as $item) {

            $this->_prepareData($item)->_prepareDates($item);
            /* prepare urls depnding on mode */
            if ($category && $categoryUrl) {
                $item->setAddress(
                    $this->getBlogUrl(
                        null,
                        array(
                             self::$_catUriParam  => $category->getIdentifier(),
                             self::$_postUriParam => $item->getIdentifier()
                        )
                    )
                );
            } else {
                $item->setAddress($this->getBlogUrl($item->getIdentifier()));
            }
            /* prepare short content fields */
            if ($shortContent) {
                if ($item->getShortContent()) {
                    $item->setPostContent($item->getShortContent() . $this->_getReadMoreLink($item));
                }
            } elseif ($readMoreCount) {
                $strManager = new AW_Blog_Helper_Substring(
                    array(
                         'input' => self::$_helper->filterWYS($item->getPostContent())
                    )
                );
                $content = $strManager->getHtmlSubstr($readMoreCount);
                if ($strManager->getSymbolsCount() == $readMoreCount) {
                    $content .= $this->_getReadMoreLink($item);
                }
                $item->setPostContent($content);
            }
            /* add categories the item is related to */
            $this->_addCategories($item);
        }

        return $collection;
    }

    public function getBookmarkHtml($post)
    {
        if (self::$_helper->conf(AW_Blog_Helper_Data::XML_BOOKMARKS)) {
            return $this->setTemplate('aw_blog/bookmark.phtml')->setPost($post)->renderView();
        }
    }

    public function getTagsHtml($post)
    {
        if (trim($post->getTags())) {
            return $this->setTemplate('aw_blog/line_tags.phtml')->setPost($post)->renderView();
        }
    }

    public function getTagsInPostHtml($post){
        if (trim($post->getTags())) {
            return $this->setTemplate('aw_blog/line_tags_in_post.phtml')->setPost($post)->renderView();
        }
    }

    public function getCrumbs()
    {
        if (self::$_helper->isCrumbs()) {
            $crumbs = $this->getLayout()->getBlock('breadcrumbs');
            if ($crumbs) {
                return $crumbs->addCrumb(
                    'home',
                    array(
                        'label' => $this->__('Home'),
                        'title' => $this->__('Go to Home Page'),
                        'link'  => Mage::getBaseUrl(),
                    )
                );
            }
        }
        return false;
    }

    public function getBlogUrl($route = null, $params = array())
    {
        $blogRoute = self::$_helper->getRoute();
        if (is_array($route)) {
            foreach ($route as $item) {
                $item = urlencode($item);
                $blogRoute .= "/{$item}";
            }
        } else {
            $blogRoute .= "/{$route}";
        }

        foreach ($params as $key => $value) {
            $value = urlencode($value);
            $blogRoute .= "{$key}/{$value}/";
        }

        return $this->getUrl($blogRoute);
    }

    public function getCommentsEnabled()
    {
        return self::$_helper->commentsEnabled();
    }

    protected function _beforeToHtml()
    {
        $this->_helper('blog/toolbar')->create(
            $this,
            array(
                'orders'        => array('created_time' => $this->__('Created At'), 'user' => $this->__('Added By')),
                'default_order' => 'created_time',
                'dir'           => 'desc',
                'limits'        => self::$_helper->postsPerPage(),
            )
        );

        return parent::_beforeToHtml();
    }

    protected function _toHtml()
    {
        if (self::$_helper->getEnabled()) {
            return self::$_helper->filterWYS(parent::_toHtml());
        }
    }

    protected function _prepareMetaData($meta)
    {
        if (is_object($meta)) {
            $head = $this->getLayout()->getBlock('head');
            if ($head) {
                $head->setTitle($meta->getTitle());
                $head->setKeywords($meta->getMetaKeywords());
                $head->setDescription($meta->getMetaDescription());
            }
        }
    }

    protected function _getReadMoreLink($item)
    {
        return '<p class="m_top_15 d_block"><a class="blog_read_more color_purple d_inline_b color_pink_hover d_block m_right_20 fw_light" href="' . $item->getAddress() . '"><span class="d_inline_m m_right_5 icon_wrap_size_0 circle color_grey_light_5 tr_all"><i class="icon-angle-right"></i></span>' . $this->__('Read More') . '</a></p>';
    }

    public function getPreparedCollection()
    {
        return $this->_prepareCollection();
    }

    public function addBlogLink($type)
    {
        if (self::$_helper->isEnabled()) {
            $title = self::$_helper->isTitle();
            if ($this->getParentBlock()) {
                if ($type == self::LINK_TYPE_HEADER) {
                    $this->getParentBlock()->addLink($title, self::$_helper->getRoute(), $title, true);
                } else {
                    $this->getParentBlock()->addLink(
                        $title, self::$_helper->getRoute(), $title, true, array(), 15, null, 'class="top-link-blog"'
                    );
                }
            }
        }
    }

    protected function _prepareDates($item)
    {
        $dateFormat = self::$_helper->getDateFormat();
        $item->setCreatedTime($this->formatTime($item->getCreatedTime(), $dateFormat, true));
        $item->setUpdateTime($this->formatTime($item->getUpdateTime(), $dateFormat, true));

        return $this;
    }

    protected function _prepareData($item)
    {
        $item->setTitle(htmlspecialchars($item->getTitle()));
        $item->setShortContent(trim($item->getShortContent()));

        return $this;
    }

    protected function _helper($type = 'blog')
    {
        return Mage::helper($type);
    }

    protected function _prepareRelatedCategories($collection)
    {
        $posts = array();
        foreach ($collection as $item) {
            $posts[] = $item->getId();
        }

        $categories = Mage::getModel('blog/post')->getCategoriesForPosts($posts);

        foreach ($categories as &$category) {
            $category['posts'] = explode(',', $category['posts']);
            $category['data'] = array(
                'title' => $category['title'],
                'url'   => $this->getBlogUrl(null, array(self::$_catUriParam => $category['identifier']))
            );
        }

        $this->setAllRelatedCategories($categories);
    }

    protected function _addCategories($item)
    {
        $categoriesData = array();
        foreach ($this->getAllRelatedCategories() as $catsScope) {
            if (is_array($catsScope['posts'])) {
                if (in_array($item->getId(), $catsScope['posts'])) {
                    $categoriesData[] = $catsScope['data'];
                }
            }
        }

        $item->setCats($categoriesData);
    }

    public function isBlogPage()
    {
        return Mage::app()->getRequest()->getModuleName() == AW_Blog_Helper_Data::DEFAULT_ROOT;
    }

    protected function _prepareCollection()
    {
        if (!$this->getData('cached_collection')) {

            $collection = Mage::getModel('blog/blog')->getCollection()
                ->addPresentFilter()
                ->addEnableFilter(AW_Blog_Model_Status::STATUS_ENABLED)
                ->addStoreFilter()
                ->joinComments()
                ->setOrder('created_time', 'desc');

            $collection->setPageSize((int)self::$_helper->postsPerPage());

            $this->setData('cached_collection', $collection);
        }
        return $this->getData('cached_collection');
    }

    /**
     * @param $image
     * @param $width
     * @param $height
     * @return string
     */
    public function getResizedImage($image, $width, $height, $same = false, $rect = false){

        $media_url  = Mage::getBaseUrl('media');
        $upload_folder_path = str_replace("/",DS, Mage::getBaseDir("media").DS.'blog'.DS);
        $imageUrl = $upload_folder_path.$image;

        $imageResized = Mage::getBaseDir('media').DS."blog".DS."resized".DS.$width.$height.DS.$image;

        if (file_exists($imageUrl) && !file_exists($imageResized)) :
            $imageObj = new Varien_Image($imageUrl);

            if($same){

                $imageObj->constrainOnly(TRUE);
                $imageObj->keepAspectRatio(TRUE);
                $imageObj->keepFrame(FALSE);

                $_width = $imageObj->getOriginalWidth();
//                Mage::log('$width->'.$width, null, 'cropping.log', true);
//                Mage::log('$_width->'.$_width, null, 'cropping.log', true);

                $_height = $imageObj->getOriginalHeight();
//                Mage::log('$height->'.$height, null, 'cropping.log', true);
//                Mage::log('$_height->'.$_height, null, 'cropping.log', true);

                $balance = $_width - $_height;

//                Mage::log('$balance->'.$balance, null, 'cropping.log', true);
                $divide = $_width / $_height;

                $extra = $_height / $balance;
//                Mage::log('$extra->'.$extra, null, 'cropping.log', true);


                if ($_width > $_height) {
                    $math_w = $_width * $height / $_height;
//                    Mage::log('$math_w->'.$math_w, null, 'cropping.log', true);

                    $math_h =  $_height * $width / $_width;
//                    Mage::log('$math_h->'.$math_h, null, 'cropping.log', true);

                    if($rect){
                        if($math_h > $height){
                            $imageObj->resize(null, $math_h);
                            $math = $math_h - $height;
                            $imageObj->crop(0, 0, 0, $math); // Crop it (top, left, right, bottom)
                        }else{
                            $imageObj->resize(null, $height);
                            $math = $math_w - $width;
                            $imageObj->crop(0, 0, $math, 0); // Crop it (top, left, right, bottom)
                        }

                    }else{
                        $imageObj->resize(null, $height);
                        $imageObj->crop(0, 0, $height/$extra, 0); // Crop it (top, left, right, bottom)
                    }

                } else {
                    $imageObj->resize($width, null);
                    $math =  $_height * $width / $_width;
                    $math = $math - $height;
                    $imageObj->backgroundColor(array(255,255,255));
                    if($rect){
                        $imageObj->crop(0, 0, 0, $math); // Crop it (top, left, right, bottom)
                    }else{
                        $imageObj->crop(0, 0, 0, $math); // Crop it (top, left, right, bottom)
                    }

                }

            }else{
                $imageObj->keepAspectRatio(true);
                $imageObj->resize($width, $height);
            }

            $imageObj->save($imageResized);
//            Mage::log('---------------', null, 'cropping.log', true);
        endif;

        return $media_url.'blog/resized/'.$width.$height.'/'.$image;


    }
}