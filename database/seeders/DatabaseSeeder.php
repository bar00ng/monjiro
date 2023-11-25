<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Product::factory(20)->create([
            'kategori' => 'T-Shirt'
        ]);

        \App\Models\Product::factory(20)->create([
            'kategori' => 'Shirt'
        ]);

        \App\Models\Product::factory(20)->create([
            'kategori' => 'Sweather'
        ]);

        \App\Models\Product::factory(20)->create([
            'kategori' => 'Jacket'
        ]);

        \App\Models\Product::factory(20)->create([
            'kategori' => 'Pants'
        ]);

        \App\Models\Product::factory(20)->create([
            'kategori' => 'Accesories'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        // ]);
    }
}
