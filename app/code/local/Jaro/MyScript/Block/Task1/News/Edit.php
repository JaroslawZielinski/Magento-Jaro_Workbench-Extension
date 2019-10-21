<?php

/**
 * Class Jaro_MyScript_Block_Task1_News_Edit
 */
class Jaro_MyScript_Block_Task1_News_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        // $this->_objectId = 'id';
        parent::__construct();
        $this->_blockGroup = 'jaro_myscript';
        $this->_controller = 'task1_news';
        $this->_mode = 'edit';
        $modelTitle = $this->_getModelTitle();
        $this->_updateButton('save', 'label', $this->_getHelper()->__("Save $modelTitle"));
        $this->_addButton('saveandcontinue', array(
            'label' => $this->_getHelper()->__('Save and Add New'),
            'onclick' => 'saveAndAddNew()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndAddNew(){
                editForm.submit($('edit_form').action+'back/new/');
            }
        ";
    }

    protected function _getHelper()
    {
        return Mage::helper('jaro_myscript');
    }

    protected function _getModel()
    {
        return Mage::registry('jaro_myscript_news');
    }

    protected function _getModelTitle()
    {
        return 'News';
    }

    public function getHeaderText()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        if ($model && $model->getId()) {
            return $this->_getHelper()->__("Edit $modelTitle (ID: {$model->getId()})");
        } else {
            return $this->_getHelper()->__("New $modelTitle");
        }
    }


    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/adminhtml_news/index');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/adminhtml_news/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }

    /**
     * Get form save URL
     *
     * @deprecated
     * @see getFormActionUrl()
     * @return string
     */
    public function getSaveUrl()
    {
        $this->setData('form_action_url', 'save');
        return $this->getFormActionUrl();
    }


}
