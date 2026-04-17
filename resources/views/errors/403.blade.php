@extends('errors::minimal')

@section('title', __('Forbidden - Access Denied'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: '🚫 You do not have permission to access this resource. If you believe this is a mistake, please contact support.'))
