<?php

use App\Setting;
use GuzzleHttp\Exception\BadResponseException;

function showStatus($status)
{
    return $status ? 'Shown' : 'Hidden';
}

function classStatus($status)
{
    // if($status){
    //     dd($status);
    // }
    // dd($status);
    return $status ? 'text-primary' : 'text-danger';
}

function checkStatus($status)
{
    return $status ? ' checked ' : '';
}

if (!function_exists('validate_asset')) {
    function validate_asset($asset)
    {
        return $asset ? asset('storage/'.$asset) : null;
    }
}

if (!function_exists('notified_applicant_via_viber')) {
    function notified_applicant_via_viber($phone, $meta_key, $link = null)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $phone = ltrim($phone, '0');

            $meta_value = json_decode(Setting::where('meta_key', $meta_key)->first()->meta_value);
            $text = $meta_value->text.' '.$link;
            $img = $meta_value->image;
            $caption = 'View';
            $action = $link ?? '#';

            $client->request('POST', env('VIBER_API'), [
                'auth' => ['7b3327d3', 'wQdVYaU9NRIiatsv'],
                'json' => [
                    'from' => [
                        'type' => 'viber_service_msg',
                        'id' => '16273',
                    ],
                    'to' => [
                        'type' => 'viber_service_msg',
                        'number' => '95'.$phone,
                    ],
                    'message' => [
                        'content' => [
                            'type' => 'custom',
                            'custom' => [
                                '#txt' => $text,
                                '#img' => $img,
                                '#caption' => $caption,
                                '#action' => $action,
                            ],
                        ],
                    ],
                ],
            ]);
        } catch (BadResponseException $e) {
            // not working, need to throw
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

if (!function_exists('reverse_slug')) {
    function reverse_slug($slug)
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}
