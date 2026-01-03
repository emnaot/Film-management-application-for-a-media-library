@echo off
echo ========================================
echo   Mini Projet Laravel - Films
echo ========================================
echo.
echo 1. Assurez-vous que XAMPP est demarré (Apache + MySQL)
echo 2. Créez la base de données 'mini_projet_anis_borchani' dans phpMyAdmin
echo.
pause
echo.
echo Exécution des migrations...
php artisan migrate
echo.
echo Exécution des seeders...
php artisan db:seed
echo.
echo Démarrage du serveur Laravel...
echo.
echo Accédez à votre application :
echo - Liste des films : http://127.0.0.1:8000/films/liste
echo - Ajouter un film : http://127.0.0.1:8000/films/ajouter
echo.
php artisan serve