<?php

/**
 * Class Jaro_MyScript_NewsController
 */
class Jaro_MyScript_NewsController extends Jaro_MyScript_Controller_AbstractController {

    public function indexAction()
    {
        $this
            ->_initAction()
            ->renderLayout();
    }

    public function viewAction()
    {
        $id  = $this->getRequest()->getParam('id');
        if ($id) {
            //załaduj news
            $model = Mage::getModel('jaro_myscript/news')->load($id);
            //zapisz w zmiennych globalnych
            Mage::register('jaro_myscript_news_item', $model);
        }
        $this
            ->_initAction()
            ->renderLayout();
    }
}
