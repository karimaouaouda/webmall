<?php

namespace Database\Seeders;

use App\Models\Auth\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "karim aouaouda",
            "mohammed nadir abda",
            "saif benchaabane",
            "loubna kirati",
            "billal gueffel"
        ];

        foreach($names as $name){
            Client::factory()->create([
                'name' => $name,
                'email' => Str::random(10) . "@gmail.com",
                'password' => Hash::make("password123")
            ]);
        }
    }
}
