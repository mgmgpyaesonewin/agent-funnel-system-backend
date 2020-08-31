@extends('layouts/contentLayoutMaster')

@section('title', 'Payments Information')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title')
<div class="">Payments List</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('/payments') }}" method="get">
                    <div class="d-flex">
                        <div class="px-2">
                            <fieldset class="form-group">
                                <label for="partner">Partner Company Name</label> 
                                <input type="text" name="company" placeholder="Partner Company Name" class="form-control" value="{{ app('request')->input('company') }}">
                            </fieldset>
                        </div>
         
                    
                        <div class="px-2">
                            <div class="row mt-2">
                            <button type="submit" class="btn btn-primary"> Search </button>
                            </div>
                        </div>

                        </div>        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ml-auto">
                            <a href="{{url('payments/create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Partner</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <th scope="row">{{$payment->id}}</th>
                                <td class="">{{$payment->date}}</td>
                                <td class="">{{$payment->amount}}</td>
                                <td class="">{{$payment->partner->company_name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('payments.edit',$payment->id)}}"
                                        class="btn btn-warning mr-4">Edit</a>
                                    <form method="POST" action="{{route('payments.destroy',$payment->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-secondary">Delete</button>
                                </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $payments->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
@endsection