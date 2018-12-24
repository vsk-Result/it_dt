@extends('layouts.app')

@section('title', 'Объекты')
@section('page-title', 'Объекты')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('objects.create') }}" title="Добавить задачу" class="btn btn-sm bg-success-400 btn-icon rounded-round">
                <i class="icon-plus2"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    @foreach($objects->chunk(4) as $chunk_objects)
        <div class="row">
            @each('objects.partials.object_card', $chunk_objects, 'object')
        </div>
    @endforeach
@endsection