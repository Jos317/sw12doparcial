@extends('layouts.principal')

@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item">
        <a href="{{url('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Diagramas</li>
</ol>
<h1 class="page-header">Diagramas</h1>

<div class="panel panel-inverse">

    <div class="panel-heading">
        <h4 class="panel-title">Listado de Diagramas de tu usuario</h4>
        <div class="panel-heading-btn">
            <a href="{{url('diagrama/create')}}" class="btn btn-xs btn-icon btn-primary" title="Añadir Nuevo Diagrama"><i
                    class="fa fa-plus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                    class="fa fa-expand"></i></a>
            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                    class="fa fa-redo"></i></a> --}}
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                    class="fa fa-minus"></i></a>
            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                    class="fa fa-times"></i></a> --}}
        </div>
    </div>


    <div class="panel-body" id="cuerpo">
        @include('diagrama.datos')
    </div>
</div>

@endsection
@push('scripts')
@endpush