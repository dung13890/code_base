@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.edit'))

@section('page-content')
<div class="content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $heading or __('repositories.edit') }}</div>
            <div class="panel-body">
                {{ Form::model($item, [
                    'url' => route("backend.{$resource}.update", $item),
                    'role'  => 'form', 'files' => true,
                    'autocomplete'=>'off', 'method' => 'PATCH',
                ]) }}
                    @include("backend.{$resource}._form")
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
