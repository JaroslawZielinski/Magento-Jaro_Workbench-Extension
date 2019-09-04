<?php

/**
 * Class Workbench_PlainTable_Block_Config_Adminhtml_Form_Field_Boolean
 */
class Workbench_PlainTable_Block_Config_Adminhtml_Form_Field_Boolean extends Mage_Core_Block_Html_Select
{
    public function _toHtml()
    {
        $options = Mage::getSingleton('adminhtml/system_config_source_yesno')
            ->toOptionArray();
        foreach ($options as $option) {
            $this->addOption($option['value'], $option['label']);
        }

        return parent::_toHtml();
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
