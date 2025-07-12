<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPatient = $_POST['patient'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO dossiers_medicaux (idPatient, titre, description, date_ajout) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $idPatient, $titre, $description, $date);

    if ($stmt->execute()) {
        header("Location: dossiers-medecin.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du dossier médical.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
