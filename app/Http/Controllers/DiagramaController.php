<?php

namespace App\Http\Controllers;

use App\Events\DiagramaSent;
use App\Models\Colabora;
use App\Models\Diagrama;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use ZipArchive;
use File;

class DiagramaController extends Controller
{
    public function index(){
        // $diagramas = Diagrama::where('idusuario', Auth::user()->id)->paginate(10);
        // $diagramas_no_mios = Colabora::where('idusuario', Auth::user()->id);
        $diagramas = Auth::user()->diagramas_part()->paginate(10);

        //dd(json_decode(json_encode($diagramas)));
        return view('diagrama.index', compact('diagramas'));
    }

    public function diagramar($id)
    {
        $diagrama = Diagrama::find($id);
        $permiso = Auth::user()->colabora()->where('diagrama_id', $diagrama->id)->first();
        $permiso = $permiso->habilitado;
        return view('diagrama.diagramar', compact('diagrama', 'permiso'));
    }

    public function descargar($id){
        $diagrama = Diagrama::find($id);
        $contenido = $diagrama->contenido;
        $path = 'diagrama.c4';
        $th = fopen("diagrama.c4", "w");
        fclose($th);
        $ar = fopen("diagrama.c4", "a") or die("Error al crear");
        fwrite($ar, $contenido);
        fclose($ar);
        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function create()
    {
        return view('diagrama.create');
    }

    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        try {
            DB::beginTransaction();
            Diagrama::store($request);
            DB::commit();
            return redirect()->to('diagramas')->with('message', 'Diagrama agregado exitosamente!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    protected function storeValidator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required'],
            'descripcion' => ['required'],
        ],[
            'nombre.required' => 'El campo nombre es requerido.',
            'dexcripcion.required' => 'El campo descripcion es requerido.',
        ]);
    }

    public function edit($id)
    {
        $diagrama = Diagrama::find($id);
        return view('diagrama.edit', compact('diagrama'));
    }

    public function usuario($id)
    {
        $user = User::where('id', '!=' ,Auth::user()->id)->paginate(10);
        $diagrama = Diagrama::find($id);
        return view('diagrama.usuario', compact('user', 'diagrama'));
    }

    public function invitar($id, $diagrama_id)
    {
        try {
            DB::beginTransaction();
            Diagrama::invitar($id, $diagrama_id);
            DB::commit();
            return redirect()->back()->with('message', 'Se agrego el usuario correctamente!!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
    }

    public function banear($id, $diagrama_id)
    {
        try {
            DB::beginTransaction();
            Diagrama::banear($id, $diagrama_id);
            DB::commit();
            return redirect()->back()->with('message', 'Se removio al usuario del diagrama!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $this->updateValidator($request->all())->validate();
        try {
            DB::beginTransaction();
            Diagrama::updates($request);
            DB::commit();
            return redirect('diagramas')->with(['message' => 'Diagrama actualizado exitosamente!!']);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required'],
            'descripcion' => ['required'],
        ],[
            'nombre.required' => 'El campo nombre es requerido.',
            'dexcripcion.required' => 'El campo descripcion es requerido.',
        ]);
    }

    public function guardar(Request $request)
    {
        $diagrama = Diagrama::findOrFail($request->input('id'));
        $diagrama->contenido = $request->input('contenido');
        $diagrama->update();
        broadcast(new DiagramaSent($diagrama))->toOthers();
        return response()->json(['msm' => 'msmsms'], 200);
    }

    public function generarScriptForPostgreSQL($id) {
        $diagrama = Diagrama::find($id);
        $contenido = $diagrama->contenido;
        $data = json_decode($contenido, true);
        $script = '';
        

        foreach ($data['cells'] as $cell) {
            if ($cell['type'] === 'uml.Class') {
                $tableName = $cell['name'];
                $tableAttributes = $cell['attributes'];
    
                $columns = [];
                foreach ($tableAttributes as $attribute) {
                    $attribute = str_replace('DOUBLE', 'DOUBLE PRECISION', $attribute);
                    $columns[] = $attribute;
                }
    
                // Agregar columna id con tipo serial como clave primaria
                array_unshift($columns, "  id SERIAL PRIMARY KEY");
    
                $columnsStr = implode(",\n  ", $columns);
                $script .= "CREATE TABLE $tableName (\n$columnsStr\n);\n";
            } elseif ($cell['type'] === 'app.Link') {
                $sourceId = $cell['source']['id'];
                $targetId = $cell['target']['id'];
    
                $sourceTable = '';
                $targetTable = '';
    
                // Buscar el nombre de las tablas correspondientes a los IDs de origen y destino
                foreach ($data['cells'] as $table) {
                    if ($table['id'] === $sourceId) {
                        $sourceTable = $table['name'];
                    } elseif ($table['id'] === $targetId) {
                        $targetTable = $table['name'];
                    }
                }
    
                if (!empty($sourceTable) && !empty($targetTable)) {
                    $script .= "ALTER TABLE $targetTable ADD COLUMN $sourceTable"."_id INT;\n";
                    $script .= "ALTER TABLE $targetTable ADD CONSTRAINT fk_$sourceTable"."_$targetTable FOREIGN KEY ($sourceTable"."_id) REFERENCES $sourceTable(id);\n";
                }
            }
        }

        $path = 'postgresql.txt';
        // dd(json_decode(json_encode($path)));
        file_put_contents($path, $script);
        return response()->download($path);
    }

    public function generarScriptForSQLServer($id) {
        $diagrama = Diagrama::find($id);
        $contenido = $diagrama->contenido;
        $data = json_decode($contenido, true);
        $script = "USE master;\nGO\nCREATE DATABASE $diagrama->nombre;\nGO\nUSE $diagrama->nombre;\nGO\n";
        
    
        foreach ($data['cells'] as $cell) {
            if ($cell['type'] === 'uml.Class') {
                $tableName = $cell['name'];
                $tableAttributes = $cell['attributes'];
    
                $columns = [];
                foreach ($tableAttributes as $attribute) {
                    $columns[] = $attribute;
                }
    
                // Agregar columna id con tipo int y autoincremento como clave primaria
                array_unshift($columns, "   id INT IDENTITY(1,1) PRIMARY KEY");
    
                $columnsStr = implode(",\n   ", $columns);
                $script .= "CREATE TABLE $tableName (\n$columnsStr\n);\n";
            } elseif ($cell['type'] === 'app.Link') {
                $sourceId = $cell['source']['id'];
                $targetId = $cell['target']['id'];
    
                $sourceTable = '';
                $targetTable = '';
    
                // Buscar el nombre de las tablas correspondientes a los IDs de origen y destino
                foreach ($data['cells'] as $table) {
                    if ($table['id'] === $sourceId) {
                        $sourceTable = $table['name'];
                    } elseif ($table['id'] === $targetId) {
                        $targetTable = $table['name'];
                    }
                }
    
                if (!empty($sourceTable) && !empty($targetTable)) {
                    $script .= "ALTER TABLE $targetTable ADD $sourceTable"."_id INT;\n";
                    $script .= "ALTER TABLE $targetTable ADD CONSTRAINT fk_$sourceTable"."_$targetTable FOREIGN KEY ($sourceTable"."_id) REFERENCES $sourceTable(id);\n";
                }
            }
        }
    
        $path = 'sqlserver.txt';
        file_put_contents($path, $script);
        return response()->download($path);
    }

    public function generarScriptForSQLite($id) {
        $diagrama = Diagrama::find($id);
        $contenido = $diagrama->contenido;
        $data = json_decode($contenido, true);
        $script = '';
    
        foreach ($data['cells'] as $cell) {
            if ($cell['type'] === 'uml.Class') {
                $tableName = $cell['name'];
                $tableAttributes = $cell['attributes'];
    
                $columns = [];
                foreach ($tableAttributes as $attribute) {
                    $attribute = str_replace('DOUBLE', 'REAL', $attribute);
                    $attribute = str_replace('DATE', 'TEXT', $attribute);
                    $columns[] = $attribute;
                }
    
                // Agregar columna id con tipo INTEGER como clave primaria AUTOINCREMENT
                array_unshift($columns, "  id INTEGER PRIMARY KEY AUTOINCREMENT");
    
                $columnsStr = implode(",\n  ", $columns);
    
                $foreignKey = '';
                foreach ($data['cells'] as $link) {
                    if ($link['type'] === 'app.Link' && $link['target']['id'] === $cell['id']) {
                        $sourceId = $link['source']['id'];
                        $sourceTable = '';
                        foreach ($data['cells'] as $table) {
                            if ($table['id'] === $sourceId) {
                                $sourceTable = $table['name'];
                                break;
                            }
                        }
                        if (!empty($sourceTable)) {
                            $foreignKey = "  $sourceTable"."_id INTEGER,\n  FOREIGN KEY ($sourceTable"."_id) REFERENCES $sourceTable(id)";
                            break;
                        }
                    }
                }
    
                $script .= "CREATE TABLE $tableName (\n$columnsStr";
                if (!empty($foreignKey)) {
                    $script .= ",\n$foreignKey";
                }
                $script .= "\n);\n";
            }
        }
    
        $path = 'sqlite.txt';
        file_put_contents($path, $script);
        return response()->download($path);
    }

    public function generate($id) {
        $diagrama = Diagrama::find($id);
        $contenido = $diagrama->contenido;
        $data = json_decode($contenido, true);
        $html = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css">
                <link rel="icon" type="image/ico" href="images/icon_page.png" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="CRUD dinamico con HTMLS, CSS and JS">
                <link href="https://fonts.googleapis.com/css?family=Quicksand:600&display=swap" rel="stylesheet">
                <title>Crud</title>
            </head>
            <body>
            <header class="header" id="header">
                <figure class="logo">
                <img src="icon_page.png" height="60" alt="Logo de la pagina" />
                </figure>
                <nav class="menu">
                <ol>
                    <li>
                    <a class="link" href="#header">CRUD</a>
                    </li>
                </ol>
                </nav>
            </header>';

        foreach ($data['cells'] as $cell) {
            if ($cell['type'] === 'uml.Class') {
                $nombreTabla = $cell['name'];
                $atributos = $cell['attributes'];
        
                $html .= '
                    <h1>' . $nombreTabla . '</h1>
                        <form onsubmit="event.preventDefault();onSubmit();" autocomplete="off">
                        <div class="tablita">
                            <table class="tabla" id="tabla">
                            <thead>
                                <tr>';
        
                foreach ($atributos as $atributo) {
                    $palabras = explode(" ", $atributo);
                    $primeraPalabra = $palabras[0];
                    $html .= '<th>' . $primeraPalabra . '</th>';
                }

                $html .= '<th>Opciones</th>';
        
                $html .= '</tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <br/>
                        <br/>
                        <div class="caja">';
                
                foreach ($atributos as $atributo) {
                    $palabras = explode(" ", $atributo);
                    $primeraPalabra = $palabras[0];
                    $html .= '<label for="' . $primeraPalabra . '">' . $primeraPalabra . '</label> <input type="text" id="' . $primeraPalabra . '" placeholder="Escriba aquí" required>';
                }
                
                $html .= '</div>
                        <br/>
                        <input class="submit" type="submit" value="Escribir">
                        </form>';
            }
        }
        $html .='
            </body>
            <script type="text/javascript" src="crud.js"></script>
            </html>
        ';
    
        $directoryPath = 'myFiles';
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $filePath = $directoryPath . '/index.html';
        file_put_contents($filePath, $html);

        return $filePath;
    }

    public function generarScriptForVista($id) {
        $diagrama = Diagrama::find($id);
        $nombre = $diagrama->nombre;
        $hola = $this->generate($id);
        $zip = new \ZipArchive;
        $filename = 'CRUD.zip';
        $folderName = $nombre;
    
        if ($zip->open(public_path($filename), \ZipArchive::CREATE) === true) {
            $files = \File::files(public_path('myFiles'));
    
            foreach ($files as $key => $value) {
                $relativeName = $folderName . '/' . basename($value);
                $zip->addFile($value, $relativeName);
            }
    
            $zip->close();
        }

        // Eliminar el archivo index.html después de enviar el archivo ZIP
        $indexPath = public_path('myFiles/index.html');
        if (file_exists($indexPath)) {
            unlink($indexPath);
        }
    
        return response()->download(public_path($filename));
    }
}
