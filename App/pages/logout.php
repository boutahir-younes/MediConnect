<?php
session_start();
session_unset();   // Supprime toutes les variables de session
session_destroy(); // Détruit la session active

header("Location: login.php");
exit();
?>
