<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AspirasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil ID mahasiswa secara acak
        $mahasiswaIds = \App\Models\User::whereHas('role', function($query) {
            $query->where('role_name', 'Mahasiswa');
        })->pluck('id_user')->toArray();

        // Daftar pilihan warek
        $warekOptions = ['Wakil Rektor I', 'Wakil Rektor II', 'Wakil Rektor III', 'Wakil Rektor IV'];

        return [
            'diajukan_oleh' => $this->faker->randomElement($mahasiswaIds),
            'ditujukan_ke' => null, // Diisi null, nanti akan diisi admin
            'ke_warek' => $this->faker->randomElement($warekOptions),
            'aspirasi' => $this->faker->paragraphs(3, true), // 3 paragraf aspirasi
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected', 'commented']),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Set status pending
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Set status accepted
     */
    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'accepted',
        ]);
    }

    /**
     * Set status rejected
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }

    /**
     * Set status commented
     */
    public function commented(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'commented',
        ]);
    }

    /**
     * Tujukan ke Wakil Rektor I
     */
    public function untukWarek1(): static
    {
        return $this->state(fn (array $attributes) => [
            'ke_warek' => 'Wakil Rektor I',
        ]);
    }

    /**
     * Tujukan ke Wakil Rektor II
     */
    public function untukWarek2(): static
    {
        return $this->state(fn (array $attributes) => [
            'ke_warek' => 'Wakil Rektor II',
        ]);
    }

    /**
     * Tujukan ke Wakil Rektor III
     */
    public function untukWarek3(): static
    {
        return $this->state(fn (array $attributes) => [
            'ke_warek' => 'Wakil Rektor III',
        ]);
    }

    /**
     * Tujukan ke Wakil Rektor IV
     */
    public function untukWarek4(): static
    {
        return $this->state(fn (array $attributes) => [
            'ke_warek' => 'Wakil Rektor IV',
        ]);
    }
}
