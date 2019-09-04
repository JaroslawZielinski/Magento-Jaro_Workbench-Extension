<?php

/**
 * Class Workbench_PlainTable_Helper_Data
 */
class Workbench_PlainTable_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_CONFIG_FIELD_NAVIGATION_ROUTERS = 'plaintable_general/navigation/navigation_routers';

    /**
     * Returns un-serialized data of the custom config field one
     *
     * @return array
     */
    public function getNavigationRouters()
    {
        $config = Mage::getStoreConfig(self::XML_PATH_CONFIG_FIELD_NAVIGATION_ROUTERS);

        if (!$config) {
            return [];
        }

        try {
            $config = Mage::helper('core/unserializeArray')->unserialize($config);
        } catch (Exception $exception) {
            Mage::logException($exception);
            $config = [];
        }

        return $config;
    }
}
