<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Shared\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'first_name' => 'Steve',
            'last_name' => 'McDougall',
            'email' => 'test@gmail.com',
            'password' => '$2y$10$JqtSLGcx9UUfka11vfiNK.j.NtKtljqKlF44ZSqyH4Lm6ozAUWOy6'
        ]);

        // Post::factory(20)->for($user)->create();
    }
}
