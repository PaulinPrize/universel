<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions d'accès au tableau de bord
        Permission::create([
            'name' => 'Acceder au tableau de bord',
            'slug' => 'user.tableau-de-bord',
            'description' => 'Acceder au tableau de bord',
        ]);

    	// Gestion des utilisateurs
        Permission::create([
        	'name' => 'Ajouter un utilisateur',
        	'slug' => 'user.create',
        	'description' => 'Ajouter un utilisateur',
        ]);
        Permission::create([
        	'name' => 'Afficher un utilisateur',
        	'slug' => 'user.show',
        	'description' => 'Afficher un utilisateur',
        ]);
        Permission::create([
        	'name' => 'Modifier un utilisateur',
        	'slug' => 'user.edit',
        	'description' => 'Modifier un utilisateur',
        ]);
        Permission::create([
        	'name' => 'Lister tous les utilisateurs',
        	'slug' => 'user.index',
        	'description' => 'Lister tous les utilisateurs',
        ]);
        Permission::create([
        	'name' => 'Supprimer un utilisateur',
        	'slug' => 'user.destroy',
        	'description' => 'Supprimer un utilisateur',
        ]);
        Permission::create([
            'name' => 'Voir son prfil',
            'slug' => 'profil',
            'description' => 'Voir son prfil',
        ]);
        Permission::create([
            'name' => 'Modifier son mot de passe',
            'slug' => 'password',
            'description' => 'Modifier son mot de passe',
        ]);

        // Gestion des roles
        Permission::create([
        	'name' => 'Ajouter un rôle',
        	'slug' => 'role.create',
        	'description' => 'Ajouter un rôle',
        ]);
        Permission::create([
        	'name' => 'Afficher un rôle',
        	'slug' => 'role.show',
        	'description' => 'Afficher un rôle',
        ]);
        Permission::create([
        	'name' => 'Modifier un rôle',
        	'slug' => 'role.edit',
        	'description' => 'Modifier un rôle',
        ]);
        Permission::create([
        	'name' => 'Lister tous les rôle',
        	'slug' => 'role.index',
        	'description' => 'Lister tous les rôles',
        ]);
        Permission::create([
        	'name' => 'Supprimer un rôle',
        	'slug' => 'role.destroy',
        	'description' => 'Supprimer un rôle',
        ]);

    }
}
