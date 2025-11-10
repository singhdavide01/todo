<?php include 'db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Benvenuto, <?php echo $_SESSION['user_nome']; ?>!</h2>
         <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Lista Task</h2>

    <!-- FORM per aggiungere un nuovo task -->
    <form action="index.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" name="titoloTask" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="descrizione" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Stato</label>
            <select name="stato" class="form-select">
                <option value="Da fare">Da fare</option>
                <option value="Completato">Completato</option>
            </select>
        </div>
        <button type="submit" name="aggiungi" class="btn btn-success">Aggiungi Task</button>
    </form>

    <!-- SALVATAGGIO NUOVO TASK -->
    <?php
    if (isset($_POST['aggiungi'])) {
        $titoloTask = $conn->real_escape_string($_POST['titoloTask']);
        $descrizione = $conn->real_escape_string($_POST['descrizione']);
        $stato = $conn->real_escape_string($_POST['stato']);

        $sql = "INSERT INTO tasks (titoloTask, descrizione, stato) VALUES ('$titoloTask', '$descrizione', '$stato')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'> Task aggiunto con successo!</div>";
        } else {
            echo "<div class='alert alert-danger'> Errore: " . $conn->error . "</div>";
        }
    }
    ?>

    <!-- TABELLA VISUALIZZAZIONE TASK -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Descrizione</th>
                <th>Stato</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['titoloTask']}</td>
                        <td>{$row['descrizione']}</td>
                        <td>{$row['stato']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Modifica</a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Sei sicuro di voler eliminare questo task?');\">Elimina</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Nessun task trovato</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

