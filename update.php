<?php
session_start();
    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

    $updatemateria = $_POST["updatemateria"];
    $updatepeso = $_POST["updatepeso"];
    $updatedata = $_POST["updatedata"];
    $user = htmlspecialchars($_SESSION["id"]);
    $username = htmlspecialchars($_SESSION["username"]);

    $CONNECT = new mysqli("localhost", "root", "", "banco_de_dados");

    $sql = "SELECT * FROM avaliacoes where id_usr = '$user' ORDER BY id_av";
    $result = $CONN->query($sql);
    $id =  mysqli_fetch_assoc($result)['id_av'];

    if ($updatemateria != null){

        $SQL = "UPDATE avaliacoes set materia = '$updatemateria' where id_usr = $user and id_av = $id";
        $CONN ->query($SQL);
    
    }
    if ($updatepeso != null){

        $SQL = "UPDATE avaliacoes set peso = '$updatepeso' where id_usr = $user and id_av = $id";
        $CONN ->query($SQL);
      
    }
    if ($updatedata != null){

        $SQL = "UPDATE avaliacoes set data_av = '$updatedata' where id_usr = $user and id_av = $id";
        $CONN ->query($SQL);
    }
    
    header('Location: main.php');
    $CONNECT -> close();

?>