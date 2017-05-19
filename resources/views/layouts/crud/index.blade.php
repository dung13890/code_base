@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.index'))

@push('prestyles')
{{ HTML::style('vendor/datatables-bs/css/dataTables.bootstrap.min.css') }}
@endpush

@push('prescripts')
{{ HTML::script("vendor/datatables/js/jquery.dataTables.min.js") }}
{{ HTML::script("vendor/datatables-bs/js/dataTables.bootstrap.min.js") }}
<script>
    var flash_message = '{!! session("flash_message") !!}';
    var crud = new CRUD("{{ $resource }}", {});
    crud.flash(flash_message);
    crud.setDatatables(columns, searches).index();
    
    $('#search').on('click', function (e) {
        e.preventDefault();
        crud.refresh();
    });
    
    $('#reset').on('click', function (e) {
        e.preventDefault();
        $('input').val('');
        crud.refresh();
    });
</script>
@endpush

@section('page-content')

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if (Route::has("backend.{$resource}.create"))
                    <a href='{{ route("backend.{$resource}.create") }}' class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('repositories.create') }}</a>
                    @endif
                </div>
                <div class="panel-body">
                    @stack('index-table-filter')
                    <div class="table-responsive">
                        <table id="table-index" class="table table-bordered table-hover" width="100%">
                            @stack('index-table-thead')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
