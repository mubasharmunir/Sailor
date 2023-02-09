<?php
namespace App\Http\Traits;
use Twilio\Rest\Client;
use Exception;

/**
 *
 */
trait SmsTrait
{
    public static function send($receiverNumber , $message)
    {
        // $receiverNumber = "+923037913413";
        // $message = "Your Message Send Successfully";



            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);

    }
}



