<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\EmpresaUsuario;
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
}
