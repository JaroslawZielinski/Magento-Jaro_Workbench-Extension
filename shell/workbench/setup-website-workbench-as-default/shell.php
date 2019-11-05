<?php

require_once 'web/shell/abstract.php';
require_once 'web/app/bootstrap.php';

/**
 * Class Workbench_Setup_Website_Workbench_As_Default_Shell
 */
class Workbench_Setup_Website_Workbench_As_Default_Shell extends Mage_Shell_Abstract
{
    const WORKBENCH_WEBSITE_CODE = 'workbench';

    protected function _construct()
    {
        Mage::getModel('core/store')->load(0);
        Mage::init('admin');
        Mage::app()->loadAreaPart(Mage_Core_Model_App_Area::AREA_GLOBAL, Mage_Core_Model_App_Area::PART_EVENTS);
        Mage::app()->loadAreaPart(Mage_Core_Model_App_Area::AREA_ADMINHTML, Mage_Core_Model_App_Area::PART_EVENTS);
        parent::_construct();
    }

    /**
     *
     */
    public function run()
    {
        if ($this->getArg('start')) {
            /** @var Mage_Core_Model_Resource_Website_Collection $collection */
            $collection = Mage::getModel('core/website')->getCollection();

            /** @var Mage_Core_Model_Website $website */
            foreach ($collection as $website) {
                $code = $website->getCode();
                if (self::WORKBENCH_WEBSITE_CODE === $code) {
                    $website->setIsDefault(1);
                } else {
                    $website->setIsDefault(0);
                }

                $website->save();
            }
            echo sprintf('Website with code "%s" has been set as default.' . PHP_EOL, self::WORKBENCH_WEBSITE_CODE);
        } else {
            echo $this->usageHelp();
        }
    }

    /**
     * Retrieve Usage Help Message
     */
    public function usageHelp()
    {
        return 'Usage:' . PHP_EOL . 'php shell/workbench/setup-website-workbench-as-default/shell.php --start' . PHP_EOL . PHP_EOL;
    }
}

$shell = new Workbench_Setup_Website_Workbench_As_Default_Shell;
$shell->run();
