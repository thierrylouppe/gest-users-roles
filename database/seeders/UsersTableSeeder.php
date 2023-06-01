<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $auteur = User::create([
            'name' => 'auteur',
            'email' => 'auteur@auteur.com',
            'password' => Hash::make('password')
        ]);

        $utilisateur = User::create([
            'name' => 'utilisateur',
            'email' => 'utilisateur@utilisateur.com',
            'password' => Hash::make('password')
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $auteurRole = Role::where('name', 'auteur')->first();
        $utilisateurRole = Role::where('name', 'utilisateur')->first();

        $admin->roles()->attach($adminRole); 
        $auteur->roles()->attach($auteurRole); 
        $utilisateur->roles()->attach($utilisateurRole); 
    }
}
