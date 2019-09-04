<?php

/**
 * Class Jaro_MyScript_Model_Customer
 */
class Jaro_MyScript_Model_Customer extends Jaro_MyScript_Model_Abstract
{

    protected function _getCustomerIds()
    {
        return Mage::getSingleton('mage/customer')->getCollection();
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $customerOptionsArray = [];
        /** @var Mage_Customer_Model_Resource_Customer_Collection $customerCollection */
        $customerCollection = Mage::getModel('customer/customer')
            ->getCollection();

        /** @var Mage_Customer_Model_Customer $customer */
        foreach ($customerCollection as $customer)
        {
            $customerOptionsArray[] = [
                'label' => $customer->getEmail(),
                'value' => $customer->getId()
            ];

        }

        return array_merge(parent::toOptionArray(), $customerOptionsArray);
    }
}
