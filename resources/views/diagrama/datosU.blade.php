<div class="table-responsive">
    <table id="data-table-default" class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th style="text-align: center">Nombres</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Opciones</th>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    {{-- <td>{{$item->id}}</td> --}}
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->email}}</td>
                    <td style="text-align: center">
                        @if ($diagrama->usuarios->contains($item->id))
                            <a class="btn btn-sm btn-red me-1" href="{{url('diagrama/usuarios/banear/'.$item->id.'/'.$diagrama->id)}}">
                                <i class="fas fa-circle-xmark" aria-hidden="true"></i> Banear
                            </a>
                        @else
                            <a class="btn btn-sm btn-primary me-1" href="{{url('diagrama/usuarios/invitar/'.$item->id.'/'.$diagrama->id)}}">
                                <i class="fas fa-file-import"></i> Invitar
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $user->links() }}
</div>