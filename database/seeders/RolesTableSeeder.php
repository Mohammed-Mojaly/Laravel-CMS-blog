<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $adminRole = Role::create(['name'=>'admin' , 'display_name'=>'Administrator' , 'description'=>'Systam Administrator' , 'allowed_route'=>'admin']);
        $editorRole = Role::create(['name'=>'editor' , 'display_name'=>'Supervisor' , 'description'=>'Systam Supervisor' , 'allowed_route'=>'admin']);
        $userRole = Role::create(['name'=>'user' , 'display_name'=>'User' , 'description'=>'Noraml User' , 'allowed_route'=>null]);

        $admin = User::create([

           'name' => 'Admin',
           'username' => 'admin',
           'email' => 'admin@mblog.test',
           'mobile' => '967' .  random_int(10000000,99999999),
           'email_verified_at' => now(),
           'password' => bcrypt('123123123'),
           'status' => 1,
        ]);
        $admin->attachRole($adminRole);


        $editor = User::create([

           'name' => 'Editor',
           'username' => 'editor',
           'email' => 'editor@mblog.test',
           'mobile' => '967' .  random_int(10000000,99999999),
           'email_verified_at' => now(),
           'password' => bcrypt('123123123'),
           'status' => 1,
        ]);
        $editor->attachRole($editorRole);


        $user1 = User::create(['name' => 'Mohammed Mojaly', 'username' => 'mohammed', 'email' => 'mohammed@mblog.test',  'mobile' => '967' .random_int(10000000,99999999),  'email_verified_at' => now(),   'password' => bcrypt('123123123'),  'status' => 1,]);
        $user1->attachRole($userRole);
        $user2 = User::create(['name' => 'Ali Said', 'username' => 'ali', 'email' => 'ali@mblog.test',  'mobile' => '967' .  random_int(10000000,99999999),  'email_verified_at' => now(),   'password' => bcrypt('123123123'),  'status' => 1,]);
        $user2->attachRole($userRole);
        $user3 = User::create(['name' => 'Osamh Mohammed', 'username' => 'osamh', 'email' => 'osamh@mblog.test',  'mobile' => '967' .  random_int(10000000,99999999),  'email_verified_at' => now(),   'password' => bcrypt('123123123'),  'status' => 1,]);
        $user3->attachRole($userRole);

        for ($i=0; $i <10 ; $i++) {

            $user = User::create([
             'name' => $faker->name,
             'username' => $faker->userName,
             'email' => $faker->email,
             'mobile' => '967' . random_int(10000000,99999999),
             'email_verified_at' => now(),
             'password' => bcrypt('123123123'),
             'status' => 1,

             ]);
            $user->attachRole($userRole);
        }

    }
}
