@extends('email.master')

@section('main-content')

<h2
    style="margin-top: 0;margin-bottom: 0;font-style: normal;font-weight: normal;font-size: 20px;line-height: 28px;text-align: center;">
    <strong>Dear <span style="color: #44a8c7;">{{ $name }}</span></strong>,
</h2>

<p style="{{ config('email-style.paragraph') }}">
    {{ $notification_text }}
</p>

@endsection