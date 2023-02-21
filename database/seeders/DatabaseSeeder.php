<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*if (app()->environment('local')) {
            $this->call(
                DefaultUserSeeder::class
            );
        }*/
        $user = User::factory()->create([
            'first_name' => 'Steve',
            'last_name' => 'McDougall',
            'email' => 'test@gmail.com'
        ]);

        Post::factory(20)->for($user)->create();
    }
}
