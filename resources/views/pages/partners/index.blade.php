@extends('layouts/contentLayoutMaster')

@section('title', 'Partners\' Information')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title')
<div class="">Partners List</div>
@endsection

@section('content')
{{-- {{ dd($partners) }} --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('/partners') }}" method="get">
                    <div class="d-flex">
                        <div class="px-2">
                            <fieldset class="form-group">
                                <label for="name">Name</label> 
                                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ app('request')->input('name') }}">
                            </fieldset>
                        </div>
                        <div class="px-2">
                            <fieldset class="form-group">
                                <label for="partner">Company Name</label> 
                                <input type="text" name="company" placeholder="Company Name" class="form-control" value="{{ app('request')->input('company') }}">
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
                            <a href="{{url('partners/create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Company</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $partner)
                            <tr data-toggle="collapse" data-target="#accordion" class="clickable">
                                <th scope="row">{{$partner->id}}</th>
                                <td class="">{{$partner->pic_name}}</td>
                                <td class="">{{$partner->pic_email}}</td>
                                <td class="">{{$partner->pic_phone}}</td>
                                <td class="">{{$partner->company_name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('partners.edit',$partner->id)}}"
                                        class="btn btn-warning mr-4">Edit</a>
                                    <form method="POST" action="{{route('partners.destroy',$partner->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-secondary">Delete</button>
                                </td>
                                </form>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div id="accordion" class="collapse">
                                        @foreach ($partner->users as $user)
                                        <div>
                                            <span>{{ $user->name }}</span>
                                            <span>{{ $user->email }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $partners->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
@endsection