<?php

/**
 * Class Jaro_MyScript_Controller_AbstractController
 */
class Jaro_MyScript_Controller_AbstractController extends Mage_Core_Controller_Front_Action
{
    /**
     *
     */
    protected function _canRender()
    {
        $sessionCustomer = Mage::getSingleton("customer/session");
        if (!$sessionCustomer->isLoggedIn()) {
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }

        return $this;
    }

    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this
            ->_canRender()
            ->loadLayout();
    }
}
