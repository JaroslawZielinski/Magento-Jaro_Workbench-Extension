<?php

/**
 * Class Jaro_MyScript_NewsController
 */
class Jaro_MyScript_NewsController extends Jaro_MyScript_Controller_AbstractController
{

    /**
     *
     */
    public function addAction()
    {
        if ($postData = $this->getRequest()->getPost()) {

            /** @var Jaro_MyScript_Model_News $model */
            $model = Mage::getModel('jaro_myscript/news');
            // save model
            try {
                $model->addData($postData);
                $model->save();

                $this->_getSession()->addSuccess(
                    Mage::helper('jaro_myscript')->__('The news has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('jaro_myscript')->__('Unable to save the News.') . $e->getMessage());
                Mage::logException($e);
            }
        }
        $this->_redirect('*/news/index');
    }

    /**
     *
     */
    public function indexAction()
    {
        $this
            ->_initAction()
            ->renderLayout();
    }
}
