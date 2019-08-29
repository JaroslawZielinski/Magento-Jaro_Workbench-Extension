<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$content = <<<EOT

<div class="my-content">

</div>

EOT;

$layoutUpdateXml = <<<EOT

EOT;

$identifier = 'workbench';
$title = 'Workbench';

$cmsPage = Mage::getModel('cms/page')->setStore(Mage::app()->getStore()->getId())->load($identifier, 'identifier');

if($cmsPage->isObjectNew()) {
    $cmsPage->setTitle($title);
    $cmsPage->setStatus(true);
    $cmsPage->setIdentifier($identifier);
    $cmsPage->setContent($content);
    $cmsPage->setContentHeading('');
    $cmsPage->setRootTemplate('one_column');
    $cmsPage->setLayoutUpdateXml($layoutUpdateXml);
    $cmsPage->setMetaKeywords('');
    $cmsPage->setMetaDescription('');
    $cmsPage->setStores(0);
} else {
    $cmsPage->setContent($content);
    $cmsPage->setLayoutUpdateXml($layoutUpdateXml);
    $cmsPage->setStores(0);
}

$cmsPage->save();

$installer->endSetup();
