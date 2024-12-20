<?php


header("Content-Security-Policy: default-src 'self'; script-src 'self' https://scripts.local; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; frame-ancestors 'none';");


$dsn = 'mysql:host=localhost;dbname=myblog;charset=utf8';
$user = 'root';
$pass = '';

try {
    // Création de l'instance PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Configuration pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connexion réussie !";
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    echo "Erreur de connexion : " . $e->getMessage();
}




