<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Ritesh',
            'email' => 'user@admin.com',
            'phone' => '9999999999',
            'email_verified_at' => '2021-12-02 00:00:28',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'PV4vJ97TJQQtQ4YrDggzPXOxR8idLWcrFVub6Y0dcOq25THLpsZHUIy8stKy',
        ]);
    }
}
