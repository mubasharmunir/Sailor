<?php
   if (!class_exists('Services_Twilio')) {
    include_once(APPPATH.'/libraries/Services/Twilio.php');
}

function get_twilio_service() {
    static $twilio_service;
    if (!($twilio_service instanceof Services_Twilio)) {

        $twilio_service = new Services_Twilio("sid", "auth");



    }
    return $twilio_service;
}
