<?php
// Ielādējam nepieciešamos failus ( skat. composer.json autoload sadaļu )
require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Dompdf ( pdf paplašinājums priekš PHP) uzstādījumi
define('DOMPDF_ENABLE_AUTOLOAD', false);

// Dompdf konfigurāciju fails
require_once dirname(__FILE__) . '/../vendor/dompdf/dompdf/dompdf_config.inc.php';

// Izsaucam attiecīgo kontroliera klasi un funkciju atkarībā no pieprasījuma URI
CvMaker\App::run();
