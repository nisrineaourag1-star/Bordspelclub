<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Wordt uitgevoerd bij: php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            DemoDataSeeder::class,
        ]);
    }
}