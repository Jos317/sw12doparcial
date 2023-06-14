@extends('layouts.principal')

@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item active">Diagrama</li>
    <li class="breadcrumb-item active">Editar</li>
</ol>

<a type="button" class="btn btn-sm btn-warning" href="{{url('diagramas')}}">
    <i class="fas fa-arrow-left"></i>&nbsp;Atrás
</a>

<br>
<br>

<div class="panel panel-inverse">

    <div class="panel-heading">
        <h4 class="panel-title">Editando Diagrama</h4>
    </div>
    
    <div class="panel-body">
        <form action="{{url('diagrama/update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="form-group row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            <input type="hidden" name="id" id="id" value="{{$diagrama->id}}">
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                    <label class="form-label">Nombre del diagrama: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre..." value="{{$diagrama->nombre}}" required>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                    <label class="form-label">Descripcion del diagrama: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion..." value="{{$diagrama->descripcion}}" required>
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                    <label class="form-label">Cargar diagrama: </label>
                    <input type="file" accept=".c4"  class="form-control" name="url" id="url" alt="Click aquí para subir" 
                    title="Click aquí para subir">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <br>
                    <button class="btn btn-primary" type="submit">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
            
    </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush