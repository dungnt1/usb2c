<?php
class Illusion_Brands_Block_List extends Illusion_Brands_Block_Abstract
{
	const CACHE_TAG = 'brands_list';
    protected $_cacheKeyArray = NULL;
    protected $key = NULL;
    protected $brand = NULL;
    protected $collection = NULL;
    protected $conf = NULL;
    protected $pcollection = true;
    protected $array = NULL;
    protected $cache = array(Mage_Eav_Model_Entity_Attribute::CACHE_TAG, self::CACHE_TAG);

	protected function _construct() {
        parent::_construct();

        $this->addData(array( 'cache_lifetime'=> 31536000, 'cache_tags'=> $this->cache, ));
        $this->pcollection = true;$this->_prepareTheCollection();
    }

    public function getLoadedBrands() {
        return $this->_getBrandCollection();
    }

    public function getFrontendHash() {
        return md5(implode("+", $this->getCacheKeyInfo()));
    }

    public function getBrandUrlKey($x12, $x1b) {
        if (FALSE === isset($this->array[$x1b][$x12])){
            $this->array[$x1b][$x12] = $this->_formatBrandUrlKey($x12, $x1b);
        }
        return $this->array[$x1b][$x12];
    }

    public function getCacheKeyInfo() {
        if (NULL === $this->_cacheKeyArray){
            $this->_cacheKeyArray = array('BRANDS_LIST',Mage::app()->getStore()->getId(),$this->getTemplateFile(),'template' => $this->getTemplate(),(int)Mage::app()->getStore()->isCurrentlySecure(),$this->getBrandAttributeId(),$this->_getFinalCollectionCacheKey(),);
        } return $this->_cacheKeyArray;
    }

    protected function _getFinalCollectionCacheKey() {
        if (NULL === $this->collection){
            $this->_prepareTheCollection();
        }return $this->collection;
    }

    protected function _getCollectionCacheKey() {
        if (NULL === $this->brand){
            $this->_prepareTheCollection();
        }
        return $this->brand;
    }

    protected function _prepareTheCollection() {
        $this->_prepareSelectedBrandsAndFlags();
        $this->_prepareCollectionCacheKey();
        $x26 = $this->_getBrandCollection();
        $this->collection = md5(implode("\x2b", $x26));
    }

    protected function _prepareSelectedBrandsAndFlags(){
        $x27 = $this->getBrands();
        if ($x27 === NULL) {
            if ($this->_helper->getCfg('list/all_brands')) {
                $this->pcollection = true;
            } else {
                $this->pcollection = false;
                $this->conf = $this->_helper->getCfg('list/brands');
            }
        }else {
            $this->pcollection = false;
            $this->conf = $x27;
        }
    }

    protected function _prepareCollectionCacheKey() {
        $x28[] = 'brands';
        $x28[] = Mage::app()->getStore()->getId();
        if ($this->pcollection){
        }else{
            $x28[] = $this->conf;
        }
        $x28[] = $this->_helper->getCfg('list/assigned');
        $x28[] = $this->_helper->getCfg('list/assigned_in_stock');
        $this->brand = 'brands-' . md5(implode("|", $x28));
    }

    protected function _getBrandCollection() {
        if (NULL === $this->key){$x29 = Mage::getSingleton('core/cache');
            $x28 = $this->_getCollectionCacheKey();
            if (! $x2a = $x29->load($x28)) {
                $x26 = $this->_buildBrandsCollection();
                $this->key = $x26;
                $x2a = urlencode(serialize($x26));
                $x29->save($x2a, $x28, $this->cache, 2592000);
            } else {
                $this->key = unserialize(urldecode($x2a));
            }
        }
        return $this->key;
    }

    protected function _buildBrandsCollection() {
        $x2b = $this->_helper->getCfg('list/assigned');
        if ($this->pcollection){
            if ($x2b) {
                $x26 = $this->_getAllBrandsInUse();
            } else {
                $x26 = $this->_getAllBrands();
            }
        }else {
            if ($x2b) {$x26 = $this->_getAllBrandsInUse();
                $x27 = $this->_getSelectedBrands();
                $x26 = array_intersect($x27, $x26);
            } else {
                $x26 = $this->_getSelectedBrands();
            }
        }

        return $x26;
    }

    protected function _getSelectedBrands() {
        $x2c = $this->conf;
        if (!empty($x2c)){
            return array_map('trim', explode(',', $x2c));
        }else{
            return array();
        }
    }

    protected function _getAllBrands() {
        $x2d = array();
        foreach ($this->_attributeModel->getSource()->getAllOptions(false, true) as $x2e){
            $x2d[] = $x2e['label'];
        }
        return $x2d;
    }

    protected function _getAllBrandsInUse() {
        $x17 = $this->getBrandAttributeId();
        $x2f = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect($x17)
            ->addAttributeToFilter($x17, array('neq' => ''))
            ->addAttributeToFilter($x17, array('notnull' => true))
            ->addAttributeToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
            ->addStoreFilter(Mage::app()->getStore()->getId()) ;

        if ($this->_helper->getCfg('list/assigned_in_stock')){
            Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($x2f);
        }

        $x30 = array_unique($x2f->getColumnValues($x17));
        $x31 = $this->_attributeModel->getSource()->getOptionText( implode(',', $x30) );
        if (is_string($x31)){
            return array($x31);
        }
        return $x31;
    }


}