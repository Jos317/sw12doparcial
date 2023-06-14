@extends('layouts.principal')

@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item active">Diagrama</li>
    <li class="breadcrumb-item active">Crear</li>
</ol>

<a type="button" class="btn btn-sm btn-warning" href="{{url('diagramas')}}">
    <i class="fas fa-arrow-left"></i>&nbsp;Atrás
</a>

<br>
<br>

<div class="panel panel-inverse">

    <div class="panel-heading">
        <h4 class="panel-title">Creando Diagrama</h4>
    </div>
    
    <div class="panel-body">
        <form action="{{url('diagrama/store')}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-group row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                    <label class="form-label">Nombre del diagrama: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre..." value="{{old('nota')}}" required>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                    <label class="form-label">Descripcion del diagrama: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion..." value="{{old('nota')}}" required>
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