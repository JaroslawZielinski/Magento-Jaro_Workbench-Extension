<?php

/**
 * Class Jaro_MyScript_Model_Mysql4_News_Collection
 */
class Jaro_MyScript_Model_Mysql4_News_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('jaro_myscript/news');
    }
}
