<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $isProduction = config("app.env") === 'production' ? true : false;

        $developSeeds = [
            AreaSeeder::class,
            OrganizationSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            AddressSeeder::class,
            UserProfileSeeder::class,
        ];

        $productionSeeds = [
            AreaSeeder::class,
            OrganizationSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            AddressSeeder::class,
            UserProfileSeeder::class,
        ];

        $seeds = $isProduction ? $productionSeeds : $developSeeds;

        $this->call($seeds);
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
