<?php
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->addAttribute('catalog_product', 'custom_tab', array(
    'label'     => 'Custom Tab',
    'type'      => 'varchar',
    'input'     => 'text',
    'default'   => '',
    'visible'   => true,
    'required'  => false,
    'position'  => 21,
));