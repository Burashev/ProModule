<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->boolean('is_filtered')->default(false);
            $table->timestamps();
        });

        DB::table('tag_types')->insert([
            [
                'title' => 'Сложность',
                'name' => 'difficulty',
                'is_filtered' => true
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_types');
    }
};
