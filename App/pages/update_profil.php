<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];
    $nom = $_POST['nom_complete'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];

    // Mettre à jour le compte utilisateur (email)
    $stmt1 = $conn->prepare("UPDATE users SET email = ? WHERE idUser = ?");
    $stmt1->bind_param("si", $email, $id);
    $stmt1->execute();

    // Mettre à jour les informations du patient
    $stmt2 = $conn->prepare("UPDATE patients SET nom_complete = ?, sexe = ?, age = ?, telephone = ? WHERE idPatient = ?");
    $stmt2->bind_param("ssisi", $nom, $sexe, $age, $telephone, $id);
    $stmt2->execute();

    header("Location: profil.php");
    exit();
} else {
    echo "Méthode non autorisée.";
}
?>
