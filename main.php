<?php
    // Inicialize a sessão
    session_start();

    // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

    $id_user = htmlspecialchars($_SESSION["id"]);

    $pega_tipo = "SELECT tipo FROM users where id = '$id_user'";
    $result = $CONN->query($pega_tipo);
    $tipo_usr = mysqli_fetch_assoc($result);
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Yuri</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    
</head>

<body class="body">

    <h1 class="my-5">Oi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Essas são suas Avaliações.</h1>
    <p>
        <a class="btn btn-warning" href="reset-password.php"> Redefina sua senha</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
        <a></a>

        <br><br>
        <?php
        if ($tipo_usr["tipo"] != "admin"){

            echo '<button style="background-color:#fafafa;border:none;color:black" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInserir">
                Inserir Avaliação
            </button>';
        }
        ?>
    </p>
   
    <?php
    $CONN = new mysqli("localhost", "root", "", "banco_de_dados");

    $id_user = htmlspecialchars($_SESSION["id"]);

    $pega_tipo = "SELECT tipo FROM users where id = '$id_user'";
    $result = $CONN->query($pega_tipo);
    $tipo_usr = mysqli_fetch_assoc($result);

    if ($tipo_usr['tipo'] == "admin"){
        $sql = "SELECT * FROM avaliacoes ORDER BY id_av ";
    }
    else {
        $sql = "SELECT * FROM avaliacoes where id_usr = '$id_user' ORDER BY id_av ";
    }

    $result = $CONN->query($sql);
    ?>

    <!-- aqui vai a tabeela em php -->
    <div class="m-5">
        <table class="table text-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Matéria</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Data</th>
                    <?php
                    if ($tipo_usr['tipo'] == "admin"){
                        echo '<th scope ="col">Usuário</th>';
                        echo '<th scope ="col">ID do Usuário</th>';

                    }
                    else{
                        echo '<th scope="col">Editar</th>';
                        echo '<th scope="col">Excluir</th>';
                    }
                    ?>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id_av'] . "</td>";
                    echo "<td>" . $user_data['materia'] . "</td>";
                    echo "<td>" . $user_data['peso'] . "</td>";
                    echo "<td>" . $user_data['data_av'] . "</td>";
                    if ($tipo_usr['tipo'] == "admin"){
                        echo "<td>". $user_data['username']. "</td>";
                        echo "<td>". $user_data['id_usr']. "</td>";
                    }
                    if ($tipo_usr['tipo'] != "admin"){
                        echo "<td><button style='color:#fff; background-color:Transparent; border:none' data-toggle='modal' data-target='#modalupdate'><span><i class='bi bi-pencil-square'></i></span></button></td>";
                        echo "<td><button style='color:#fff; background-color:Transparent; border:none' data-toggle='modal' data-target='#modaldelete'><span><i class='bi bi-trash3'></i></span></button></td>";
                    }
                    echo "</tr>";
                } 
                ?>
            </tbody>
        </table>
        
    </div>
    <!--modal de deletar-->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:#535353;">
                    <div class="modal-header">
                        <h5 style="color:white;" class="modal-title" id="exampleModalLabel">Tem ceteza que deseja exluir a avaliação?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div>
                        <button style="background-color:red;border:none;color:white" type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <a style="background-color:white;border:none;color:black;" class="btn btn-primary" href="delete.php">Sim</a>

                    </div>
                    <br>
                    </form>

                </div>
            </div>
        </div>
    <!--modal de atualizar-->
    <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:#535353;">
                    <div class="modal-header">
                        <h5 style="color:white;" class="modal-title" id="exampleModalLabel">Inserção de Avaliações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="formStyle1" method="post" action="update.php">

                            <div>
                                <p style="color:white;">Matéria</p>
                                <input style=" border-radius:7px;" type="text" class="inp1" name="updatemateria" placeholder="Matéria">
                            </div>
                            <br>
                            <div>
                                <p style="color:white;">Peso</p>
                                <input style=" border-radius:7px;" type="number" class="inp1" name="updatepeso" placeholder="Peso da Avaliação">
                            </div>
                            <br>
                            <div>
                                <p style="color:white;">Data</p>
                                <input style=" border-radius:7px;" type="date" class="inp1" id="date" name="updatedata" placeholder="Data da Avaliação">
                            </div>
                            

                    </div>
                    <br>
                    <div>
                        <button style="background-color:red;border:none;color:white" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button style="background-color:white;border:none;color:black;" class="btn btn-primary">Atualizar</button>

                    </div>
                    <br>
                    </form>

                </div>
            </div>
        </div>

    <div class="container">

        <!-- Modal de Avaliações -->
        <div class="modal fade" id="modalInserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:#535353;">
                    <div class="modal-header">
                        <h5 style="color:white;" class="modal-title" id="exampleModalLabel">Inserção de Avaliações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="formStyle1" method="post" action="salvarAvaliacao.php">

                            <div>
                                <p style="color:white;">Matéria</p>
                                <input style=" border-radius:7px;" type="text" class="inp1" name="materia" placeholder="Matéria">
                            </div>
                            <br>
                            <div>
                                <p style="color:white;">Peso</p>
                                <input style=" border-radius:7px;" type="number" class="inp1" name="peso" placeholder="Peso da Avaliação">
                            </div>
                            <br>
                            <div>
                                <p style="color:white;">Data</p>
                                <input style=" border-radius:7px;" type="date" class="inp1" id="date" name="data" placeholder="Data da Avaliação">
                            </div>
                            

                    </div>
                    <br>
                    <div>
                        <button style="background-color:red;border:none;color:white" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button style="background-color:white;border:none;color:black;" class="btn btn-primary">Salvar</button>

                    </div>
                    <br>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>