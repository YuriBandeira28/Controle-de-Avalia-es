<?php
session_start();

    if (isset($_POST["materia"]) == true && isset($_POST["peso"]) ==true && isset($_POST["data"]) ==true) {

        $materia = $_POST["materia"];
        $peso = $_POST["peso"];
        $data = $_POST["data"];
        $user = $_SESSION["id"];
        $username = $_SESSION["username"];
        $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

        $SQL = "INSERT INTO avaliacoes (materia, peso, data_av, id_usr, username) VALUES ('$materia','$peso', '$data', '$user', '$username')";
        header('Location: main.php');
       
        if ($CONN ->query($SQL)){
            header('Location: main.php');
        }
        else{
            echo "Aconteceu um erro!";
            echo "erro: " . $CONN ->error;
        }
        
    }

    $CONN -> close();
?>
