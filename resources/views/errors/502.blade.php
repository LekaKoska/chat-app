@extends('errors::minimal')

@section('title', __('Bad Gateway'))
@section('code', '502')
@section('message', __('🌐 Received an invalid response from an upstream server. Please try again in a few moments.'))
