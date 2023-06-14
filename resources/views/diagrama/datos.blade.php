<div class="table-responsive">
    <table id="data-table-default" class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th style="text-align: center">#</th>
                <th style="text-align: center">Nombre</th>
                <th style="text-align: center">Descripcion</th>
                <th style="text-align: center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if ($diagramas == []) --}}
            @foreach ($diagramas as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td style="text-align: center">
                        @if ($item->user_id == auth()->user()->id )
                            <a class="btn btn-sm btn-primary me-1" href="{{url('diagrama/edit/'.$item->id)}}">
                                <i class="fas fa-pencil-alt fa-fw"></i> Editar
                            </a>
                            <a class="btn btn-sm btn-yellow me-1" href="{{url('diagrama/usuarios/'.$item->id)}}">
                                <i class="fas fa-cog fa-spin"></i> Administrar acceso
                            </a>
                        @endif
                        <a class="btn btn-sm btn-green me-1" href="{{url('diagramar/'.$item->id)}}">
                            <i class="fas fa-diagram-project"></i> Ingresar al diagrama
                        </a>
                    </td>
                </tr>
            @endforeach
            {{-- @else
                <td colspan="4" style="text-align: center;">No hay diagramas creados por este usuario</td>
            @endif --}}
        </tbody>
    </table>
</div>
<div>
    {{ $diagramas->links() }}
</div>