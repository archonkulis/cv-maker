<?php
/**
 * Class BaseController
 */
class BaseController {
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