<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'User')->first();
        $role_manager  = Role::where('name', 'Admin')->first();

        $employee = new User();
        $employee->name     = 'Admin';
        $employee->username  = 'admin123';
        $employee->email    = 'admin123@example.com';
        $employee->password = bcrypt('admin123');
        $employee->save();
        $employee->roles()->attach($role_employee);

        $manager = new User();
        $manager->name      = 'User';
        $manager->username   = 'user123';
        $manager->email     = 'user123@example.com';
        $manager->password  = bcrypt('user123');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
