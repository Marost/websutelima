<?php 
require_once("src/Google_Client");
require_once("src/contrib/Google_AnalyticsService");
 
/**
 * Configuracion para llamados con la api de google.
 */
Configure::write('GOOGLE_API', array(
        'CLIENT_ID' => "932143619129.apps.googleusercontent.com",
        'SERVICE_ACCOUNT_NAME' => "932143619129@developer.gserviceaccount.com",
        'KEY_FILE' => "f2599f9c644541507070de7bddc5b556ce33d2d5-privatekey.p12",
        'PROFILE_ID' => '20229980'
));

?>