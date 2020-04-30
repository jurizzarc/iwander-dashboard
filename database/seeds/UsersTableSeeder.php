<?php

use App\Role;
use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','admin')->first();
        $role_user = Role::where('name','user')->first();

          /*** ADMIN  ***/
        $admin = new User();
        $admin->name = 'Maeriel B';
        $admin->email = 'adminmaeriel@travelsite.ie';
        $admin->password = bcrypt('secret');
        $admin->save();

        $admin->roles()->attach($role_admin);

        $admin = new User();
        $admin->name = 'Jurizza C';
        $admin->email = 'adminjurizza@travelsite.ie';
        $admin->password = bcrypt('secret');
        $admin->save();

        $admin->roles()->attach($role_admin);

        /*** TEST USER ***/
        $user = new User();
        $user->name = 'Karen C';
        $user->email = 'kc@travelsite.ie';
        $user->password = bcrypt('secret');
        $user->save();

        $user->roles()->attach($role_user);
    }
}
