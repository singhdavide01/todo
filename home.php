<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- <div class="container mt-5">
    <h2>Benvenuto,!</h2>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div> -->

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista Task</h2>

    <!-- TABELLA VISUALIZZAZIONE TASK -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Descrizione</th>
                <th>Stato</th>
                <th>Creato da</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("
    SELECT tasks.id, tasks.titoloTask, tasks.descrizione, tasks.stato, users.nome
    FROM tasks
    JOIN users ON users.id = tasks.user_id
    ORDER BY tasks.id DESC
");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['titoloTask']}</td>
                        <td>{$row['descrizione']}</td>
                        <td>{$row['stato']}</td>
                        <td>{$row['nome']}</td>
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
