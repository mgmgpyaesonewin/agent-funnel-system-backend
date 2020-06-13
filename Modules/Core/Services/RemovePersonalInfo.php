<?php

namespace Modules\Core\Services;

// use Uni;

class RemovePersonalInfo
{

    /**
     *  Myanmar Number to English Number,Remove Email and Phone Number
     *
     * @param $string
     * @return mixed|string
     * 
     */
    public function replace($string) {
        // remove email
        $string = $this->email($string);

        // $check = Uni::checkFont($string);

        // $string = Uni::zg2Uni($string);

        // mm to en
        // $string = $this->mm2en($string);

        // remove phone
        $string = $this->phone($string);

        // // is ZawGyi
        // if ($check == 'ZawGyi')dd
        // {
        //     $string = Uni::uni2Zg($string);
        // }

        return $string;
    }

    /**
     * @param $string
     * @return mixed
     * 
     */
    protected function email($string)
    {
        // remove email
        $string = preg_replace('/([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/','xx@xx.com',$string);

        return $string;
    }

    /**
     * @param $string
     * @return string
     * 
     */
    public function mm2en($string)
    {
        // myanmar num
        $myanmar = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈','၉'];

        $num = range(0, 9);

        // replace eng num
        $string = str_replace($myanmar, $num, $string);

        return $string;
    }

    /**
     * @param $string
     * @return string
     * 
     */
    protected function phone($string)
    {
        $string = preg_replace('/(?<=\d)\s+(?=\d)/', '',$string );
        $string = preg_replace('/\b\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}[-. ]?\d{1}\b/', 'xxxx',$string );
        $string = preg_replace('/(\d+[\- ]?\d+){5,20}[\D]/','xxxx',$string);
        return $string;
    }
}