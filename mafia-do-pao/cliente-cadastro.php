<?php
include ("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txtnome'];
    $cpf = $_POST['txtcpf'];
    $email = $_POST['txtemail'];
    $telefone = $_POST['txtcel'];


    $sql = "SELECT COUNT(cli_id) FROM tb_clientes WHERE cli_cpf = '$cpf' OR cli_email = '$email'";

    $retorno = mysqli_query($link,$sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    if($contagem == 0){
        $sql = "INSERT INTO tb_clientes(cli_cpf, cli_nome, cli_email, cli_cel, cli_status)
        VALUES('$cpf', '$nome', '$email','$telefone','1')";
        mysqli_query($link,$sql);
        echo "<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='cliente_lista.php';</script>";
    }
    else if($contagem >=1){
        echo "<script>window.alert('CLIENTE JÁ CADASTRADO');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>CADASTRO DE CLIENTES</title>
</head>

<body>
    <div class="container-global">
        <a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25px" height="25px"></a>
        <form class="formulario" action="cliente-cadastro.php" method="post">
            <label>NOME</label>
            <input type="text" name="txtnome" placeholder="DIGITE SEU NOME" required>
            <br>
            <label>CPF</label>
            <input type="text" id="cpf" name="txtcpf" placeholder="000.000.00-00" maxlength="14"
                oninput="formatarCPF(this) required">
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="DIGITE SEU EMAIL" required>
            <br>
            <label>TELEFONE</label>
            <input type="text"  id="telefone" name="txtcel" placeholder="(00) 00000-0000" maxlength="15" required>
            <br>
            <br>
            <input type="submit" value="CADASTRAR">
        </form>
        <script src=scripts/script.js> </script>
    </div>
</body>

</html>