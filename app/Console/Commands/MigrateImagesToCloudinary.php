<?php

namespace App\Console\Commands;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MigrateImagesToCloudinary extends Command
{
    protected $signature = 'images:migrate-cloudinary';
    protected $description = 'Upload local user and recipe images to Cloudinary and update database paths';

    public function handle()
    {
        $this->info('Migrating recipe images...');

        Recipe::whereNotNull('recipe_img')->chunk(50, function ($recipes) {
            foreach ($recipes as $recipe) {
                if (str_starts_with($recipe->recipe_img, 'http')) {
                    continue;
                }

                $relativePath = str_replace('public/', '', $recipe->recipe_img);
                $fullPath = storage_path('app/public/' . $relativePath);

                if (!file_exists($fullPath)) {
                    $this->warn("Recipe image missing: {$fullPath}");
                    continue;
                }

                $url = Cloudinary::upload($fullPath, [
                    'folder' => 'kudi/recipes',
                ])->getSecurePath();

                $recipe->recipe_img = $url;
                $recipe->save();

                $this->info("Updated recipe {$recipe->id}");
            }
        });

        $this->info('Migrating user images...');

        User::whereNotNull('image')->chunk(50, function ($users) {
            foreach ($users as $user) {
                if (str_starts_with($user->image, 'http')) {
                    continue;
                }

                $relativePath = str_replace('public/', '', $user->image);
                $fullPath = storage_path('app/public/' . $relativePath);

                if (!file_exists($fullPath)) {
                    $this->warn("User image missing: {$fullPath}");
                    continue;
                }

                $url = Cloudinary::upload($fullPath, [
                    'folder' => 'kudi/users',
                ])->getSecurePath();

                $user->image = $url;
                $user->save();

                $this->info("Updated user {$user->id}");
            }
        });

        $this->info('Done.');
    }
}
