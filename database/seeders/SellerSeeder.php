<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This will reset or create the default seller account.
     */
    public function run(): void
    {
        Seller::updateOrCreate(
            ['email' => '3ELLLEFRITZ@gmail.com'],
            [
                'name' => 'Default Seller',
                'password' => Hash::make('Fritzelle'),
                'role' => 'seller',
                'updated_at' => now(),
            ]
        );
    }
}
