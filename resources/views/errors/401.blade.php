@extends('errors::minimal')

@section('title', __('Unauthorized Access'))
@section('code', '401')
@section('message', __('🔐 You need to be logged in to access this page. Please log in with your account.'))
