<?php

namespace  Modules\Core\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Modules\Core\Models\OtpCode;
use Modules\Core\Services\SmsService;
use App\Jobs\Sms\Otp;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class OTPService
{
    public $otpModel = null;

    public function verify($request)
    {
        //$this->throttle = new Throttles('verification');
        return $this->attemptVerify($request);
        // if ($this->throttle->hasTooManyAttempts($request)) {
        //     return $this->throttle->sendLockoutResponse($request);
        // }

        // if ($this->attemptVerify($request)) {
        //     $this->throttle->clearAttempts($request);
        //     return true;
        // }

        // $this->throttle->incrementAttempts($request);

        //return false;
    }

    public function attemptVerify($request)
    {
        // $ph = $this->checkPhoneNumber($request);
        // $phoneNo = "959".$ph;
        
        $this->otpModel = OtpCode::whereCode($request->code)->wherePhone($request->phoneNo)->first();
        // return $this->otpModel === null ? false : true;
        if($this->otpModel != null){
            $this->verified($request->code, $request->phoneNo);
            return true;
        }else{
            return false;
        }
    }

    public function verified($code, $phone)
    {
        OtpCode::wherePhone($phone)->update(['status' => 'VERIFIED']);
    }

    public function sendSmsCode($request)
    {
        // Everytime after we send one sms, we will increment attemps
        // and lock the user for one minute
        // that will prevent multiple clicking sms service
       // Log::emergency("OTP", [$request->ip]);

        // $this->throttle = new Throttles('smsSend', 5);

        // if ($this->throttle->hasTooManyAttempts($request)) {
        //     return $this->throttle->sendLockoutResponse($request);
        // }

        $this->sendSms($request);

        // $this->throttle->clearAttempts($request);
    }

    protected function checkPhoneNumber($request){
        $requestedPhone = $request->phoneNo;          
        $startWithZeroNine = starts_with($requestedPhone, '09');
        if($startWithZeroNine == true){
            $ph = str_replace_first('09', '', $requestedPhone);
        }else{
            $ph = $requestedPhone;
        }
        return $ph;
    }
    protected function sendSms($request)
    {
        $number = $request->phoneNo;
        
        $code = rand(1000,9999);
        OtpCode::create([
            'code' => $code,
            'phone'=> $number
        ]);
        
        
        $message = "ChateSat.com: Your OTP code is {$code}";
        // dd($message);
        //send sms via SmsService
        $smsService = new SmsService();
        $resp = $smsService->send($number, $message);

        return $resp;
        // $ph = $this->checkPhoneNumber($request);
        // $code = rand(1000,9999);
        // $number = "959".$ph;
        

        // if ($this->checkFormattedPhoneNumber($number))
        // {
        //     OtpCode::create([
        //         'code' => $code,
        //         'phone'=> $request->phoneNo;
        //     ]);
            
            
        //     $message = "Your OTP is {$code}";
        //     // dd($message);
        //     //send sms via SmsService
        //     $smsService = new SmsService();
        //     $resp = $smsService->send($number, $message);

        //    return $resp;
          
        // }
    }

    protected function checkFormattedPhoneNumber($number)
    {
        $string = $number;
        $nu = preg_replace('/[^0-9]/', '', $string);
        $condition = preg_replace('/\s+/', '', $nu);
        $startNumber = (substr($condition, 3, 1));
        $lenght = strlen($condition);

        if ($startNumber == 7 && $lenght == 12 ||
            $startNumber == 9 && $lenght == 12 ||
            //MPT Phone Number
            $startNumber == 2 && $lenght == 10 ||
            $startNumber == 5 && $lenght == 10  ||
            $startNumber == 8 && $lenght == 10 ||
            $startNumber == 4 && $lenght == 11 ||
            $startNumber == 7 && $lenght == 11 ||
            $startNumber == 9 && $lenght == 11 ||
            $startNumber == 2 && $lenght == 12 ||
            $startNumber == 4 && $lenght == 12 ||
            $startNumber == 8 && $lenght == 12
        ) {
            return true;
        }
        else {
            return false;
        }
    }

}