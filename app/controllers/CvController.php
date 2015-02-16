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

        // Izveidojam PDF
        $dompdf = new DOMPDF();

        // Izveidojam skatu
        $html = \CvMaker\View::make('cv', array_merge($_POST, $_FILES), true);

        // Padodam skatu pdf izveidei
        $dompdf->load_html($html);

        $dompdf->render();

        // Izveidojam vēl vienu pdf dokumentu glabāšanai datubāzē
        // jo pēc output() funkcijas tas vairs neatgriež sākotnējo izskatu
        $dompdfDb = new DOMPDF();

        $dompdfDb->load_html($html);
        $dompdfDb->render();

        // Saglabājam datus datubāzē
        $cv = new Cv();

        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name'  => $_POST['last_name'],
            'birthday'   => $_POST['birthday'],
            'email'      => $_POST['email'],
            'image'      => file_get_contents($_FILES['image']['tmp_name']),
            'pdf'        => $dompdfDb->output(),
            'education'  => $_POST['education'],
            'languages'  => $_POST['languages']
        );

        $cv->setData($data);

        $cv->save();

        $dompdf->stream("cv.pdf");

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}