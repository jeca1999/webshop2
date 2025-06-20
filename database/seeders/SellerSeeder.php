<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=SellerSeeder
     */
    public function run(): void
    {
        Seller::updateOrCreate(
            ['email' => '3ELLLEFRITZ@gmail.com'], 
            [
                'password' => Hash::make('Fritzelle'),
                'role' => 'seller',
            ]
        );
    }
}
