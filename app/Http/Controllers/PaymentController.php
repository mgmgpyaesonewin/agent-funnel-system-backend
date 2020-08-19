<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Partner;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = Payment::with('partner')->paginate(20);

        return view('pages.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::all();

        return view('pages.payments.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        Payment::create($request->validated());

        return redirect('/payments');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $partners = Partner::all();

        return view('pages.payments.edit', compact('payment', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        return redirect('/payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect('/payments');
    }
}
