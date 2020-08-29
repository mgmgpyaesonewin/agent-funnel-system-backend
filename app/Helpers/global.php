<?php

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

if (!function_exists('notified_applicant_via_viber')) {
    function notified_applicant_via_viber($phone, $text)
    {
        $client = new \GuzzleHttp\Client();
        $phone = ltrim($phone, '0');
        $response = $client->request('POST', env('VIBER_API'), [
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
                        'type' => 'text',
                        'text' => $text,
                    ],
                ],
            ],
        ]);
        if (202 == $response->getStatusCode()) {
            return true;
        }

        return false;
    }
}
