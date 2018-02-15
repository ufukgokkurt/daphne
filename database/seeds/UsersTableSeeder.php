<?php

use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();

        //varsayılan izinler alınıyor
        $permission=[];
        foreach (config('genel_ayarlar.izinler') as $key=>$value) {
            $permission[$key]=true;
        }

        $role = [
            'name'        => 'Admin',
            'slug'        => 'admin',
            'permissions' => $permission,

        ];

        $adminRole       = Sentinel::getRoleRepository()->createModel()->fill($role)->save();
        $subscribersRole = [
            'name'        => 'User',
            'slug'        => 'user',
            'permissions' => [],
        ];
        Sentinel::getRoleRepository()->createModel()->fill($subscribersRole)->save();

        $admin = [
            'first_name'=>'Ufuk GÖKKURT',
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ];
        $adminUser = Sentinel::registerAndActivate($admin);
        $adminUser->roles()->attach($adminRole);
    }
}
