<?php
/**
 * Class IndexController
 */
class IndexController {

    /**
     * Homepage - vienkārši atgriežam mājas lapas skatu
     *
     */
    public function indexAction()
    {
        \CvMaker\View::make('home');
    }

}