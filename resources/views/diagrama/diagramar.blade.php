@extends('layouts.principal2')

@section('app')

<div class="panel panel-inverse">

    <div class="panel-heading">
        <h4 class="panel-title">Diagrama: {{ $diagrama->nombre }}</h4>
        <div class="panel-heading-btn">
            <a href="{{url('diagramas')}}" class="btn btn-xs btn-icon btn-gray" title="Volver"><i
                class="fas fa-angles-left"></i>
            </a>
            <a href="{{url('diagrama/descargar/'.$diagrama->id)}}" class="btn btn-xs btn-icon btn-warning" title="Descargar en formato c4"><i
                class="fas fa-file-arrow-down"></i>
            </a>
            <a href="{{url('diagrama/generarScriptForPostgreSQL/'.$diagrama->id)}}" class="btn btn-xs btn-icon btn-info" title="Generar código para PostgreSQL">
                <img src="{{ asset('/assets/img/postgresql.png') }}" width="15" alt="Generar código para PostgreSQL">
            </a>
            <a href="{{url('diagrama/generarScriptForSQLServer/'.$diagrama->id)}}" class="btn btn-xs btn-icon btn-white" title="Generar codigo para SQL Server">
                <img src="{{ asset('/assets/img/sqlserver.png') }}" width="15" alt="Generar codigo para SQL Server">
            </a>
            <a href="{{url('diagrama/generarScriptForSQLite/'.$diagrama->id)}}" class="btn btn-xs btn-icon btn-primary" title="Generar codigo para SQLite"><i
                class="fas fa-database"></i>
            </a>
            <a href="{{url('diagrama/generarScriptForVista/'.$diagrama->id)}}" class="btn btn-xs btn-icon btn-purple" title="Generar codigo para CRUD"><i
                    class="fas fa-file-zipper"></i>
            </a>
        </div>
    </div>

</div>

<div id="app" class="joint-app joint-theme-moder">
    <div class="app-header">
        <div class="toolbar-container"></div>
    </div>
    <div class="app-body">
        <div class="stencil-container"></div>
        <div class="paper-container"></div>
        <div class="inspector-container" style="background-color: rgba(23,67,122,255)"></div>
        <div class="navigator-container"></div>
    </div>
</div>

<textarea id="contenido" hidden cols="30" rows="10">{{ $diagrama->contenido }}</textarea>
<input name="diagrama_id" type="text" value="{{ $diagrama->id }}" hidden>
 <input name="permiso" type="text" value="{{ $permiso }}" hidden> 
<input name="persona" type="text" value="{{ asset('assets/image-person.svg') }}" hidden>
<input name="persona2" type="text" value="{{ asset('assets/image-person-2.svg') }}" hidden>
<input name="cylinder_horizontal" type="text" value="{{ asset('assets/image-cylinder-horizontal.svg') }}" hidden>
<input name="data_container" type="text" value="{{ asset('assets/image-data-container.svg') }}" hidden>
<input name="hexagon" type="text" value="{{ asset('assets/image-hexagon.svg') }}" hidden>
<input name="web_browser" type="text" value="{{ asset('assets/image-web-browser.svg') }}" hidden>
<input name="transparent_icon" type="text" value="{{ asset('assets/transparent-icon.svg') }}" hidden>
<input name="no_color_icon" type="text" value="{{ asset('assets/no-color-icon.svg') }}" hidden> 
<input name="auth_id" type="text" value="{{ Auth::user()->id }}" hidden>
@push('scripts')
    <script>
        var diagrama_id = $("input[name=diagrama_id]").val();
        var contenido = document.getElementById("contenido").value;
        var permiso = $("input[name=permiso]").val()
        var person = $("input[name=persona]").val();
        var person2 = $("input[name=persona2]").val();
        var cylinder_horizontal = $("input[name=cylinder_horizontal]").val();
        var data_container = $("input[name=data_container]").val();
        var hexagon = $("input[name=hexagon]").val();
        var web_browser = $("input[name=web_browser]").val();
        var transparent_icon = $("input[name=transparent_icon]").val();
        var no_color_icon = $("input[name=no_color_icon]").val();
        var auth_id = $("input[name=auth_id]").val();
        // console.log(contenido)
        // console.log(window.location.pathname.substr(11));
        function guardar(paper) {
            axios.post("/diagramas/guardar", {
                    id: diagrama_id,
                    contenido: paper
                })
                .then((res) => {
                    /* console.log(res.data) */
                })
                .catch((error) => {
                    console.log(error);
                    Swal.fire(`Ocurrió un problema, por favor inténtalo más tarde.`)
                });
        };
    </script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/lodash.js') }}"></script>
    <script src="{{ asset('js/backbone.js') }}"></script>
    <script src="{{ asset('js/graphlib.core.js') }}"></script>
    <script src="{{ asset('js/dagre.core.js') }}"></script>
    <script src="{{ asset('js/rappid.js') }}"></script>

    <script src="{{ asset('js/config/halo.js') }}"></script>
    <script src="{{ asset('js/config/selection.js') }}"></script>
    <script src="{{ asset('js/config/inspector.js') }}"></script>
    <script src="{{ asset('js/config/stencil.js') }}"></script>
    <script src="{{ asset('js/config/toolbar.js') }}"></script>
    <script src="{{ asset('js/config/sample-graphs.js') }}"></script>
    <script src="{{ asset('js/views/main.js') }}"></script>
    <script src="{{ asset('js/views/theme-picker.js') }}"></script>
    <script src="{{ asset('js/models/joint.shapes.app.js') }}"></script>
    <script src="{{ asset('js/views/navigator.js') }}"></script>
    <script>
        joint.setTheme('modern');
        app = new App.MainView({
            el: '#app'
        });
        themePicker = new App.ThemePicker({
            mainView: app
        });
        themePicker.render().$el.appendTo(document.body);
        window.addEventListener('load', function() {
            /* console.log(contenido.length) */
            if (contenido.length > 3) {
                app.graph.fromJSON(JSON.parse(contenido));
            }
        });

        Echo.join(`diagramar.${diagrama_id}`).listen('DiagramaSent', (e) => {
                app.graph.fromJSON(JSON.parse(e.diagrama.contenido));
            })
            .here(users => {
                for (let index = 0; index < users.length; index++) {
                    if (users[index].id != auth_id) {
                        let id = `user_${users[index].id}`;
                        let claseU = document.getElementById(`${id}`);
                        claseU.className = 'badge bg-green';
                    }
                }
            })
            .joining(user => {

                let id = `user_${user.id}`;
                let claseU = document.getElementById(id);
                claseU.className = 'badge bg-green';

            })
            .leaving(user => {
                let id = `user_${user.id}`;
                let claseU = document.getElementById(id);
                claseU.className = 'badge bg-red';
            });
    </script>

    <!-- Local file warning: -->
    <div id="message-fs" style="display: none;">
        <p>The application was open locally using the file protocol. It is recommended to access it trough a <b>Web
                server</b>.</p>
        <p>Please see <a href="README.md">instructions</a>.</p>
    </div>
    <script>
        (function() {
            var fs = (document.location.protocol === 'file:');
            var ff = (navigator.userAgent.toLowerCase().indexOf('firefox') !== -1);
            if (fs && !ff) {
                (new joint.ui.Dialog({
                    width: 300,
                    type: 'alert',
                    title: 'Local File',
                    content: $('#message-fs').show()
                })).open();
            }
        })();
    </script>
@endpush
@endsection