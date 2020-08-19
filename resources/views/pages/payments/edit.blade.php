@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Edit Payments')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('payments.update',$payment->id)}}" method="POST">
                        @csrf
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label>Partner</label>
                            <select name="partner_id">
                                @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}"
                                    selected="{{ $partner->id == $payment->partner_id }}">
                                    {{ $partner->company_name }}</option>
                                @endforeach
                            </select>
                            @error('partner_id')
                            <span class="text-danger">{{ $errors->first('partner_id') }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" value="{{ $payment->date }}" />
                            @error('date')
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" value="{{ $payment->amount }}" />
                            @error('amount')
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection