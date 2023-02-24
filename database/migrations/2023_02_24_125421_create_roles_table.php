<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'title' => 'Участник',
                'name' => 'competitor'
            ],
            [
                'title' => 'Эксперт',
                'name' => 'expert'
            ],
            [
                'title' => 'Администратор',
                'name' => 'administrator'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
