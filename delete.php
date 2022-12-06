<?php
    session_start();

    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

    $id =  $_GET['id'];

    $sqlDelete = "DELETE FROM avaliacoes where id_av = $id";
    if ($CONN->query($sqlDelete)) {
        header('Location: main.php');
    } else {
        echo "Aconteceu um erro!";
        echo "erro: " . $CONN->error;
    }
?>