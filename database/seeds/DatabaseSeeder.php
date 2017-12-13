<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);

    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('users')->delete();

        User::create(['username' => 'admin', 'name' => 'Admin', 'email' => 'admin@erx.com', 'password' => \Hash::make('password'), 'role_id' => 1, 'status' => 1 ]);
        User::create(['username' => 'doctor', 'name' => 'Doctor', 'email' => 'doctor@erx.com', 'password' => \Hash::make('password'), 'role_id' => 2, 'status' => 1 ]);
        User::create(['username' => 'secretary', 'name' => 'Secretary', 'email' => 'secretary@erx.com', 'password' => \Hash::make('password'), 'role_id' => 3, 'status' => 1 ]);
        User::create(['username' => 'pharmacist', 'name' => 'Pharmacist', 'email' => 'pharmacist@erx.com', 'password' => \Hash::make('password'), 'role_id' => 4, 'status' => 1 ]);
        User::create(['username' => 'patient', 'name' => 'Patient', 'email' => 'jef.utech@gmail.com', 'password' => \Hash::make('password'), 'role_id' => 5, 'status' => 1 ]);

    }
}

class UserRolesTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('user_roles')->delete();
        UserRole::create(['id' => 1,  'name' => 'Admin'                 ]) ;
        UserRole::create(['id' => 2,  'name' => 'Doctor'                ]) ;
        UserRole::create(['id' => 3,  'name' => 'Secretary'             ]) ;
        UserRole::create(['id' => 4,  'name' => 'Patient'               ]) ;
        UserRole::create(['id' => 5,  'name' => 'Pharmacist'            ]) ;
    }
}


class AdminsTableSeeder extends Seeder
{
    public function run()
    {
    	
        DB::table('admins')->delete();
        Admin::create(['fname' => 'adminfname','lname'	=> 'adminlanme','user_id'=>11, 'email'=>'devchuckcamp@gmail.com']);
    }
}

