<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Crée la table `users` avec tous les champs nécessaires pour Laravel Auth
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->string('name'); // Nom complet de l'utilisateur
            $table->string('email')->unique(); // Email unique pour login
            $table->string('password'); // Mot de passe hashé
            $table->boolean('is_admin')->default(false); // Champ pour savoir si l'utilisateur est admin
            $table->timestamp('email_verified_at')->nullable(); // Vérification email (optionnel)
            $table->rememberToken(); // Token pour "se souvenir de moi"
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Supprime la table si rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
