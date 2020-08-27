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
    function notified_applicant_via_viber($text)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->post(env('VIBER_API'), [
            'from' => [
                'type' => 'viber_service_msg',
                'id' => '16273',
            ],
            'to' => [
                'type' => 'viber_service_msg',
                'number' => '959796874359',
            ],
            'message' => [
                'content' => [
                    'type' => 'text',
                    'text' => 'This is a Viber Service Message sent from the Messages API, testing',
                ],
            ],
        ]);
        $response = $request->send();
        dd($response);
    }
}
