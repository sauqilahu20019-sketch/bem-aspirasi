<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('#####'),
            'prodi' => $this->faker->randomElement([
                "Ilmu Al-Quran & Tafsir",
                "Tasawuf dan Psikoterapi",
                "Hukum Keluarga Islam",
                "Teknik Sipil",
                "Pendidikan Agama Islam",
                "Ekonomi Syariah",
                "Pendidikan Islam Anak Usia Dini",
                "Perbankan Syariah",
                "Hukum Ekonomi Syariah",
                "Pendidikan Bahasa Arab",
                "Biologi",
                "Matematika",
                "Kimia",
                "Teknologi Informasi",
                "Teknologi Hasil Pertanian",
                "Bisnis Digital",
                "Ilmu Komunikasi"
            ]),
            'email_verified_at' => now(),
            'role_id' => function () {
                return \App\Models\Role::where('role_name', 'Mahasiswa')->first()->id_role;
            },
            'password' => Hash::make('123123'), // Password default 123123
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Set role sebagai Rektor
     */
    public function rektor(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Rektor')->first()->id_role,
            'prodi' => null,
            'nim' => 'REK' . $this->faker->unique()->numerify('####'),
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }

    /**
     * Set role sebagai Wakil Rektor I
     */
    public function warek1(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Wakil Rektor I')->first()->id_role,
            'prodi' => null,
            'nim' => 'W1' . $this->faker->unique()->numerify('####'),
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }

    /**
     * Set role sebagai Wakil Rektor II
     */
    public function warek2(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Wakil Rektor II')->first()->id_role,
            'prodi' => null,
            'nim' => 'W2' . $this->faker->unique()->numerify('####'),
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }

    /**
     * Set role sebagai Wakil Rektor III
     */
    public function warek3(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Wakil Rektor III')->first()->id_role,
            'prodi' => null,
            'nim' => 'W3' . $this->faker->unique()->numerify('####'),
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }

    /**
     * Set role sebagai Wakil Rektor IV
     */
    public function warek4(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Wakil Rektor IV')->first()->id_role,
            'prodi' => null,
            'nim' => 'W4' . $this->faker->unique()->numerify('####'),
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }

    /**
     * Set role sebagai Mahasiswa
     */
    public function mahasiswa(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => \App\Models\Role::where('role_name', 'Mahasiswa')->first()->id_role,
            'password' => Hash::make('123123'), // Password default 123123
        ]);
    }
}
