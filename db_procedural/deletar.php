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
    </head>
    <body>
        <?php
        require __DIR__ . '/config.php';
        require __DIR__ . '/database.php';
        require __DIR__ . '/connect.php';
        
        $dropCliente = DBDelete('myguests', 'id = 19');
        if($dropCliente){
            echo "Usuário excluído";
        }else{
            echo "erro ao excluir";
        }
        ?>
    </body>
</html>
