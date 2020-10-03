<?php

namespace App\Services;

use App\Classes\Viber\ContentType;
use App\Services\Interfaces\ViberServiceInterface;
use App\Setting;
use Config;
use Exception;
use Log;

class ViberService implements ViberServiceInterface
{
    public function getMetaValueByKey(string $meta_key): object
    {
        return json_decode(Setting::where('meta_key', $meta_key)->first()->meta_value);
    }

    public function send(string $phone, int $contentType, ContentType $content)
    {
        $phone = $this->formatPhone($phone);

        if ($contentType === Config::get('constants.viber.content_type.simple')) {
            $this->sendTextNotification($phone, $content->getText());
        }

        if ($contentType === Config::get('constants.viber.content_type.custom')) {
            $this->sendCustomNotification($phone, $content->getText(), $content->getImage(), $content->getAction());
        }
    }

    private function formatPhone(string $phone): string
    {
        return '95'.ltrim($phone, '0');
    }

    private function sendTextNotification($phone, $text)
    {
        $message = [
            'content' => [
                'type' => 'text',
                'text' => $text,
            ],
        ];

        $this->sendViberXHRRequest($phone, $message);
    }

    private function sendCustomNotification($phone, $text, $image, $action = '#')
    {
        $message = [
            'content' => [
                'type' => 'custom',
                'custom' => [
                    '#txt' => $text,
                    '#img' => $image,
                    '#caption' => Config::get('constants.viber.btn_text'),
                    '#action' => $action,
                ],
            ],
        ];

        $this->sendViberXHRRequest($phone, $message);
    }

    private function sendViberXHRRequest($phone, $message)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request('POST', env('VIBER_API'), [
                'auth' => [
                    Config::get('constants.viber.auth.username'),
                    Config::get('constants.viber.auth.password'),
                ],
                'json' => [
                    'from' => [
                        'type' => 'viber_service_msg',
                        'id' => '16273',
                    ],
                    'to' => [
                        'type' => 'viber_service_msg',
                        'number' => $phone,
                    ],
                    'message' => $message,
                ],
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
