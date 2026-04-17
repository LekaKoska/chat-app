@extends('errors::minimal')

@section('title', __('Session Expired'))
@section('code', '419')
@section('message', __('⏱️ Your session has expired for security reasons. Please refresh the page and try again.'))
