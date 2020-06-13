<?php

namespace  Modules\Core\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use GuzzleHttp\Exception\ClientException;
use AWS;
use Aws\Exception\AwsException;
class SmsService
{
    private $snsClient;
    private $mmClient;
    private $provider;
    public function __construct($provider=null)
    {
        $this->snsClient = AWS::createClient('sns');
        $this->mmClient = new \GuzzleHttp\Client();
        $this->provider = $provider?$provider:config('services.sms.provider');
    }

    public function send($phone, $message){
        if($this->provider == 'sns'){
            return $this->viaSns($phone, $message);
        }else{
            return $this->viaPoh($phone, $message);
        }
    }
    /**
     * Amazon SNS provider
     *
     * @param [type] $phone
     * @param [type] $message
     * @return void
     */
    protected function viaSns($phone, $message){
        try {
            $this->snsClient->publish([
                'Message' => $message,
                'PhoneNumber' => $phone,
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                    ]
                ]
            ]);
            return true;
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
            return false;
        } 
    }
    /**
     * SmsPoh provider
     *
     * @param [String] $phone
     * @param [String] $message
     * @return void
     */
    protected function viaPoh($phone, $message)
    {
        // SMSPoh Authorization Token
        $token = config('sms-poh.token');
        $sender = config('sms-poh.sender');
        $endpoint = config('sms-poh.end_point');

        // Prepare data for POST request
        $data = [
            "to"        =>      $phone,
            "message"   =>      $message,
            "sender"    =>      $sender
        ];


        $ch = curl_init("https://smspoh.com/api/v2/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Tell cURL that it should only spend 10 seconds
        //trying to connect to the URL in question.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        
        //A given cURL operation should only take
        //30 seconds max.
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        
        //Tell cURL to return the response output as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);

        return curl_exec($ch);
    }
}
