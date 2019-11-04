<?php

/**
 * Class Workbench_PlainTable_Block_MyContent
 */
class Workbench_PlainTable_Block_MyContent extends Mage_Core_Block_Template
{
    const WORKBENCH_CONFIGURATION_MYCONTENT_ENABLE = 'plaintable_general/my_content/enable';
    const WORKBENCH_CONFIGURATION_MYCONTENT_OCCUPATION = 'plaintable_general/my_content/occupation';
    const WORKBENCH_CONFIGURATION_MYCONTENT_FULLNAME = 'plaintable_general/my_content/fullname';
    const WORKBENCH_CONFIGURATION_MYCONTENT_PHONE = 'plaintable_general/my_content/phone';
    const WORKBENCH_CONFIGURATION_MYCONTENT_EMAIL = 'plaintable_general/my_content/email';

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getIsEnabled($storeId = null)
    {
        return Mage::getStoreConfig(self::WORKBENCH_CONFIGURATION_MYCONTENT_ENABLE, $storeId);
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getOccupation($storeId = null)
    {
        return Mage::getStoreConfig(self::WORKBENCH_CONFIGURATION_MYCONTENT_OCCUPATION, $storeId);
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getFullName($storeId = null)
    {
        return Mage::getStoreConfig(self::WORKBENCH_CONFIGURATION_MYCONTENT_FULLNAME, $storeId);
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getPhone($storeId = null)
    {
        return Mage::getStoreConfig(self::WORKBENCH_CONFIGURATION_MYCONTENT_PHONE, $storeId);
    }
    /**
     * @param null $storeId
     * @return mixed
     */
    public function getEmail($storeId = null)
    {
        return Mage::getStoreConfig(self::WORKBENCH_CONFIGURATION_MYCONTENT_EMAIL, $storeId);
    }
}
