<?php

require_once(Mage::getModuleDir('controllers', 'Mage_Customer') . DS . 'AccountController.php');

/**
 * Class Workbench_PlainTable_AccountController
 */
class Workbench_PlainTable_AccountController extends Mage_Customer_AccountController
{
    /**
     * Define target URL and redirect customer after logging in
     */
    protected function _loginPostRedirect()
    {
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $redirectUrl = Mage::getUrl('/');
        } else {
            $redirectUrl = Mage::getUrl('customer/account/login');
        }
        $this->_redirectUrl($redirectUrl);
    }

    protected function _successProcessRegistration(Mage_Customer_Model_Customer $customer)
    {
        $session = $this->_getSession();
        $session->setCustomerAsLoggedIn($customer);
        $url = $session->getBeforeAuthUrl();
        $this->_redirectSuccess($url);
        return $this;
    }
}
