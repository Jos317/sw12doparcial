<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'imagen',
        // 'estado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function diagrama()
    {
        return $this->hasMany('App\Models\Diagrama','user_id','id');
    }

    public function colabora()
    {
        return $this->hasMany('App\Models\Colabora','user_id','id');
    }

    public function diagramas_part(){
        return $this->belongsToMany(Diagrama::class, 'colabora');
    }

    public static function store(Request $request)
    {
        $user = new User();
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($request->hasFile('imagen')){
            $extension = $request->imagen->extension();
            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                $nombre = round(microtime(true)) . '.' . $extension;
                Storage::disk('public')->putFileAs('user', $request->imagen, $nombre);
                $path = 'storage/user/' . $nombre;
                $user->imagen = $path;
            }
        }
        $user->save();
    }

    public static function updates(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        if($request->password != "")
        {
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('imagen')){
            if($user->imagen){
                Storage::disk('public')->delete($user->imagen);
            }
            $extension = $request->imagen->extension();
            if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){
                $nombre = round(microtime(true)) . '.' . $extension;
                Storage::disk('public')->putFileAs('user', $request->imagen, $nombre);
                $path = 'storage/user/' . $nombre;
                $user->imagen = $path;
            }
        }
        $user->update();
    }
}
