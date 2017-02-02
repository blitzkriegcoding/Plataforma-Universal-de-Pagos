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
        $users = array(
        		['name' => 'Pepe', 'email'=> 'pepe@gmail.com', 'password'=> Hash::make('123456')],
        		['name' => 'Grillo', 'email'=> 'grillo@gmail.com', 'password'=> Hash::make('123456')],
                ['name' => 'Lola', 'email'=> 'lola@gmail.com', 'password'=> Hash::make('123456')],
        		['name' => 'demo', 'email'=> 'demo@mail.com', 'password'=> Hash::make('123456')],

        	);

        foreach($users as $user)
        {
        	User::create($user);
        }

        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        $roles = [
            ['name' => 'admin', 'display_name' => 'Administrador', 'description' => 'Administrador del sistema'],
            ['name' => 'user', 'display_name' => 'Usuario de pruebas', 'description' => 'Con propositos de prueba'],
        ];

        $permissions = [
            ['name' => 'create-enterprise', 'display_name' => 'Crear nuevas empresas', 'description' => 'Permite al usuario administrador crear nuevas empresas'],
            ['name' => 'edit-enterprise', 'display_name' => 'Editar empresas', 'description' => 'Permite al usuario administrador editar empresas'],
            ['name' => 'view-enterprise', 'display_name' => 'Visualizar empresas', 'description' => 'Permite al usuario visualizar empresa(s)'],
            ['name' => 'manage-enterprises', 'display_name' => 'Mantenedor de empresas', 'description' => 'Permite al usuario administrador operaciones de Altas, Bajas y Modificaciones Empresas'],
        ];
        $user = User::where('email','=','pepe@gmail.com')->first();
        $r = Role::where('name','=','admin')->first();

        foreach($roles as $role)
        {            
            $r = new Role();
            $r->name = $role['name'];
            $r->display_name = $role['display_name'];
            $r->description = $role['description'];
            $r->save();
            $user->attachRole($r);
        }

        foreach($permissions as $permission)
        {
            
            $p = new Permission();
            $p->name = $permission['name'];
            $p->display_name = $permission['display_name'];
            $p->description = $permission['description'];
            $p->save();

            $r->attachPermission($p);
        }

        Model::reguard();

    }
}
