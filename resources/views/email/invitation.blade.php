@extends('email.master')

@section('main-content')

<h2
    style="margin-top: 0;margin-bottom: 0;font-style: normal;font-weight: normal;font-size: 20px;line-height: 28px;text-align: center;">
    <strong>Dear <span style="color: #44a8c7;">{{ $name }}</span></strong>,
</h2>

<p style="{{ config('email-style.paragraph') }}">
    We have looked over your application and would like to invite you to attend the webinar on {{ $date }} at
    {{ $time }} via this link: {{ $url }}. Please click below buttons to respond to our inviation.
</p>

<table style="{{ config('email-style.body_action') }}" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <a href="{{ $accept_url }}"
                style="{{ config('email-style.fontFamily') }} {{ config('email-style.button') }} {{ config('email-style.button--blue') }} "
                class="button" target="_blank">
                Accept
            </a>
            <a href="{{ $reject_url }}"
                style="{{ config('email-style.fontFamily') }} {{ config('email-style.button') }} {{ config('email-style.button--red') }} "
                class="button" target="_blank">
                Reject
            </a>
        </td>
    </tr>
</table>

@endsection