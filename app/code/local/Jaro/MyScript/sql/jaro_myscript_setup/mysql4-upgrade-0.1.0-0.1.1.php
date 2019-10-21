<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$newsTable = $installer->getTable('jaro_myscript/news');
$installer->getConnection()->query("ALTER TABLE {$newsTable} ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
$installer->getConnection()->query("ALTER TABLE {$newsTable} ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");

$installer->endSetup();
