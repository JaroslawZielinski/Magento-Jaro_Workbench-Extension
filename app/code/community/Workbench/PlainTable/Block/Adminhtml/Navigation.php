<?php

/**
 * Class Workbench_PlainTable_Block_Adminhtml_Navigation
 */
class Workbench_PlainTable_Block_Adminhtml_Navigation
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    const WORKBENCH_PLAINTABLE_NAVIGATION_CONFIG = 'plaintable_general/navigation/navigation_routers';

    protected $_itemRenderer;

    /**
     * Add custom config field columns, set template, add values.
     */
    public function __construct()
    {
        parent::__construct();

        /** @var Workbench_PlainTable_Helper_Data $helper */
        $helper = Mage::helper('workbench_plaintable');

        $this->addColumn('name', array(
            'style' => 'width:100px',
            'label' => $helper->__('Display Name'),
        ));

        $this->addColumn('path', array(
            'style' => 'width:200px',
            'label' => $helper->__('Path'),
        ));

        $this->addColumn('order', array(
            'style' => 'width:40px',
            'label' => $helper->__('Sort Order'),
        ));

        $this->addColumn('auth_status', array(
            'label' => $helper->__('Auth Status'),
            'renderer' => $this->_getRenderer()->setExtraParams('style="width:60px;"')
        ));
    }

    protected function _construct()
    {
        $this->setLayout(Mage::app()->getLayout());
        parent::_construct();
    }

    protected function _getRenderer()
    {
        if (!$this->_itemRenderer) {
            $this->_itemRenderer = $this->getLayout()->createBlock(
                'workbench_plaintable/config_adminhtml_form_field_boolean', 'boolean',
                ['is_render_to_js_template' => true]
            );
        }
        return $this->_itemRenderer;
    }

    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getRenderer()
                ->calcOptionHash($row->getData('auth_status')),
            'selected="selected"'
        );
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);

        if (!$this->getElement()->getData('value')) {
            $value = unserialize(Mage::getStoreConfig(self::WORKBENCH_PLAINTABLE_NAVIGATION_CONFIG));
            $this->getElement()->setData('value', $value);
        }

        return parent::_getElementHtml($element);
    }
}
