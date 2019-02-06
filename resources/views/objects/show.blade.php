@extends('layouts.app')

@section('title', 'Объект ' . $object->getFullName())
@section('page-title', 'Объекты -  ' . $object->getFullName())

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('objects.edit', $object->id) }}" title="Изменить объект" class="btn btn-sm bg-primary-400 btn-icon rounded-round">
                <i class="icon-pencil5"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="text-center mb-3 py-2">
        <h4 class="font-weight-semibold mb-1">{{ $object->getFullName() }}</h4>
        <span id="object-address" class="text-muted d-block">{{ $object->address }}</span>
    </div>

    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="w-100 overflow-auto order-2 order-md-1">
            @if ($object->infoparts->count() > 0)
                <div class="card-group-control card-group-control-right">
                    @each('objects.partials.infopart', $object->infoparts, 'infopart')
                </div>
            @else
                <div class="card card-body">
                    <p class="font-weight-bold pb-2">Блоки информации</p>
                    <p>Данные отсутствуют</p>
                </div>
            @endif
        </div>

        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 wmin-sm-300 order-1 order-md-2 sidebar-expand-lg d-block">
            <div class="sidebar-content">
                @include('objects.partials.persons')
                @include('objects.partials.gallery')

                @if (!empty($object->address))
                    @include('objects.partials.map')
                @endif
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendors/lightGallery/dist/css/lightgallery.min.css') }}">
    <link href="{{ asset('vendors/fileuploader/src/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/fileuploader/src/css/jquery.fileuploader-theme-thumbnails.css') }}" rel="stylesheet">
    <style>
        p { margin-bottom: 0; }
        .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item {
            width: calc(54% - 16px);
            padding-top: 35%;
            margin: 0;
            margin-bottom: 10px;
        }
        .fileuploader {
             background: #fff;
        }
        @media (max-width: 480px) {
            .fileuploader-theme-thumbnails .fileuploader-thumbnails-input, .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item {
                padding-top: 40%;
            }
        }
        .fileuploader-theme-thumbnails .fileuploader-item .content-holder {
            background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.12) 100%);
            background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.12) 100%);
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0, 0, 0, 0.12) 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/lightGallery/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-fullscreen.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-zoom.min.js') }}"></script>
    <script src="{{ asset('vendors/fileuploader/src/jquery.fileuploader.min.js') }}"></script>
    <script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
    <script src="{{ asset('js/partials/yamap.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".lightgallery").lightGallery({
                selector: '.light-item',
                thumbnail: true,
                zoom: true,
                fullscreen: true
            });
        });
    </script>


@endpush