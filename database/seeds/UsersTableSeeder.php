<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Super-admin',
        	'slug' => 'super-admin',
            'description' => 'Utilisateur ayant tous les accès',
        	'special' => 'all-access',
        ]);
        Role::create([
            'name' => 'Visiteur',
            'slug' => 'visiteur',
            'description' => 'Utilisateur n\'ayant aucun accès',
            'special' => 'no-access',
        ]);
    }
}
