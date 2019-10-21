<?php

/**
 * Class Jaro_MyScript_Block_Task1_News
 */
class Jaro_MyScript_Block_Task1_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'jaro_myscript';
        $this->_controller = 'task1_news';
        $this->_headerText      = $this->__('All News');
        $this->_addButtonLabel  = $this->__('Add News item');
        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/adminhtml_news/new');
    }
}
