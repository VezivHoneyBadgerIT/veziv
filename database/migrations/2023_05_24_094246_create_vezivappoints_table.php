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
        Schema::create('vezivappoints', function (Blueprint $table) {
            $table->id();
            $table->integer('app_date');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
        DB::table('vezivappoints')->insert(
            array(
                'id' => '1',
                'app_date'=>strtotime(date("Y-m-d 10:30")."+1 day"),
                'full_name' => 'Jon Doe',
                'phone' => '123123123',
                'email' => 'veziv@honeybadger.it'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vezivappoints');
    }
};
