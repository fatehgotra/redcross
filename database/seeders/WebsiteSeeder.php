<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Faker\Generator;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Credential;
use App\Models\Market;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Support\Str;
use App\Models\UserExhibitor;
use App\Models\UserBankDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $admin = Admin::create( [
            'name'              => 'Ritesh',
            'email'             => 'admin@admin.com',
            'phone'             => '9876543210',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => 'Administrator'
        ]);

        $admin = Admin::create( [
            'name'              => 'Bruce Wayne',
            'email'             => 'branch_level@admin.com',
            'phone'             => '9876543211',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => 'Branch Level'
        ]);

        $admin = Admin::create( [
            'name'              => 'Clark Kent',
            'email'             => 'division_manager@admin.com',
            'phone'             => '9876543212',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => 'Division Manager'
        ]);

        $admin = Admin::create( [
            'name'              => 'John Marshal',
            'email'             => 'hq@admin.com',
            'phone'             => '9876543213',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => 'HQ'
        ]);

        // for ($i = 1; $i < 21; $i++) {

        //     $volunteers               = User::create([
        //         'firstname'              => $faker->firstname(),      
        //         'lastname'              => $faker->lastname(),                  
        //         'email'             => $i == 1 ? 'user@admin.com' : $faker->unique()->safeEmail(),
        //         'email_verified_at' => now(),
        //         'phone'             => $faker->numerify('9#########'),
        //         'password'          => Hash::make('password')                
        //     ]);
           
        // }      
    }
}
