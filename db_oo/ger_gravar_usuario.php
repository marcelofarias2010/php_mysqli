<?php

require_once './configuracao.php';
require_once './classeBancoDados.inc';
require_once './funcoes_diversas.php';

$Codigo = $_REQUEST["CodigoUsuario"];
$nome = $_REQUEST["nome"];
$sobrenome = $_REQUEST["sobrenome"];
$email = $_REQUEST["email"];
$ErroDados = FALSE;
$MensagemErro = "";

if (trim($nome) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nome obrigatório...</h3>";
}
if (trim($sobrenome) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Sobrenome obrigatório...</h3>";
}
if (trim($email) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Campo Email obrigatório...</h3>";
}
if (!$ErroDados) {
    $conexao_bd = new classeBancoDados($ServidorMySQL);
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MesagemErro() . "</h3>";
    } else {
        $DadosRegistro["firstname"] = CampoTexto($nome);
        $DadosRegistro["lastname"] = CampoTexto($sobrenome);
        $DadosRegistro["email"] = CampoTexto($email);

        $conexao_bd->SetUPDATE($DadosRegistro, "my_myguests");
        $conexao_bd->SetWHERE("id = $Codigo");

        if (!$conexao_bd->ExecUPDATE()) {
            echo "<h3>Erro na execução do comando UPDATE</h3>";
        } else {
            echo "<h3>Cadastro atualizado com sucesso!</h3>";
        }
    }
    $conexao_bd->FecharConexao();
} else {
    echo $MesagemErro;
}