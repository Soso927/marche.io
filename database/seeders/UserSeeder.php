<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    {
        // Compte admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@marche.io',
            'password' => 'adminpassword', // Utilisez un mot de passe sécurisé en production
        ]);
        $admin->assignRole('admin');

        // Compte vendeur
        $seller = User::create([
            'name' => 'Vendeur Test',
            'email' => 'seller@marche.io',
            'password' => 'sellerpassword', // Utilisez un mot de passe sécurisé en production
        ]);
        $seller->assignRole('seller');

        // Compte acheteur
        $buyer = User::create([
            'name' => 'Acheteur Test',
            'email' => 'buyer@marche.io',
            'password' => 'buyerpassword', // Utilisez un mot de passe sécurisé en production
        ]);
        $buyer->assignRole('buyer');
    }
    }
}
