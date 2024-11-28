<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('permission_name')->nullable();
            $table->text('value')->nullable();
            $table->string('permission_type')->nullable();
            $table->timestamps();
        });

        $permission_data = [
            [
                'permission_name' => 'Admin',
                'permission_type' => 'Full Control'
            ]
        ];

        $permission = DB::table('permissions');
        $permission->insert($permission_data);

        $user_data = [
            [
                'name' => 'daramony',
                'email' => 'daramony@gmail.com',
                'password' => Hash::make('Mony2001'),
                'permission_id' => 1
            ]
        ];
        $user = DB::table('users');
        $user->insert($user_data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
