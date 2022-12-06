<?php
 session_start();    
 $CONN = new mysqli("localhost", "root", "", "banco_de_dados");
   
    if (isset($_POST['update'])){
       
        $id =  $_POST['id_av'];
        $materia = $_POST['materia1'];
        $peso =$_POST['peso1'];
        $data = $_POST['data1'];

        $sqlUpdate = "UPDATE avaliacoes SET materia='$materia', peso=$peso, data_av='$data' where id_av=$id";
        $result = $CONN->query($sqlUpdate);
    }

    header('Location: main.php');
?>