<?php

namespace Database\Seeders;

use Domains\Catalog\Models\Skill;
use Domains\File\Support\FileManager;
use Domains\Module\Models\Module;
use Domains\Shared\Enums\RolesEnum;
use Domains\Shared\Models\User;
use Domains\Shared\Models\UserBio;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->create()
            ->each(
                function (User $user) {
                    $user->bio()->save(UserBio::factory()->makeOne());
                    $user->skills()->saveMany(Skill::factory(fake()->numberBetween(1, 3))->make());
                }
            );

        $user = User::query()->create([
            'email' => 'shburashev@ya.ru',
            'password' => bcrypt('12341234'),
            'role_id' => RolesEnum::ADMINISTRATOR_ID->value
        ]);
        $user->bio()->save(UserBio::factory()->makeOne());

        $fileManager = new FileManager($user);

        $file = $fileManager->upload($this->loadFile(base_path('tests/Fixtures/modules/tasks/1.docx')));
        $mediaFile = $fileManager->upload($this->loadFile(base_path('tests/Fixtures/modules/mediafiles/mediafiles.zip')));

        Module::factory(100)
            ->for($file)
            ->create()
            ->each(fn(Module $module) => $module->mediaFiles()->attach($mediaFile->getKey()));
    }

    public function loadFile(string $path): UploadedFile
    {
        $explodedPath = explode('/', $path);

        return new UploadedFile(
            $path,
            end($explodedPath),
            mime_content_type($path),
            filesize($path),
        );
    }
}
