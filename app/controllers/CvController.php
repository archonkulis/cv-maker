<?php
/**
 * Class CvController
 */
class CvController extends BaseController {

    /**
     * PDF izveide
     *
     */
    public function createAction()
    {
        if (!$this->_validateImageUpload($_FILES)) {
            die('Attēla augšupielādes kļūda.');
        }

        $required = array(
            'first_name',
            'last_name',
            'birthday',
            'email',
            'education',
            'languages'
        );

        if (!$this->_validateInputs($required, $_POST)) {
            die('Kļūda ievades laukos.');
        }

        $cv = new Cv();

        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name'  => $_POST['last_name'],
            'birthday'   => $_POST['birthday'],
            'email'      => $_POST['email'],
            'education'  => $_POST['education'],
            'languages'  => $_POST['languages']
        );

        $cv->setData($data);

        $dompdf = new DOMPDF();

        // Izveidojam skatu
        $html = \CvMaker\View::make('cv', array_merge($_POST, $_FILES), true);

        // Padodam skatu pdf izveidei
        $dompdf->load_html($html);
        $dompdf->render();

        $dompdf->stream("cv.pdf");

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}