<?php
require __DIR__."/configuracao.php";
require __DIR__."/classeBancoDados.inc";
require __DIR__."/funcoes_diversas.php";
//require __DIR__."/funcoes_diversas.php";

$nome = $_REQUEST["nome"];
$sobrenome = $_REQUEST["sobrenome"];
$email = $_REQUEST["email"];
$ErroDados = FALSE;
$MesagemErro = "";

if(trim($nome) == ""){
    $ErroDados = TRUE;
    $MesagemErro .= "<h3>Nome obrigatório...</h3>";
}

if(trim($sobrenome) == ""){
    $ErroDados = TRUE;
    $MesagemErro .= "<h3>Sobrenome obrigatório...</h3>";
}

if(trim($email) == ""){
    $ErroDados = TRUE;
    $MesagemErro .= "<h3>Email obrigatório...</h3>";
}

if(!$ErroDados){
    $conexao_bd = new classeBancoDados($ServidorMySQL);
    
    if(!$conexao_bd->AbrirConexao()){
        echo "<h3>Erro na conexao com banco de dados!<br>".
                $conexao_bd->MesagemErro()."</h3>";
    }
    else{
        $DadosRegistro["firstname"] = CampoTexto($nome);
        $DadosRegistro["lastname"] = CampoTexto($sobrenome);
        $DadosRegistro["email"] = CampoTexto($email);
        
        $conexao_bd->SetINSERT($DadosRegistro,"my_myguests");
        
        if(!$conexao_bd->ExecINSERT()){
            echo "<h3>Erro na execucao do comando INSERT!</h3>";
        }
        else{
            echo "<h3>Cadastro efetuado com sucesso!</h3>";
        }
    }
    $conexao_bd->FecharConexao();
}
else{
    echo $MesagemErro;
}