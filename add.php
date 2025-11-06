<?php
include 'db.php';

if (!empty($_POST['titoloTask']) && !empty($_POST['descrizione']) && !empty($_POST['stato'])) {
    $titolo = $conn->real_escape_string($_POST['titoloTask']);
    $descrizione = $conn->real_escape_string($_POST['descrizione']);
    $stato = $conn->real_escape_string($_POST['stato']);

    $sql = "INSERT INTO tasks (titoloTask, descrizione, stato) VALUES ('$titolo', '$descrizione', '$stato')";

    if ($conn->query($sql)) {
        echo " Task aggiunto con successo!<br><a href='index.php'>Torna alla lista</a>";
    } else {
        echo " Errore: " . $conn->error;
    }
} else {
    echo " Compila tutti i campi!";
}
?>