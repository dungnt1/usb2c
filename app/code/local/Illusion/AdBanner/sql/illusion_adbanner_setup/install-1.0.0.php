<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
/* @var $this Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();


$bannerTable = $installer->getTable('illusion_adbanner/adbanner');

if($installer->getConnection()->isTableExists($bannerTable) != true){
    $table = $installer->getConnection()->newTable($bannerTable)
        ->addColumn('adbanner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'primary'   => true,
            'unsigned'  => true,
            'nullable'  => false,
            'identity'  => true
        ),'Brand Id')
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable'  =>  false,
            'default'   =>  ''
        ),'Banner Title')
        ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable'  =>  false,
            'default'   =>  ''
        ),'Banner Image')
        ->addColumn('link', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable'  =>  false,
            'default'   =>  ''
        ),'Banner Link')
        ->addColumn('advcode', Varien_Db_Ddl_Table::TYPE_TEXT, '1k', array(
            'nullable'  =>  false,
            'default'   =>  ''
        ),'Code')
        ->addColumn('advmode', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Mode')
        ->addColumn('position_left', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Left')
        ->addColumn('position_content', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Content')
        ->addColumn('position_right', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Right')
        ->addColumn('position_home', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Home')
        ->addColumn('position_category', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Category')
        ->addColumn('position_product', Varien_Db_Ddl_Table::TYPE_SMALLINT,null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Position Product')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Status')
        ->addColumn('order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'nullable'  =>  false,
            'default'   =>  '0'
        ),'Banner Order')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable'  =>  false,
            'default'   =>  ''
        ),'Banner StoreIds')
        ->addColumn('created_time', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
            'nullable'  =>  true
        ),'Banner Created Time')
        ->addColumn('updated_time', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
            'nullable'  =>  true
        ),'Banner Updated Time')
        ->addIndex($this->getIdxName($bannerTable, array('adbanner_id')), array('adbanner_id'));

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();