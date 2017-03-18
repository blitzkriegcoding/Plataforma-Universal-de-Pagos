<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\EmpresaUsuario;
use Auth;
use Hash;
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $primaryKey = 'id';
    protected $fillable = ['rut_usuario','name', 'email', 'password', 'active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function EmpresaUsuario()
    {
        return $this->hasOne(EmpresaUsuario::class, 'user_id',  'id');
    }

    public static function createNewUser($data)
    {
        try
        {

            $new_user = self::create([
                'rut_usuario'   => $data->rut_usuario,
                'name'          => $data->name,
                'email'         => $data->email,
                'password'      => bcrypt($data->password),
                'active'        => $data->active
            ]);
            $new_user['id_empresa'] = $data->id_empresa;
            EmpresaUsuario::associateEnterpriseUser($new_user);            
        }
        catch(Exception $e)
        {
            abort(500, 'No fue posible agregar al usuario');
            throw $e;
        }

        return $new_user;        
    }

    public static function updateUser($data)
    {
        $current_user = self::find(Auth::user()->id);
        if($current_user->rut_usuario != $data->rut_usuario)
        {
            if(self::where('rut_usuario', $data->rut_usuario))
            {

                return ['mensaje' => 'El RUT que trata de ingresar ya existe', 'clase' => 'danger'];
            }
        }
        if($current_user->email != $data->email)
        {
            $email = self::where('email', $data->email)->pluck('email');
            if($email != null)
            {
                
                return ['mensaje' => 'El email que trata de ingresar ya existe', 'clase' => 'danger'];
            }
        }

        $current_user->rut_usuario  = $data->rut_usuario;
        $current_user->name         = $data->name;
        $current_user->email        = $data->email;
        $current_user->save();
        return ['mensaje' => 'El usuario ha sido actualizado con éxito', 'clase' => 'success'];
    }

    public static function updatePassword($data)
    {    
        if (!Hash::check($data->old_password, self::find(Auth::user()->id)->password))
            return false;

        self::where('id', Auth::user()->id)
            ->update(['password' => bcrypt($data->password)]);
        return true;
    }
}
