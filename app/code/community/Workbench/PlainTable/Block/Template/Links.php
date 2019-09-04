<?php

/**
 * Class Workbench_PlainTable_Block_Template_Links
 */
class Workbench_PlainTable_Block_Template_Links extends Mage_Page_Block_Template_Links {
    const CURRENT_SITE_URL = 'current_site_url';

    /** @var array */
    protected $_navigationRouters;

    protected function _construct()
    {
        parent::_construct();
        $baseUrl = substr($this->getBaseUrl(), 0, -1);
        $urlWithoutParameters = $baseUrl . Mage::app()->getRequest()->getOriginalPathInfo();
        Mage::register(self::CURRENT_SITE_URL, $urlWithoutParameters);

        $this->_navigationRouters = Mage::helper('workbench_plaintable')->getNavigationRouters();

        foreach ($this->_navigationRouters as $router) {
            if (1 == $router['auth_status'] && Mage::getSingleton('customer/session')->isLoggedIn() || 0 == $router['auth_status']) {
                $this->addLink($router['name'], $baseUrl  . DS . $router['path'], $title = '', $prepare = false, $urlParams = [],
                    $position = $router['order'], $liParams = null, $aParams = null, $beforeText = '', $afterText = '');
            }
        }
    }
}
