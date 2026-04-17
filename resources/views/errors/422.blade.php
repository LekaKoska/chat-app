@extends('errors::minimal')

@section('title', __('Validation Failed'))
@section('code', '422')
@section('message', __('📝 The data you submitted failed validation. Please check the form and try again.'))
