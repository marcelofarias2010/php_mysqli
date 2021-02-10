<?php
require_once './classeBancoDados.inc';
require_once './classUsuario.inc';
require_once './ger_selecao_usuario.php';

function CampoTexto($Valor){
    return "'".$Valor."'";
}

function ListaUsuarios($CodigoUsuario){
     $conexao_bd = new classeBancoDados("localhost");
     
     if($conexao_bd->AbrirConexao()){
         $conexao_bd->SetSELECT("*","my_myguests");
         $conexao_bd->SetWHERE("id = ".$CodigoUsuario);
         $conexao_bd->SetORDER("firstname");
         
         if($conexao_bd->ExecSELECT()){
             $NumeroRegistros = $conexao_bd->TotalRegistros();
             $DataSet = $conexao_bd->GetDataSet();
             
             if($NumeroRegistros > 0){
                 $LinhaTabela = "";
                 
                 while ($Registros = $DataSet->fetch_assoc()){
                     $LinhaTabela .="<tr>";
                     $LinhaTabela .="<td>".$Registros["firstname"]."</td>";
                     $LinhaTabela .="<td>".$Registros["lastname"]."</td>";
                     $LinhaTabela .="<td>".$Registros["email"]."</td>";
                     
                     $pagina = "ger_editar_usuario.php?CodigoUsuario=".$Registros["id"];
                     $LinhaTabela .= "<td><button onclick=\"carregar('$pagina')\">Editar</button></td>";
                     $LinhaTabela .= "</tr>";
                 }
             }
         }
     }
     $conexao_bd->FecharConexao();
     return $LinhaTabela;
}

function  RecuperaDadosUsuario($CodigoUsuario){
    $Cadastro = new classUsuario();
    $conexao_bd = new classeBancoDados("localhost");
    
    if(!$conexao_bd->AbrirConexao()){
        echo "<h2>Não foi possível conectar com o banco de dados</h2><br>";
        echo $conexao_bd->CodigoErro()." -> ".$conexao_bd->MesagemErro();
    }
    else{
        $conexao_bd->SetSELECT("*","my_myguests");
        $conexao_bd->SetWHERE("id = ".$CodigoUsuario);
        
        if($conexao_bd->ExecSELECT()){
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0){
                $registros = $DataSet->fetch_assoc();
                
                $Cadastro->setNome($registros["firstname"]);
                $Cadastro->setSobrenome($registros["lastname"]);
                $Cadastro->setEmail($registros["email"]);
            }
        }
        else{
            echo "<h2>Erro na execução do comando SELECT...</h2>";
        }
    }
    $conexao_bd->FecharConexao();
    return $Cadastro;
}