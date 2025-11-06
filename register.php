<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Registrazione</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Registrazione</h2>
  <form method="POST">
    <input class="form-control mb-3" type="text" name="nome" placeholder="Nome" required>
    <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
    <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
    <button class="btn btn-primary" name="register">Registrati</button>
  </form>
</div>

<?php
if (isset($_POST['register'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utenti (nome, email, password) VALUES ('$nome', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Registrazione completata!</div>";
    } else {
        echo "<div class='alert alert-danger'>Errore: " . $conn->error . "</div>";
    }
}
?>
</body>
</html>
