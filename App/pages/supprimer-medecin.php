<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID médecin manquant.";
    exit();
}

$id = $_GET['id'];

// Supprimer l'utilisateur médecin dans la table users (ON DELETE CASCADE s'occupe du reste)
$stmt = $conn->prepare("DELETE FROM users WHERE idUser = ? AND role = 'medecin'");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: medecins-admin.php");
    exit();
} else {
    echo "Erreur lors de la suppression du médecin.";
}
?>
