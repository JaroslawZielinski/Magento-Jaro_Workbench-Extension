<?php

/**
 * Class Jaro_MyScript_Model_Mysql4_News
 */
class Jaro_MyScript_Model_Mysql4_News extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('jaro_myscript/news', 'news_id');
    }

}
