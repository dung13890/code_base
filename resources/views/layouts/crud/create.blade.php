@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.create'))

@section('page-content')
<div class="content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $heading or __('repositories.create') }}</div>
            <div class="panel-body">
                {{ Form::open(['url' => route("backend.{$resource}.store"), 'role'  => 'form', 'files' => true, 'autocomplete'=>'off']) }}
                    @include("backend.{$resource}._form")
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
