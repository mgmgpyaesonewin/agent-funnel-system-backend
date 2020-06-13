<?php

namespace  Modules\Core\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use GuzzleHttp\Exception\ClientException;

use Modules\Core\Models\CreditTransaction;
use Carbon\Carbon;
use Auth;

class CreditTransactionService
{
    
    public function __construct()
    {
        
    }
    /**
     * Create MPU deposit transaction
     *
     * @param [type] $mpuRequest
     * @param [type] $status
     * @param [type] $amount
     * @return void
     */
    public function createMpuDepositTransaction($mpuRequest, $status, $amount)
    {
        $credit_transitions = new CreditTransaction;
        $credit_transitions->user_id  = $mpuRequest->userDefined2;
        $credit_transitions->date = now()->toDateTimeString();
        $credit_transitions->type =  'MPU';
        $credit_transitions->channel =  'Online';
        $credit_transitions->status =  $status;
        $credit_transitions->description =  $mpuRequest->userDefined1;
        $credit_transitions->deposit = $amount;
        $credit_transitions->invoice_number = $mpuRequest->invoiceNo;
        $credit_transitions->tranRef = $mpuRequest->tranRef;
        $credit_transitions->reason = $mpuRequest->failReason;
        $credit_transitions->save();
    }
    /**
     * Undocumented function
     *
     * @param [type] $charge
     * @param [type] $desc
     * @param [type] $coin
     * @param [type] $coin_charges
     * @param [type] $invoice
     * @return void
     */
    public function createDepositTransaction($charge, $desc, $coin, $coin_charges, $invoice)
    {
        $credit_transitions = new CreditTransaction;
        $credit_transitions->user_id  = Auth::id();
        $credit_transitions->date = now()->toDateTimeString();
        $credit_transitions->type =  'Master/Visa';
        $credit_transitions->channel =  'Online';
        $credit_transitions->status = ($charge['status'] == 'succeeded' ? 'approved' : $charge['status']);
        $credit_transitions->description =  $desc;
        $credit_transitions->deposit = $coin + $coin_charges;
        $credit_transitions->invoice_number = $invoice;
        $credit_transitions->reason = $charge['failure_code'];
        $credit_transitions->save();
    }
    /**
     * after stripe payment success
     *
     * @param [type] $charges
     * @param [type] $coin_charges
     * @param [type] $invoice
     * @return void
     */
    public function createStripeChargesTransaction($desc, $coin_charges, $invoice)
    {
        $credit_transition = new CreditTransaction;
        $credit_transition->user_id  = Auth::id();
        $credit_transition->date = now()->toDateTimeString();
        $credit_transition->type =  'Master/Visa';
        $credit_transition->channel =  'Online';
        $credit_transition->status =  'approved';
        $credit_transition->description =  $desc;
        $credit_transition->withdraw = $coin_charges;
        $credit_transition->invoice_number = $invoice;
        $credit_transition->save();
    }
    /**
     * Create on-hold transition for project budget
     *
     * @param [type] $project
     * @param [type] $freelancerBudget
     * @return void
     */
    public function createOnHoldTransaction($project, $freelancerBudget){
        $credit_transition = new CreditTransaction;
        $credit_transition->user_id  = Auth::id();
        $credit_transition->date = now()->toDateTimeString();
        $credit_transition->type =  'Master/Visa';
        $credit_transition->channel =  'Online';
        $credit_transition->status =  'approved';
        $credit_transition->description =  'Project Budget for ' . $project->project_ref;
        $credit_transition->withdraw = $freelancerBudget;
        $credit_transition->invoice_number = 'E' . $project->invoice_number;
        $credit_transition->save();
    }
    /**
     * Create withdraw for service charges
     *
     * @param [type] $project
     * @param [type] $commission
     * @return void
     */
    public function createWithdrawTransactionForServiceCharges($project, $commission){
        $credit_transition = new CreditTransaction;
        $credit_transition->user_id  = Auth::id();
        $credit_transition->date = now()->toDateTimeString();
        $credit_transition->type =  'Master/Visa';
        $credit_transition->channel =  'Online';
        $credit_transition->status =  'approved';
        $credit_transition->description =  'Service Charges for ' . $project->project_ref;
        $credit_transition->withdraw = $commission;
        $credit_transition->invoice_number = 'C' . $project->invoice_number;
        $credit_transition->save();     
    }
    /**
     * Create credit transaction after coin payment complete
     *
     * @param [type] $employer_id
     * @param [type] $invoice
     * @param [type] $project_budget
     * @param [type] $service_budget
     * @param [type] $project
     * @return void
     */
    public function createCoinPaymentTransaction($employer_id, $invoice_no, $project_budget, $service_budget, $project){
        $credit_transitions = new CreditTransaction;
        $credit_transitions->user_id  = $employer_id;
        $credit_transitions->date = now()->toDateTimeString();
        $credit_transitions->type =  'Coin';
        $credit_transitions->status =  'approved';
        $credit_transitions->description =  'Project Budget for ' . $project->project_ref;
        $credit_transitions->withdraw = $project_budget;
        $credit_transitions->invoice_number = 'E' . $invoice_no;
        $credit_transitions->save();

        // SY (4-07-2018): add service charges deduction transaction
        $credit_transitions = new CreditTransaction;
        $credit_transitions->user_id  = $employer_id;
        $credit_transitions->date = now()->toDateTimeString();
        $credit_transitions->type =  'Coin';
        $credit_transitions->status =  'approved';
        $credit_transitions->description =  'Service Charges for ' . $project->project_ref;
        $credit_transitions->withdraw = $service_budget;
        $credit_transitions->invoice_number = 'C' . $invoice_no;
        $credit_transitions->save();
    }
}
