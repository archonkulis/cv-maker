<?php
/**
 * Class CvController
 */
class CvController {

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

        $dompdf = new DOMPDF();

        // Izveidojam skatu
        $html = \CvMaker\View::make('cv', array_merge($_POST, $_FILES), true);

        // Padodam skatu pdf izveidei
        $dompdf->load_html($html);
        $dompdf->render();

        $dompdf->stream("cv.pdf");

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * Ievades lauku validēšana
     *
     * @param $required
     * @param $arr
     * @return bool
     */
    protected function _validateInputs($required, $arr)
    {
        foreach ($required as $field) {
            if (!in_array($field, array_keys($arr))) {
                return false;
            }
        }

        if (!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * Validējam attēlu augšupielādi
     *
     * @param $files
     * @return bool
     */
    protected function _validateImageUpload($files)
    {
        // Validējam attēla augšupielādi
        if (isset($files['image'])) {
            if ($files['image']['error'] !== UPLOAD_ERR_OK) {
                return false;
            }

            if (!getimagesize($files['image']['tmp_name'])) {
                return false;
            }

            return true;
        }
        return false;
    }

}