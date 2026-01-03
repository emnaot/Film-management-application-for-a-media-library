# Mini Projet Laravel - Gestion des Films

## Instructions d'installation et de configuration

### 1. Prérequis
- XAMPP installé et démarré (Apache + MySQL)
- Composer installé
- Node.js et npm installés

### 2. Configuration de la base de données

1. Démarrez XAMPP (Apache et MySQL)
2. Ouvrez phpMyAdmin (http://localhost/phpmyadmin)
3. Exécutez le script SQL suivant pour créer la base de données :
   ```sql
   CREATE DATABASE IF NOT EXISTS mini_projet_anis_borchani CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

### 3. Installation et configuration du projet

1. Naviguez dans le dossier du projet :
   ```bash
   cd mini_projet_films
   ```

2. Installez les dépendances PHP :
   ```bash
   composer install
   ```

3. Installez les dépendances JavaScript :
   ```bash
   npm install
   ```

4. Copiez le fichier d'environnement (déjà fait) :
   ```bash
   cp .env.example .env
   ```

5. Générez la clé d'application (déjà fait) :
   ```bash
   php artisan key:generate
   ```

6. Exécutez les migrations :
   ```bash
   php artisan migrate
   ```

7. Exécutez les seeders pour peupler la base de données :
   ```bash
   php artisan db:seed
   ```

8. Compilez les assets (déjà fait) :
   ```bash
   npm run build
   ```

### 4. Démarrage du serveur

1. Démarrez le serveur Laravel :
   ```bash
   php artisan serve
   ```

2. Accédez à l'application :
   - Liste des films : http://127.0.0.1:8000/films/liste
   - Ajouter un film : http://127.0.0.1:8000/films/ajouter

### 5. API REST Endpoints

- **GET** `/api/films` - Récupérer tous les films
- **POST** `/api/films` - Créer un nouveau film
- **GET** `/api/films/{id}` - Récupérer un film spécifique
- **PUT** `/api/films/{id}` - Mettre à jour un film
- **DELETE** `/api/films/{id}` - Supprimer un film

### 6. Structure de la base de données

Table `films` :
- id (auto-increment)
- titre (string)
- realisateur (string)
- pays (string)
- date_sortie (date)
- description (text)
- poster (string)
- duree (integer)
- langue (string)
- created_at (timestamp)
- updated_at (timestamp)

### 7. Tests avec Postman/Thunder Client

Utilisez les endpoints API ci-dessus pour tester les fonctionnalités CRUD.

Exemple de données JSON pour créer un film :
```json
{
    "titre": "Nouveau Film",
    "realisateur": "Réalisateur Test",
    "pays": "France",
    "date_sortie": "2024-01-01",
    "description": "Description du film",
    "poster": "poster.jpg",
    "duree": 120,
    "langue": "Français"
}
```

### 8. Fonctionnalités implémentées

✅ Framework Laravel installé
✅ Base de données configurée
✅ Migration de la table films
✅ Modèle Film
✅ Seeder pour peupler la table
✅ Contrôleur API FilmController
✅ Routes API
✅ Vue.js intégré
✅ Vue liste des films (http://127.0.0.1:8000/films/liste)
✅ Vues pour ajouter et modifier un film
✅ Interface utilisateur responsive avec Bootstrap