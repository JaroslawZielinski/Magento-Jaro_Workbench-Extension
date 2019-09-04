<?php

/**
 * Class Jaro_MyScript_Block_Task1_News_Edit_Form
 */
class Jaro_MyScript_Block_Task1_News_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Inicjuj klasę
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('jaro_myscript_task1_tab_news_form');
        $this->setTitle(Mage::helper('jaro_myscript')->__('News'));
    }

    protected function _getModel()
    {
        return Mage::registry('jaro_myscript_news');
    }

    protected function _getHelper()
    {
        return Mage::helper('jaro_myscript');
    }

    protected function _getModelTitle()
    {
        return 'News';
    }

    protected function _prepareForm()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl('*/news/save'),
            'method' => 'post'
        ]);

        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => $this->_getHelper()->__("$modelTitle Information"),
            'class' => 'fieldset-wide',
        ]);

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', [
                'name' => $modelPk,
            ]);
        }

        $fieldset->addField('name', 'text', [
            'label' => Mage::helper('jaro_myscript')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
            'title' => Mage::helper('jaro_myscript')->__('Name'),
        ]);

        $fieldset->addField('description', 'textarea', [
            'label' => Mage::helper('jaro_myscript')->__('Description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'description',
            'title' => Mage::helper('jaro_myscript')->__('Description'),
            'after_element_html' => '<small>Comments</small>',
        ]);

        $fieldset->addField('is_active', 'select', [
            'label' => Mage::helper('jaro_myscript')->__('Is Active'),
            'class' => 'required-entry validate-yes-no',
            'required' => true,
            'name' => 'is_active',
            'onclick' => "",
            'onchange' => "is_active",
            'values' => array_merge(Jaro_MyScript_Model_Abstract::toOptionArray(), [
                ['label' => 'Yes', 'value' => 1],
                ['label' => 'No', 'value' => 0]
            ]),
            'disabled' => false,
            'readonly' => false,
            'after_element_html' => "<script type=\"text/javascript\">
Validation.add('validate-yes-no', 'Choose Yes or No', function(v) {
    return Validation.get('validate-not-negative-number').test(v)
})</script>",
        ]);

        $fieldset->addField('author_id', 'select', [
            'label' => Mage::helper('jaro_myscript')->__('Author'),
            'class' => 'required-entry validate-customer',
            'required' => true,
            'name' => 'author_id',
            'onclick' => "",
            'onchange' => "",
            'values' => Mage::getSingleton('jaro_myscript/customer')->toOptionArray(),
            'disabled' => false,
            'readonly' => false,
            'after_element_html' => "<script type=\"text/javascript\">
Validation.add('validate-customer', 'Choose Customer', function(v) {
    return Validation.get('validate-greater-than-zero').test(v)
})</script>",
        ]);

        if ($model->getId()) {
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
