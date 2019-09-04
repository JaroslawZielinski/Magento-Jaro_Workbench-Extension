<?php

/**
 * Class Jaro_MyScript_Model_Abstract
 */
class Jaro_MyScript_Model_Abstract extends Mage_Core_Model_Abstract
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => Mage::helper('jaro_myscript')->__('Please Select..'), 'value' => '-1'],
        ];
    }

    /**
     * @return array
     */
    public function toGridOptionArray()
    {
        $options = $this->toOptionArray();
        $values = array_column($options, 'label');

        $codes = array_column($options, 'value');
        $ids = [];
        foreach ($codes as $code) {
            $ids[] =
                $this
                    ->getCollection()
                    ->addFieldToFilter('code', ['eq' => $code])
                    ->getFirstItem()
                    ->getId();
        }

        return array_combine($ids, $values);
    }
}
