@extends('layouts/contentLayoutMaster')

@section('title', 'Create New Lead')

@section('title', 'Create Training')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{url('save_lead')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="phone" class="form-control" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Gender</label>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <label>
                                            <input type="radio" name="gender" value="0">
                                            Male
                                        </label>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <label>
                                            <input type="radio" name="gender" value="1">
                                            Female
                                        </label>
                                    </fieldset>
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection