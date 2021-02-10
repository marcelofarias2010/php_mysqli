<?php

/**
 * Description of classeBancoDados
 *
 * @author Marcelo
 */
class classeBancoDados {

    protected $ConexaoBanco;
    protected $IdServidor;
    protected $NumeroUltimoErro;
    protected $DescricaoErro;
    protected $ComandoSQL;
    protected $DataSet;
    protected $NumeroRegistro;
  
    //Construtor
    public function __construct($Servidor = "") {
        $this->ConexaoBanco = NULL;
        $this->NumeroUltimoErro = -1;
        $this->DescricaoErro = "";
        $this->DataSet = NULL;
        $this->NumeroRegistro = 0;

        if ($Servidor === "") {
            $this->IdServidor = "localhost";
        } else {
            $this->IdServidor = $Servidor;
        }
    }

    // Metodos publicos
    public function AbrirConexao() {
        $this->ConexaoBanco = new mysqli($this->IdServidor, "root", "", "mydb");
        if (mysqli_connect_errno() != 0) {
            $this->ConexaoBanco = NULL;
            $this->NumeroUltimoErro = mysqli_connect_errno();
            $this->DescricaoErro = mysqli_connect_error();
            return FALSE;
        } else {
            $this->ConexaoBanco->set_charset("utf8");
            return $this->ConexaoBanco;
        }
    }

    public function CodigoErro() {
        return $this->NumeroUltimoErro;
    }

    public function MesagemErro() {
        return $this->DescricaoErro;
    }

    public function FecharConexao() {
        if ($this->ConexaoBanco === NULL) {
            return FALSE;
        }
        $this->ConexaoBanco->close();
    }

//    public function SetSELECT($Campos = "",$Tabela = "",$CampoOrdenacao = ""){
//        $Ordem = NULL;
//        if(($Campos != "")&&($Tabela != "")){
//            $this->ComandoSQL = "SELECT ".$Campos. " FROM ".$Tabela;
//            
//            if($Ordem != ""){
//                $this->ComandoSQL .= "ORDER BY";
//                $this->ComandoSQL .= $CampoOrdenacao;
//            }
//        }
//    }
    public function SetSELECT($Campos = "", $Tabela = "") {
        if (($Campos != "") && ($Tabela != "")) {
            $this->ComandoSQL = "SELECT " . $Campos . " FROM " . $Tabela;
        }
    }

    public function SetWHERE($Clausula = "") {
        if ($Clausula != "") {
            $this->ComandoSQL .= " WHERE ";
            $this->ComandoSQL .= $Clausula;
        }
    }

    public function SetORDER($CampoOrdenacao = "") {
        if ($CampoOrdenacao != "") {
            $this->ComandoSQL .= " ORDER BY ";
            $this->ComandoSQL .= $CampoOrdenacao;
        }
    }

    public function ExecSELECT() {
        if ($this->ComandoSQL != "") {
            $this->DataSet = $this->ConexaoBanco->query($this->ComandoSQL);

            if ($this->DataSet) {
                $this->NumeroRegistro = $this->DataSet->num_rows;
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function TotalRegistros() {
        return $this->NumeroRegistro;
    }

    public function GetDataSet() {
        return $this->DataSet;
    }

    public function SetINSERT($Valores, $Tabela = "") {
        if (($Tabela != "") && (count($Valores) > 0)) {
            $ListaCampos = "";
            $ListaValores = "";

            foreach ($Valores as $Campo => $Valor) {
                $ListaCampos .= $Campo;
                $ListaValores .= $Valor;
                
                if ($Campo !== @end(array_keys($Valores))) {
                    $ListaCampos .= ",";
                    $ListaValores .= ",";                    
                }
            }
            $this->ComandoSQL = "INSERT INTO $Tabela ($ListaCampos) "
                    . "VALUES ($ListaValores)";
        }
    }

    public function ExecINSERT() {
        if ($this->ComandoSQL != "") {
            $this->Resultado = $this->ConexaoBanco->query($this->ComandoSQL);

            if ($this->Resultado === FALSE)
                return FALSE;
            else {
                if ($this->ConexaoBanco->affected_rows != 1)
                    return FALSE;
                else
                    return TRUE;
            }
        }
        else {
            return FALSE;
        }
    }
    
    public function  SetUPDATE($Valores, $Tabela = ""){
        if(($Tabela != "") && (count($Valores) >0 )){
            $CampoValores = "";
            
            foreach ($Valores as $Campo=>$Valor){
                $CampoValores .=$Campo." = ".$Valor;
                
                if($Campo !== end(array_keys($Valores))){
                    $CampoValores .= ",";
                }
            }
            $this->ComandoSQL = "UPDATE $Tabela SET $CampoValores";
        }
    }
    
    public function ExecUPDATE(){
        if($this->ComandoSQL != ""){
            $this->Resultado = $this->ConexaoBanco->query($this->ComandoSQL);
            
            if($this->Resultado == FALSE){
                return FALSE;
            }
            else{
                if($this->ConexaoBanco->affected_rows == 0){
                    return FALSE;
                }
                else{
                    return TRUE;
                }
            }
        }
        else{
            return FALSE;
        }
    }

}
