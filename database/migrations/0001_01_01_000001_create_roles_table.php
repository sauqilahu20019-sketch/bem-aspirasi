<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role_name');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
        $roles = [
            ['role_name' => 'Admin'],
            ['role_name' => 'Rektor'],
            ['role_name' => 'Wakil Rektor I', 'deskripsi' => 'Akademik'],
            ['role_name' => 'Wakil Rektor II', 'deskripsi' => 'Keuangan'],
            ['role_name' => 'Wakil Rektor III', 'deskripsi' => 'Kemahasiswaan'],
            ['role_name' => 'Wakil Rektor IV', 'deskripsi' => 'HUMAS'],
            ['role_name' => 'Mahasiswa'],
        ];
        foreach($roles as $role){
            App\Models\Role::create($role);
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
