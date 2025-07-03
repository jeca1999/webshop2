<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This will reset or create the default seller account.
     */
    public function run(): void
    {
        // Delete all sellers for a clean state (avoids foreign key issues)
        DB::table('sellers')->delete();
        Seller::create([
            'email' => '3ELLLEFRITZ@gmail.com',
            'password' => 'Fritzelle', // Let the model mutator hash this
            'role' => 'seller',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
