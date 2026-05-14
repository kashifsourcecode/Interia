<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(HeroSectionSeeder::class);
        $this->call(ServiceSectionSeeder::class);
        $this->call(GallerySectionSeeder::class);
        $this->call(AiAdoptionSectionSeeder::class);
        $this->call(WhySectionSeeder::class);
        $this->call(IndustrySectionSeeder::class);
        $this->call(OfferSectionSeeder::class);
        $this->call(PricingSectionSeeder::class);
        $this->call(AboutSectionSeeder::class);
        $this->call(ContactSectionSeeder::class);
    }
}
