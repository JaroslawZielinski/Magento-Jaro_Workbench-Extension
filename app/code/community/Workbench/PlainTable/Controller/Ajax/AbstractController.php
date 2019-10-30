<?php

/**
 * Class Workbench_PlainTable_Controller_Ajax_AbstractController
 */
class Workbench_PlainTable_Controller_Ajax_AbstractController extends Mage_Core_Controller_Front_Action
{
    const AJAX_DEFAULT_ERROR_STATUS = 'FAILED';

    protected $_messages;

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    protected function _handleErrors()
    {
        if (!empty($this->_messages)) {
            $this->getLayout()->getBlock('root')
                ->setData([
                    'status' => self::AJAX_DEFAULT_ERROR_STATUS,
                    'message' => $this->_messages
                ]);
        }
    }

    protected function _init()
    {
        $this->loadLayout();
        $this->_handleErrors();
    }

    /**
     *
     */
    protected function _checkIfAjaxCall()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            $this->addErrorMessage('It is not an Ajax call.');
        }
    }

    /**
     * @param $message
     */
    public function addErrorMessage($message)
    {
        $this->_messages .= $message;
    }
}

