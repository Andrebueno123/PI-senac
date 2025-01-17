<?php
include("conexao.php");
require("protecao.php");

if (isset($_POST["nome"])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST["senha"];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM pi_2024_pedidos_funcionarios WHERE email =  '$email'";
    $sql_exec = $mysqli->query($sql) or die($mysqli->error);

    if ($sql_exec->num_rows > 0) {
    } else {
        $mysqlierrno = "falha";
        $mysqli->query("INSERT INTO pi_2024_pedidos_funcionarios (nome, email, senha) values('$nome', '$email', '$senha')") or
            die($mysqlierrno);

        header("Location:login.php");

        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="gabriell.css">

</head>

<body>
    <?php include("menu.php") ?>

    <header>
        <h1>Cadastro de Funcionários</h1>
    </header>

    <div class="container mb-5 d-flex justify-content-center">
        <form class="form" method="post">
            <p class="title">Cadastro </p>
            <div class="flex">
                <label>
                    <input required="" placeholder="" type="text" class="input" name="nome">
                    <span>Nome</span>
                </label>
            </div>
            <label>
                <input required="" placeholder="" type="email" class="input" name="email">
                <span>Email</span>
            </label>
            <?php
            if (isset($_POST["email"])) {
                if ($sql_exec->num_rows > 0) {
                    echo "<div class='alert alert-danger mt-4' role='alert'>
                        Você já tem uma conta!
                    </div>";

                }
            }
            ?>
            <label>
                <input required="" placeholder="" type="password" class="input" name="senha">
                <span>Senha</span>
            </label>
            <button class="submit">Cadastrar</button>
            <input class="btn btn-danger" type="reset" value="Redefinir">
            <a class="btn btn-primary d-flex justify-content-center" href="login.php">Voltar</a><br>
            <br>
            <br>
        
        </form>
    </div>

        
    <?php include("rodape.php") ?>
</body>
</html>