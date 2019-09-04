<?php

/**
 * Class Jaro_MyScript_NewsController
 */
class Jaro_MyScript_NewsController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('jaro/jaro_myscript_jaro')
            ->_title(Mage::helper('jaro_myscript')->__('Jaro'))->_title(Mage::helper('jaro_myscript')->__('News'))
            ->_addBreadcrumb(Mage::helper('jaro_myscript')->__('Jaro'), Mage::helper('jaro_myscript')->__('News'))
            ->_addBreadcrumb(Mage::helper('jaro_myscript')->__('News'), Mage::helper('jaro_myscript')->__('News'));
        $this->_addContent($this->getLayout()->createBlock('jaro_myscript/task1_news'));
        $this->renderLayout();
    }

    /**
     *
     */
    public function exportCsvAction()
    {
        $fileName = 'news_export.csv';
        $content = $this->getLayout()->createBlock('jaro_myscript/task1_news_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     *
     */
    public function exportExcelAction()
    {
        $fileName = 'news_export.xml';
        $content = $this->getLayout()->createBlock('jaro_myscript/task1_news_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     *
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select News items.'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('jaro_myscript/news')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('jaro_myscript')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/news/index');
    }

    /**
     *
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('jaro_myscript/news');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('jaro_myscript')->__('This news no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('jaro_myscript_news', $model);

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('jaro_myscript/task1_news_edit'));
        $this->renderLayout();
    }

    /**
     *
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     *
     */
    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($postData = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('id');
            /** @var Jaro_MyScript_Model_News $model */
            $model = Mage::getModel('jaro_myscript/news');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('jaro_myscript')->__('This News no longer exists.')
                    );
                    $this->_redirect('*/news/index');
                    return;
                }
            }

            // save model
            try {
                $model->addData($postData);
                $this->_getSession()->setFormData($postData);

                $model
                    ->save();

                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('jaro_myscript')->__('The news has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('jaro_myscript')->__('Unable to save the News.') . $e->getMessage());
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/news/new');
                return;
            }
        }
        $this->_redirect('*/news/index');
    }

    /**
     *
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('jaro_myscript/news');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('jaro_myscript')->__('Unable to find a News to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('jaro_myscript')->__('The News has been deleted.')
                );
                // go to grid
                $this->_redirect('*/news/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('jaro_myscript')->__('An error occurred while deleting News data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/news/edit', array('id' => $id));
            return;
        }
// display error message
        $this->_getSession()->addError(
            Mage::helper('jaro_myscript')->__('Unable to find a News to delete.')
        );
// go to grid
        $this->_redirect('*/news/index');
    }

    /**
     * Sprawdź uprawnienia dla użytkownika
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/jaro/jaro_myscript_news');
    }
}