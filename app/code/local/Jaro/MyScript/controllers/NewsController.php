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
}
