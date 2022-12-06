
<?php

if(!empty($_GET['id'])){

    session_start();    
    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");
    $user = htmlspecialchars($_SESSION["id"]);
    $username = htmlspecialchars($_SESSION["username"]);

    $id =  $_GET['id'];

    $sqlSelect = "SELECT * FROM avaliacoes where id_usr = '$user' and id_av = '$id'";

    $result = $CONN->query($sqlSelect);
    if ($result->num_rows > 0){
        while($user_data = mysqli_fetch_assoc($result)){
            $materia = $user_data['materia'];
            $peso =$user_data['peso'];
            $data = $user_data['data_av'];
        }
    }
    else{
        header('Location: main.php');
    }
   
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body class="body">
    <div class="container">
        <div class="wrapper">
            <h2>Atualizar Avaliação</h2>
            <p>Por favor, preencha este todos os campos do formulário</p>
            <form method="post" action="saveEdit.php">
                <div>
                    <input hidden name="id_av" value="<?php echo $id ?>"/>

                    <p style="color:white;">Matéria</p>
                    <input style=" border-radius:7px;" type="text" class="inp1" name="materia1" placeholder="Matéria" value="<?php echo $materia ?>">
                </div>
                <br>
                <div>
                    <p style="color:white;">Peso</p>
                    <input style=" border-radius:7px;" type="number" class="inp1" name="peso1" placeholder="Peso da Avaliação" value="<?php echo $peso ?>">
                </div>
                <br>
                <div>
                    <p style="color:white;">Data</p>
                    <input style=" border-radius:7px;" type="date" class="inp1" name="data1" placeholder="Data da Avaliação" value="<?php echo $data ?>">
                </div>
        
            <br>
            <div>
                <a style="background-color:red;border:none;color:white" type="button" class="btn btn-secondary" data-dismiss="modal" href="main.php">Fechar</a>
                <input type="submit" name="update" id="update" style="background-color:white;border:none;color:black;" class="btn btn-primary"></button>


            </div>
            <br>
            </form>
        </div>
    </div>
</body>

</html>

