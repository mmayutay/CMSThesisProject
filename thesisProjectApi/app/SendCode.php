<?php

namespace App;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SendCode
{
    use Queueable, SerializesModels;

    public $code;

    public function _construct($code) {

        $this->code = $code;
    }

    public function _toString() {

        return $this->code;
    }

    public static function sendCode($phone) {
            try {
                $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
                $client = new \Nexmo\Client($basic);
      
                $receiverNumber = $phone;
                error_log($receiverNumber);

                $code = rand(1111,9999);
                $message = $client->message()->send([
                    'to' => "+63".$receiverNumber,
                    'from' => 'Vonage APIs',
                    'text' => "Verificaion Code: ". $code
                ]);
      
                // dd('SMS Sent Successfully.');
                error_log($code);
                return $code;
                  
            } catch (Exception $e) {
                // dd("Error: ". $e->getMessage());
                return response()->json(['success',$e->getMessage()]);
            }
        }
            // $code = rand(1111,9999);
            //     $nexmo = app('Nexmo\Client');
            //         $nexmo->message()->send([
            //             'to' => '+639659615929',
            //             'from' => '+639659615929',
            //             'text' => 'Verification Code: '. $code,
            //         ]);
            //         error_log("Send code:",$code);
            //         return $code;

}