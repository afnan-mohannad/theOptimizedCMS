@extends('errors.minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('image', asset('assets/backend/login/media/auth/500-error.png'))