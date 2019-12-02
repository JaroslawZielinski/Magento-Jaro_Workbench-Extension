<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/** @var $website Mage_Core_Model_Website */
$website = Mage::getModel('core/website');
$website->setCode('workbench')
    ->setName('Workbench')
    ->save();

//#addStoreGroup
/** @var $storeGroup Mage_Core_Model_Store_Group */
$storeGroup = Mage::getModel('core/store_group');
$storeGroup->setWebsiteId($website->getId())
    ->setName('Sketch')
    ->setRootCategoryId(Mage::app()->getStore(1)->getRootCategoryId())
    ->save();

//#addStore
/** @var $store Mage_Core_Model_Store */
$store = Mage::getModel('core/store');
$store->setCode('english')
    ->setWebsiteId($storeGroup->getWebsiteId())
    ->setGroupId($storeGroup->getId())
    ->setName('English')
    ->setIsActive(1)
    ->save();

$installer->endSetup();
