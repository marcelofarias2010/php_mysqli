<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="jquery-3.5.1.js" type="text/javascript"></script>
        <script>
            $(document).ready(function (){
               $("#btnConfirmar").click(function (){
                   var codigo_usuario = $("input[name=CodigoUsuario]").val();
                   var nome = $("input[name=nome]").val();
                   var sobrenome = $("input[name=sobrenome]").val();
                   var email = $("input[name=email]").val();
                   
                   $.ajax({
                      "url":"ger_gravar_usuario.php",
                      "dataType":"html",
                      "data":{
                          "CodigoUsuario":codigo_usuario,
                          "nome":nome,
                          "sobrenome":sobrenome,
                          "email":email
                      },
                      "success":function(response);
                      {
                          $("div#retorn").html(response);
                          setTimeout("location.href = 'index.php'",5000);
                      }
                   });
               }); 
            });
        </script>
    </head>
    <body>
        <?php
            require_once './classUsuario.inc';
            require_once './funcoes_diversas.php';
            
            
            $CodigoUsuario = $_GET["CodigoUsuario"];
            $DadosUsuario = new classUsuario();
            $DadosUsuario = RecuperaDadosUsuario($CodigoUsuario);
        ?>
        
        <p>Edição de usuário</p>
        <form name="formEditarUsuario">
            <input name="CodigoUsuario" value="<?php $CodigoUsuario; ?>" type="hidden">
            <p>Nome:<input value="<?php $DadosUsuario->getNome();?>" maxlength="20" size="20" tabindex="1" name="nome"</p>
            <p>Sobrenome:<input value="<?php $DadosUsuario->getSobrenome();?>" maxlength="20" size="20" tabindex="2" name="sobrenome"</p>
            <p>E-mail:<input value="<?php $DadosUsuario->getEmail();?>" maxlength="60" size="60" tabindex="3" name="email"</p>
            <button type="submit" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
        </form>
        <div id="retorno"></div>
    </body>
</html>
