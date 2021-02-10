<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>MySQL</title>
    </head>
    <body>
        <?php
        // put your code here
        require __DIR__."/classeBancoDados.inc";
        $conexao_bd = new classeBancoDados("localhost");
        if (!$conexao_bd->AbrirConexao()) {
            echo "<p>Erro na conexao com banco de dados!<br>" .
            $conexao_bd->MesagemErro() . "</p>";
        } else {
            $conexao_bd->SetSELECT("*", "my_myguests");
            $conexao_bd->SetORDER("firstname");
            if ($conexao_bd->ExecSELECT()) {
                $NumeroRegistros = $conexao_bd->TotalRegistros();
                $DataSet = $conexao_bd->GetDataSet();
                if ($NumeroRegistros > 0) {
                    while ($Registros = $DataSet->fetch_assoc()) {
                        $dados = "<p><b>Nome: " . trim($Registros["firstname"]) . " " .
                                trim($Registros["lastname"]) . "<br>";
                        $dados .= "Email: ".$Registros["email"] . "<br> ";
                        $dados .= "Data de registro: ".$Registros["reg_date"] . "<br></b></p>";
                        echo $dados;
                    }
                }
            } else {
                echo "<p>Erro na execução do comando SELECT </p>";
            }
        }
        $conexao_bd->FecharConexao();
        ?>
    </body>
</html>
