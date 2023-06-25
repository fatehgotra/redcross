<?php

namespace Database\Seeders;

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
                'branch'            => $branch,
            ]);

            $branch_level->assignRole('branch-level');

            $division_manager = Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'division_manager@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => $faker->numerify('9#########'),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => $branch,
            ]);

            $division_manager->assignRole('division-manager');

            $hq =  Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'hq@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => $faker->numerify('9#########'),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => $branch,
            ]);

            $hq->assignRole('hq');

            $multiple_roles =  Admin::create([
                'name'              => $faker->name(),
                'email'             => $key == 0 ? 'multiple_role@admin.com' : $faker->unique()->safeEmail(),
                'phone'             => '9876543214',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'branch'            => $branch,
            ]);

            $multiple_roles->assignRole('branch-level');
            $multiple_roles->assignRole('division-manager');
            $multiple_roles->assignRole('hq');
        }
    }
}
