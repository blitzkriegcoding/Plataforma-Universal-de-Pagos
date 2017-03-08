<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();        
        $users = array(
        		['rut_usuario' => '76545638-K', 'name' => 'Guillermo Guillones','email'=> 'guillermo.guillones@afa-chile.cl', 'password'=> Hash::make('123456'), 'active' => 1],
                ['rut_usuario' => '76642030-3', 'name' => 'Judith Farías','email'=> 'judith.farias@autofin.cl', 'password'=> Hash::make('123456'), 'active' => 1],
        		//['name' => 'demo', 'email'=> 'demo@mail.com', 'password'=> Hash::make('123456')],
        	);





        $roles = [
            ['name' => 'admin', 'display_name' => 'Administrador', 'description' => 'Administrador del sistema'],
            ['name' => 'user',  'display_name' => 'Usuario estándar', 'description' => 'Usuario estándar'],
        ];

        $permissions = [
            // ['name' => 'create-enterprise', 'display_name' => 'Crear nuevas empresas', 'description' => 'Permite al usuario administrador crear nuevas empresas'],
            // ['name' => 'edit-enterprise', 'display_name' => 'Editar empresas', 'description' => 'Permite al usuario administrador editar empresas'],
            // ['name' => 'view-enterprise', 'display_name' => 'Visualizar empresas', 'description' => 'Permite al usuario visualizar empresa(s)'],
            // ['name' => 'manage-enterprises', 'display_name' => 'Mantenedor de empresas', 'description' => 'Permite al usuario administrador operaciones de Altas, Bajas y Modificaciones Empresas'],
            
            ['name' => 'view-quotes',   'display_name' => 'Consultar clientes', 'description' => 'Permite al usuario estándar la visualización y edición de cuotas'],
            ['name' => 'view-payments', 'display_name' => 'Consultar pagos',    'description' => 'Permite al usuario estándar la descarga de un archivo excel con las cuotas pagadas entre diversas fechas'],
        ];
 

        foreach($roles as $role)
        {            
            $r = new Role();
            $r->name =          $role['name'];
            $r->display_name =  $role['display_name'];
            $r->description =   $role['description'];
            $r->save();            
        }

        $user_role  = Role::where('name','=','user')->first();
        foreach($permissions as $permission)
        {
            
            $p = new Permission();
            $p->name = $permission['name'];
            $p->display_name = $permission['display_name'];
            $p->description = $permission['description'];
            $p->save();
            $user_role->attachPermission($p);
        }

        foreach($users as $user)
        {
            $new_user = User::create($user);
            // $user_data = User::where('email','like',$user['email'])->first();            
            // $user_data = User::where('email','like',$user['email'])->first();            
            $new_user->attachRole($user_role);
        }
        Model::reguard();

    }
}
