<?php

function isEmailVerified(){
    if(\Auth::check()){
        return \Auth::user()->email_veriried_at == null ? false: true;
    }
}

function isEmployer ()
{
    if (\Auth::check()) {
        return Auth::user()->role_id == 3;
    }
    return false;
}
function isFreelancer()
{
    if (\Auth::check()) {
        return Auth::user()->role_id == 2;
    }
    return false;
}
/**
 * Checking verified freelancer
 *
 * @return boolean
 */
function isVerifiedFreelancer(){
    return isFreelancer() && !Auth::user()->verification_bar?true:false;
}

function isZeroStarFreelancer($user)
{
    return $user->freelancer->star == 0;
}
function isOneStarFreelancer($user){
    return $user->freelancer->star == 1;    
}
function isTwoStarFreelancer($user)
{
    return $user->freelancer->star == 2;
}
function isThreeStarFreelancer($user)
{
    return $user->freelancer->star == 3;
}
function isFourStarFreelancer($user)
{
    return $user->freelancer->star == 4;
}
function isFiveStarFreelancer($user)
{
    return $user->freelancer->star == 5;
}
/**
 * To check premium freelancer
 *
 * @param [type] $user
 * @return boolean
 */
function isPremiumFreelancer($user){
    return $user->freelancer->star >= 3;
}
/**
 * To check standard project
 *
 * @param [type] $project
 * @return boolean
 */
function isStandardProject($project){
    return $project->project_pricing_id == 1;
}
/**
 * To check premium project
 *
 * @param [type] $project
 * @return boolean
 */
function isPremiumProject($project){
    return $project->project_pricing_id == 3;
}
/**
 * To check enterprise project
 *
 * @param [type] $project
 * @return boolean
 */
function isEnterpriseProject($project){
    return $project->project_pricing_id == 4;
}
/**
 * To check enteripise projects which posted by AE
 *
 * @param [type] $project
 * @return boolean
 */
function isAeEnterpriseProject($project){
    return $project->project_pricing_id == 8;
}
/**
 * To check current url and add active class
 *
 * @param String $url
 * @return void
 */
function activeLink(String $url){
    return (request()->is($url)) ? 'active' : '';
}
/**
 * to get service charges/commission by project
 *
 * @param \Modules\Project\Models\Project $project
 * @return void
 */
function getServiceCharges(Modules\Project\Models\Project $project){
    return Modules\Project\Services\ProjectService::serviceCharges($project);
}
/**
 * get setting value
 *
 * @param [String] $key
 * @return void
 */
function getSettingValue(String $key){
    $setting = Modules\Core\Models\Setting::where('meta_key', $key)->first();
    return $setting->meta_value;
}
/**
 * To convert mmk to usd
 *
 * @param number $amount
 * @return void
 */
function convertMmkToUsd($amount){
    $XE = getSettingValue('xe');
    return round((int) $amount * (1 / $XE), 2);
}
/**
 * To convert usd to mmk
 *
 * @param [type] $amount
 * @return void
 */
function convertUsdToMMK($amount){
    $XE = getSettingValue('xe');
    return round((int) $amount * $XE, 2);
}
/**
 * Calculate stripte charges/service fees
 *
 * @param Number $amount
 * @return void
 */
function calculateWithStripeCharges($amount){
    $charges = calculateStripeTransactionFee($amount);
    return round($amount, 2) + $charges;
}
/**
 * get stripe transaction fees
 *
 * @param [type] $amount
 * @return void
 */
function calculateStripeTransactionFee($amount){
    return ($amount * 0.029) + 0.30;
}
/**
 * get mpu transaction fees
 *
 * @param [type] $amount
 * @return void
 */
function calculateMpuTransactionFee($amount){
    if ($amount>25000) {
        // if >25000, 1% service fee
        return round($amount/100);
    } else {
        return 200;
    }
}