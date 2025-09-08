<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan roles sudah tersedia
        // $this->call(RoleSeeder::class);

        // Buat 1 akun Rektor
        User::factory()->rektor()->create([
            'full_name' => 'Prof. Dr. Ahmad Syarifuddin, M.Pd',
            'nim' => 'REKTOR001',
            'password' => Hash::make('123123'), // Password 123123
        ]);

        // Buat 1 akun untuk setiap Wakil Rektor
        User::factory()->warek1()->create([
            'full_name' => 'Dr. Fatimah Zahra, M.Si',
            'nim' => 'W1001',
            'password' => Hash::make('123123'), // Password 123123
        ]);

        User::factory()->warek2()->create([
            'full_name' => 'Dr. Muhammad Al-Fatih, S.E., M.Ak',
            'nim' => 'W2001',
            'password' => Hash::make('123123'), // Password 123123
        ]);

        User::factory()->warek3()->create([
            'full_name' => 'Dr. Siti Aminah, M.Pd',
            'nim' => 'W3001',
            'password' => Hash::make('123123'), // Password 123123
        ]);

        User::factory()->warek4()->create([
            'full_name' => 'Dr. Abdul Rahman, M.Si',
            'nim' => 'W4001',
            'password' => Hash::make('123123'), // Password 123123
        ]);

        // Buat 5 akun Mahasiswa dengan password 123123
        User::factory()->count(5)->mahasiswa()->create([
            'password' => Hash::make('123123'),
        ]);

        // Atau jika ingin membuat lebih banyak mahasiswa
        User::factory()->count(10)->mahasiswa()->create();

        // Buat beberapa aspirasi dengan status tertentu
        // Aspirasi::factory()->count(5)->pending()->create();
        // Aspirasi::factory()->count(3)->accepted()->create();
        // Aspirasi::factory()->count(2)->rejected()->create();
        // Aspirasi::factory()->count(4)->commented()->create();

        // Buat aspirasi untuk masing-masing warek
        // Aspirasi::factory()->count(3)->untukWarek1()->create();
        // Aspirasi::factory()->count(3)->untukWarek2()->create();
        // Aspirasi::factory()->count(3)->untukWarek3()->create();
        // Aspirasi::factory()->count(3)->untukWarek4()->create();
    }
}
