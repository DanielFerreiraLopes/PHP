<?php
        session_start();

        $_GET = ['nome'];
        $_GET = ['cpf'];
        $_GET = ['data_nacimento'];

        $conexao = new PDO("mysql:host=localhost;port=3306;dbname=php-crud","root","devisate");
        
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $sql = " SELECT * FROM cliente WHERE ";
        if (isset($_GET['nome'])) {
            $sql .=" nome LIKE :nome AND ";
        }
        if (isset($_GET['cpf'])) {
            $sql .=" cpf LIKE :cpf AND ";
        }
        if (isset($_GET['data_nacimento'])) {
            $sql .=" data_de_nacimento LIKE :data_nacimento AND ";
        }

        $sql = rtrim($sql, " WHERE ");
        $sql = rtrim($sql, " AND ");

        $comando = $conexao->prepare($sql);

        $comando->execute(array_filter($_GET));

        $cliente = $comando->fetchAll(PDO::FETCH_ASSOC);

        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" href="../flex.css">
    <link rel="stylesheet" href="../flex-style.css">
</head>

<body>

    <!-- 'box' deixa as bordas redondar e 'box-square' deixa as bordas quadradas-->
    <header class="box-square space-20 text-center">
        Seja bem Vindo,
       
    </header>

    <div class="grow flex-col space-30">

        <div class="flex-row space-between">
            <h1>Listagem de Clientes</h1>
            <a href="" class="button primary">Cadastro</a>
        </div>

        <fieldset class="">
            <legend>Filtros</legend>
            <form action="" class="flex-row  space-30">
                <input name="nome" type="text" placeholder="Nome">
                <input name="cpf" type="number" placeholder="CPF">
                <input name="data_nacimento" type="date">
                <button type="submit" class="button primary">Buscar</button>
            </form>
        </fieldset>

        <table>
            <tr>
                <th> ID </th>
                <th> Nome </th>
                <th> CPF </th>
                <th> Data de Nacimento </th>
                <th> Ações </th>
            </tr>
            <tbody>
            <?php

                foreach($cliente as $c){

                    echo "<tr>";
                    echo "<td>". $c['id'] ."</td>";
                    echo "<td>". $c['nome'] ."</td>";
                    echo "<td>". $c['cpf'] ."</td>";
                    echo "<td>" . date('d/m/Y', strtotime($c['data_de_nacimento']))."</td>";
                    echo "<td><a href=''>Editar</a> <br><a href=''>Excluir</a></td>";
                    echo "</tr>";
                }                       

               
            ?>
            </tbody>
        </table>
    </div>

    <footer class="box-square space-20 text-center">
        Daniel .F. Lopes <?php echo date('Y') ?>
    </footer>
    <?php

    ?>

</body>

</html>
