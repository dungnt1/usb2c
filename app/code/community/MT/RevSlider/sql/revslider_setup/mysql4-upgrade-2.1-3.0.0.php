<?php
/**
 * @category    MT
 * @package     MT_RevSlider
 * @copyright   Copyright (C) 2008-2014 MagentoThemes.net. All Rights Reserved.
 * @license     GNU General Public License version 2 or later
 * @author      MagentoThemes.net
 * @email       support@magentothemes.net
 */

$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('revslider/slider'),
    'styles',
    'TEXT NULL DEFAULT NULL COMMENT "Slider Static Styles"'
);

$installer->getConnection()->addColumn(
    $installer->getTable('revslider/slider'),
    'scripts',
    'TEXT NULL DEFAULT NULL COMMENT "Slider Custom Scripts"'
);

$installer->endSetup();
