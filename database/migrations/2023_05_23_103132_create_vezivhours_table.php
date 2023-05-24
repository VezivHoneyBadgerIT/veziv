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
        Schema::create('vezivhours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'id' => '1',
                'name'=>'Admin',
                'email' => 'veziv@honeybadger.it',
                'password' => '$2y$10$4TrwjHuJP5PoR6.46aMMDOEuE3vt17Lkwt4qeTJHG8PGao6EVhqDS'
            )
        );
        DB::table('vezivhours')->insert(
            array(
                array(
                    'id' => '1',
                    'user_id'=>'1',
                    'start_time' => '09:00',
                    'end_time' => '10:00',
                ),
                array(
                    'id' => '2',
                    'user_id'=>'1',
                    'start_time' => '10:30',
                    'end_time' => '11:30',
                ),
                array(
                    'id' => '3',
                    'user_id'=>'1',
                    'start_time' => '12:00',
                    'end_time' => '13:00',
                ),
                array(
                    'id' => '4',
                    'user_id'=>'1',
                    'start_time' => '15:30',
                    'end_time' => '16:30',
                ),
                array(
                    'id' => '5',
                    'user_id'=>'1',
                    'start_time' => '17:00',
                    'end_time' => '18:00',
                ),
                array(
                    'id' => '6',
                    'user_id'=>'1',
                    'start_time' => '18:30',
                    'end_time' => '19:30',
                ),
                array(
                    'id' => '7',
                    'user_id'=>'1',
                    'start_time' => '20:00',
                    'end_time' => '21:00',
                ),
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vezivhours');
    }
};
