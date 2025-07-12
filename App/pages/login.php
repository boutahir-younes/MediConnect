<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE email=? AND role=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($mot_de_passe == $user['mode_passe']) {
            $_SESSION['user_id'] = $user['idUser'];
            $_SESSION['role'] = $user['role'];
            if ($role == 'patient') header("Location: dashboard-patient.php");
            elseif ($role == 'medecin') header("Location: dashboard-doctor.php");
            else header("Location: dashboard-admin.php");
            exit();
        }
    }
    $error = "Identifiants incorrects.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - MediConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      color: #0d6efd;
      margin-bottom: 20px;
      font-size: 28px;
    }
    form label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      font-size: 14px;
    }
    form input, form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn-submit {
      background-color: #0d6efd;
      color: white;
      padding: 10px;
      margin-top: 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }
    .btn-submit:hover {
      background-color: #0b5ed7;
    }
    .links {
      text-align: center;
      margin-top: 15px;
    }
    .links a {
      color: #0d6efd;
      text-decoration: none;
      display: block;
      margin-top: 5px;
    }
    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Connexion</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
      <label>Email :</label>
      <input type="email" name="email" required>

      <label>Mot de passe :</label>
      <input type="password" name="mot_de_passe" required>

      <label>Rôle :</label>
      <select name="role" required>
        <option value="patient">Patient</option>
        <option value="medecin">Médecin</option>
        <option value="admin">Administrateur</option>
      </select>

      <button type="submit" class="btn-submit">Se connecter</button>
    </form>
    <div class="links">
      <a href="register.php">Créer un compte patient</a>
      <a href="Home_page.html">Retour à l'accueil</a>
    </div>
  </div>
</body>
</html>
