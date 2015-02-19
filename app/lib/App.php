<?php

namespace CvMaker;

/**
 * Class App
 * @package CvMaker
 */
class App
{
    /**
     * Aplikācijas palaišana - attiecīgā kontroliera izsaukšana atkarībā no URI
     * Atkarībā no servera uzstādījumiem, tiek ņemti URI segmenti, jo
     * localhost gadījumā ( bez virtuālā hosta ), HTTP_HOST ir localhost
     * bet ja ir uzstādīts virtuālais hosts, piemēram, cvmaker.local un root mape norādīta public/, tad
     * attiecīgi segmenti būs savādāki
     *
     */
    public static function run()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);

        if ($_SERVER['HTTP_HOST'] === 'localhost') {
            if (isset($segments[0]) && (isset($segments[3]) && !empty($segments[3]))) {
                $class = ucwords($segments[3]) . 'Controller';

                if (isset($segments[4])) {
                    $method = $segments[4] . 'Action';
                }
                else {
                    $method = 'indexAction';
                }
            } else {
                $class = 'IndexController';
                $method = 'indexAction';
            }
        } else { // todo - notestēt virtual hostu
            if (isset($segments[0]) && $segments[0] !== '') {
                $class = ucwords($segments[0]) . 'Controller';

                if (isset($segments[1])) {
                    $method = $segments[1] . 'Action';
                }
                else {
                    $method = 'indexAction';
                }
            } else {
                $class = 'IndexController';
                $method = 'indexAction';
            }
        }

        if (class_exists($class)) {
            $controller = new $class;
            if (method_exists($class, $method)) {
                $controller->$method();
            } else {
                die('Funkcija ' . $method .' klasē ' . $class . ' neeksistē');
            }
        } else {
            die('Klase ' . $class . ' neeksistē');
        }

    }
}