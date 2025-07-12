<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPatient = $_SESSION['user_id'];
    $idMedcine = $_POST['medecin'];
    $date_heure = $_POST['date_heure'];
    $statut = "en attente";

    // Vérifier le format de la date et heure (sécurité basique)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $date_heure)) {
        die("Format de date invalide.");
    }

    // Convertir le format HTML5 (datetime-local) en format MySQL DATETIME
    $date_mysql = str_replace("T", " ", $date_heure) . ":00";

    $stmt = $conn->prepare("INSERT INTO rendezvous (idPatient, idMedcine, date_heure, statut) VALUES (?, ?, ?, ?) ");
    $stmt->bind_param("iiss", $idPatient, $idMedcine, $date_mysql, $statut);

    if ($stmt->execute()) {
        header("Location: rendezvous.php");
        exit();
    } else {
        echo "Erreur lors de la prise de rendez-vous.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
