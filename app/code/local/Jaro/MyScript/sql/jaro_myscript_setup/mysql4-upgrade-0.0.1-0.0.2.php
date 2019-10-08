<?php

/**
 *
 */
$installer = $this;
$installer->startSetup();

/**
 * Dodaj kolumnę 'content'
 */
$table = $installer->getConnection()
    ->addColumn($installer->getTable('jaro_myscript/verses'), 'content', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'comment' => 'Verse Content'
    ));

$installer->endSetup();