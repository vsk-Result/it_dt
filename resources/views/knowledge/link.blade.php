@extends('layouts.external_app')

@section('title', 'База знаний')
@section('page-title', 'База знаний')

@section('content')
    <h2>{{ $article->title }}</h2>
    <hr>
    {!! $article->content !!}
@endsection

@push('css')
    <link href="{{ asset('vendors/summernote/summernote.css') }}" rel="stylesheet">
    <style>
        /*img {*/
            /*width: 100% !important;*/
        /*}*/
        @media (max-width: 992px) {
            img {
                width: 100% !important;
            }
        }
    </style>
@endpush