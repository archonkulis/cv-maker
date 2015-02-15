<?php

namespace CvMaker;

/**
 * Class View
 * @package CvMaker
 */
class View
{
    /**
     * Skata izsaukšana
     *
     * Ja toHtml ir false, tad izvadīt html skatu
     * Ja toHtml ir true, tad atgriezt html dokumentu
     *
     * @param $view
     * @param null $variables
     * @param bool $toHtml
     * @return string
     */
    public static function make($view, $variables = null, $toHtml = false)
    {
        if (!file_exists(dirname(__FILE__) . '/../views/' . $view . '.html'))
        {
            die("Template " . $view . " doesn't exist.");
        }

        if (!is_null($variables)) {
            extract($variables);
        }

        ob_start();
        include(dirname(__FILE__) . '/../views/' . $view . '.html');
        $output = ob_get_contents();
        ob_end_clean();

        if ($toHtml) {
            return $output;
        }

        echo $output;
    }
}