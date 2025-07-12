<?php
$host = "localhost";
$user = "root";
$password = ""; // Si tu as un mot de passe MySQL, ajoute-le ici
$database = "mediconnect";

// Connexion à la base
$conn = new mysqli($host, $user, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
?>
