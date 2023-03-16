<?php

namespace Database\Seeders;

use Domains\File\Support\FileManager;
use Domains\Module\Models\Module;
use Domains\Module\Models\Tag;
use Domains\Shared\Enums\RolesEnum;
use Domains\Shared\Models\User;
use Domains\Shared\Models\UserBio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()
            ->createOne([
                'email' => 'shburashev@ya.ru',
                'password' => bcrypt('12341234'),
                'role_id' => RolesEnum::ADMINISTRATOR_ID->value
            ]);

        $user->bio()->save(UserBio::factory()->makeOne());

        $fileManager = new FileManager($user);

        $file = $fileManager->upload($this->loadFile(base_path('tests/Fixtures/modules/tasks/1.docx')));
        $mediaFile = $fileManager->upload($this->loadFile(base_path('tests/Fixtures/modules/mediafiles/mediafiles.zip')));

        $tags = Tag::query()->whereHas('tagType', function (Builder $builder) {
            return $builder->where('name', '=', 'difficulty');
        })->get();

        Module::factory(10)
            ->for($file)
            ->hasAttached($mediaFile, [], 'mediaFiles')
            ->create()
            ->each(function (Module $module) use ($tags) {
                $module->tags()->attach($tags->random());
            });
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
