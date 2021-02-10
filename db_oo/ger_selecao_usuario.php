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
            function carregar(pagina) {
                $("#formulario-edicao").load(pagina);
            }
        </script>
        <script lang="JavaScript">
            function fechar_formulario(){
                location.href="index.php";
            }
        </script>
    </head>
    <body>
        <?php
        // put your code here
        require_once './classeBancoDados.inc';
        require_once './funcoes_diversas.php';
        $CodigoUsuario = 2;
        ?>
       
        <h3><center>Edição de usuário</center></h3><br>
        <table>
            <tr><th>Nome</th><th>Sobrenome</th><th>Email</th></tr>
            <?php echo ListaUsuarios($CodigoUsuario); ?>
        </table>
        <div id="formulario-edicao"></div>
        <br>
        <button type="button" name="btnFechar" onclick="fechar_formulario()">Fechar</button>
    </body>
</html>
