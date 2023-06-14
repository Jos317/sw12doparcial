<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Diagrama extends Model
{
    use HasFactory;
    protected $table = 'diagrama';
    protected $fillable = ['nombre', 'descripcion', 'contenido','user_id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function colabora()
    {
        return $this->hasMany('App\Models\Colabora','diagrama_id','id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'colabora');
    }

    public static function store(Request $request){
        $diagrama = new Diagrama();
        $diagrama->nombre = $request->nombre;
        $diagrama->descripcion = $request->descripcion;
        $diagrama->user_id = Auth::user()->id;
        $diagrama->contenido = '';
        $diagrama->save();
        DB::table('colabora')->insert([
            'user_id' => $diagrama->user_id,
            'diagrama_id' => $diagrama->id
        ]);
    }

    public static function invitar($id, $diagrama_id){
        DB::table('colabora')->insert([
            'user_id' => $id,
            'diagrama_id' => $diagrama_id
        ]);
    }

    public static function banear($id, $diagrama_id){
        $relacion = Colabora::where('diagrama_id', $diagrama_id)->where('user_id', $id)->first();
        $relacion->delete();
    }

    public static function updates(Request $request){
        $diagrama = Diagrama::findOrFail($request->id);
        $diagrama->nombre = $request->nombre;
        $diagrama->descripcion = $request->descripcion;
        $fp = fopen($request->url, "r");
        while (!feof($fp)) {
            $diagrama->contenido = fgets($fp);
        }
        $diagrama->update();
    }

}
