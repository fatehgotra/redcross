<?php

namespace Database\Seeders;

use App\Models\Account;
use Faker\Generator;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'branch-level']);
        Role::create(['guard_name' => 'admin', 'name' => 'division-manager']);
        Role::create(['guard_name' => 'admin', 'name' => 'hq']);
        Role::create(['guard_name' => 'admin', 'name' => 'course-coordinator']);
        Role::create(['guard_name' => 'admin', 'name' => 'community-head']);

            $branches[0] = "Rotuma";
            $branches[1] = "Levuka";
            $branches[2] = "Suva";
            $branches[3] = "Bua";
            $branches[4] = "Seaqaqa";
            $branches[5] = "Savusavu";
            $branches[6] = "Labasa";
            $branches[7] = "Taveuni";
            $branches[8] = "Rabi";
            $branches[9] = "Sigatoka";
            $branches[10] = "Nadi";
            $branches[11] = "Lautoka";
            $branches[12] = "Ba";
            $branches[13] = "Tavua";
            $branches[14] = "Rakiraki";
            $branches[15] = "Nalawa";
        
        $admin = Admin::create([
            'name'              => 'Ritesh',
            'email'             => 'admin@admin.com',
            'phone'             => '9876543210',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        $admin->assignRole('admin');

        foreach ($branches as $key => $branch) {
          
            $branch_level = Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'branch_level@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => $faker->numerify('9#########'),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => [$branch],
            ]);

            $branch_level->assignRole('branch-level');

            $division_manager = Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'division_manager@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => $faker->numerify('9#########'),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => [$branch],
            ]);

            $division_manager->assignRole('division-manager');

            $community_head = Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'community_head@admin.com': $faker->unique()->safeEmail(),
                'phone'             => '9876543614',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ]);
    
            $community_head->assignRole('community-head');

            $hq =  Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'hq@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => $faker->numerify('9#########'),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => [$branch],
            ]);

            $hq->assignRole('hq');

            $multiple_roles =  Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'multiple_role@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => '9876543214',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => [$branch],
            ]);

            $multiple_roles->assignRole('branch-level');
            $multiple_roles->assignRole('division-manager');
            $multiple_roles->assignRole('hq');
        }

        $coordinator = Admin::create([
            'name'              => 'John Doe',
            'email'             => 'course_coordinator@admin.com',
            'phone'             => '9876543610',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        $coordinator->assignRole('course-coordinator');

        /*Bank account*/

        Account::create([
            'bank'=>'Australia, New Zealand Bank (ANZ)',
            'branch'=>'Lautoka',
            'account'=>'2464416',
            'account_name'=>'The Fiji Red Cross Society Lautoka Branch',
        ]);

        Account::create([
            'bank'=>'Bank of Baroda',
            'branch'=>'Ba',
            'account'=>'9103 01 00008435',
            'account_name'=>'The Fiji Red Cross Society Ba Branch',
        ]);

        Account::create([
            'bank'=>'Bank of the South Pacific (BSP)',
            'branch'=>'Tavua',
            'account'=>'85691850',
            'account_name'=>'The Fiji Red Cross Society Tavua Branch',
        ]);

        Account::create([
            'bank'=>'Westpac',
            'branch'=>'Nalawa',
            'account'=>'9803314351',
            'account_name'=>'The Fiji Red Cross Society Nalawa Branch',
        ]);

        Account::create([
            'bank'=>'Westpac',
            'branch'=>'Labasa',
            'account'=>'9801823239',
            'account_name'=>'FRCS - Labasa',
        ]);

        Account::create([
            'bank'=>'Bank of the South Pacific (BSP)',
            'branch'=>'Tavueni',
            'account'=>'7625584',
            'account_name'=>'Red Cross Society Fund',
        ]);

        Account::create([
            'bank'=>'Westpac',
            'branch'=>'Savusavu',
            'account'=>'9800453095',
            'account_name'=>'FRCS Savusavu Branch',
        ]);

        Account::create([
            'bank'=>'Australia, New Zealand Bank (ANZ)',
            'branch'=>'Bua',
            'account'=>'8458780',
            'account_name'=>'Fiji Red Cross Bua Branch',
        ]);

       
    }
}
