<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This will reset or create the default seller account.
     */
    public function run(): void
    {
        // Truncate the sellers table for a clean state
        DB::table('sellers')->truncate();
        Seller::create([
            'email' => '3ELLLEFRITZ@gmail.com',
            'password' => Hash::make('Fritzelle'),
            'role' => 'seller',
            'updated_at' => now(),
        ]);
    }
}
