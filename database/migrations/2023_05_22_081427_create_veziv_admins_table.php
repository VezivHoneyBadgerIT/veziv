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
        Schema::create('veziv_admins', function (Blueprint $table) {
            $table->id();
            $table->text('home_message')->default("<h1>Welcome to our appointment website</h1><p>Please select the date and hour below for your appointment.</p>");
            $table->integer('show_days')->default(14);
            $table->tinyInteger('apts_enabled')->default("1");
            $table->tinyInteger('day1')->default("1");
            $table->tinyInteger('day2')->default("1");
            $table->tinyInteger('day3')->default("1");
            $table->tinyInteger('day4')->default("1");
            $table->tinyInteger('day5')->default("1");
            $table->tinyInteger('day6')->default("0");
            $table->tinyInteger('day7')->default("0");
            $table->text('apts_disabled_message')->default("<h1>Welcome to our appointment website</h1><p>Please note that currently we are not taking appointments due to annual hoiliday untill 1st of Sept.</p>");
            $table->timestamps();
        });
        DB::table('veziv_admins')->insert(
            array(
                'id' => '1'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veziv_admins');
    }
};
