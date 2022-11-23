<?php
    session_start();

    $user = htmlspecialchars($_SESSION['username']);
    $sql = "SELECT * FROM avaliacoes where username = '$user' ORDER BY id_av";

    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

    $result = $CONN->query($sql);

    $id =  mysqli_fetch_assoc($result)['id_av'];
    $sql = "DELETE FROM avaliacoes where id_av = $id";
    if ($CONN->query($sql)) {
        header('Location: main.php');
    } else {
        echo "Aconteceu um erro!";
        echo "erro: " . $CONN->error;
    }
?>