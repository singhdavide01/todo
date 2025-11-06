<?php
include 'db.php';
$id = $_GET['id'] ?? 0;

// Quando viene inviato il form di modifica
if (isset($_POST['update'])) {
    $titolo = $conn->real_escape_string($_POST['titoloTask']);
    $descrizione = $conn->real_escape_string($_POST['descrizione']);
    $stato = $conn->real_escape_string($_POST['stato']);

    $sql = "UPDATE tasks SET titoloTask='$titolo', descrizione='$descrizione', stato='$stato' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
    exit;
}

// Recupero dati del task da modificare
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Modifica Task</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" name="titoloTask" class="form-control" value="<?= htmlspecialchars($task['titoloTask']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="descrizione" class="form-control"><?= htmlspecialchars($task['descrizione']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Stato</label>
            <select name="stato" class="form-select">
                <option value="Da fare" <?= $task['stato'] == 'Da fare' ? 'selected' : '' ?>>Da fare</option>
                <option value="Completato" <?= $task['stato'] == 'Completato' ? 'selected' : '' ?>>Completato</option>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-success">Salva modifiche</button>
        <a href="index.php" class="btn btn-secondary">Annulla</a>
    </form>
</div>

</body>
</html>
