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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(\Domains\Module\Models\TagType::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('text_color');
            $table->string('background_color');
            $table->timestamps();
        });

        Schema::create('module_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Domains\Module\Models\Tag::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(\Domains\Module\Models\Module::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });

        DB::table('tags')->insert([
            [
                'title' => 'Легкая',
                'tag_type_id' => '1',
                'text_color' => '#02af9b',
                'background_color' => '#e2f4f0',
            ],
            [
                'title' => 'Средняя',
                'tag_type_id' => '1',
                'text_color' => '#ffb800',
                'background_color' => '#fff5df',
            ],
            [
                'title' => 'Сложная',
                'tag_type_id' => '1',
                'text_color' => '#ff2c55',
                'background_color' => '#ffe2e6',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_tag');
        Schema::dropIfExists('tags');
    }
};
