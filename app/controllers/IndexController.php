<?php
/**
 * Class IndexController
 */
class IndexController extends BaseController {

    /**
     * Homepage - vienkārši atgriežam mājas lapas skatu
     *
     */
    public function indexAction()
    {
        \CvMaker\View::make('home');
    }

}