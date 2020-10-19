@extends('layouts/contentLayoutMaster')

@section('title', 'Edit BOP Session')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="sessionTitle" class="col-form-label">
                                <strong>Title</strong>
                            </label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Session Title"
                                value="{{ $session->title }}">
                            @error('title')
                            <span class="text-danger">
                                {{$errors->first('title')}}
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sessionDate" class="col-form-label">
                                        <strong>Date</strong>
                                    </label>
                                    <v-bop-sessions-date-time-picker format="DD-MM-YYYY" type="date"
                                        placeholder="Choose Session Date" name="date" :edit="true"
                                        data-value="{{ $session->getDate() }}" />
                                    @error('date')
                                    <span class="text-danger">
                                        {{$errors->first('title')}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sessionTime" class="col-form-label">
                                        <strong>Time</strong>
                                    </label>
                                    <v-bop-sessions-date-time-picker format="hh:mm A" type="time"
                                        placeholder="Choose Session Time" name="time" :edit="true"
                                        data-value="{{ $session->getTime() }}" />
                                    @error('time')
                                    <span class="text-danger">
                                        {{$errors->first('time')}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sessionURL" class="col-form-label">
                                <strong>URL</strong>
                            </label>
                            <input type="text" class="form-control" name="url" placeholder="Enter Session URL"
                                value="{{ $session->url }}">
                            @error('url')
                            <span class="text-danger">
                                {{$errors->first('url')}}
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection