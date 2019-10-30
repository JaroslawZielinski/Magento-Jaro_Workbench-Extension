<?php

/**
 * Class Jaro_MyScript_Ajax_NewsController
 */
class Jaro_MyScript_Ajax_NewsController extends Workbench_PlainTable_Controller_Ajax_AbstractController
{
    /**
     *
     */
    protected function _requestValidations()
    {
        $this->_checkIfAjaxCall();
    }

    /**
     * My action. Ajax Call required
     */
    public function deleteAction()
    {
        $this->_requestValidations();

        if ($id = $this->getRequest()->getPost('id')) {
            try {
                $model = Mage::getModel('jaro_myscript/news');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('jaro_myscript')->__('Unable to find a News to delete.'));
                }
                $model->delete();
            } catch (Mage_Core_Exception $e) {
                $this->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->addErrorMessage(Mage::helper('jaro_myscript')->__('An error occurred while deleting News data. Please review log and try again.'));
                Mage::logException($e);
            }
        } else {
            $this->addErrorMessage(Mage::helper('jaro_myscript')->__('Unable to find a News to delete.'));
        }

        $this->_init();
        $this->renderLayout();
    }

    /**
     * My action. Ajax Call required
     */
    public function editAction()
    {
        $this->_requestValidations();

        $model = null;

        if ($id = $this->getRequest()->getPost('id')) {
            try {
                $model = Mage::getModel('jaro_myscript/news');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('jaro_myscript')->__('Unable to find a News to edit.'));
                }
            } catch (Mage_Core_Exception $e) {
                $this->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->addErrorMessage(Mage::helper('jaro_myscript')->__('An error occurred while editing News data. Please review log and try again.'));
                Mage::logException($e);
            }
        } else {
            $this->addErrorMessage(Mage::helper('jaro_myscript')->__('Unable to find a News to edit.'));
        }

        $this->_init();
        $this->getLayout()->getBlock('news.form.row')->setNewsItem($model);
        $this->renderLayout();
    }
}

