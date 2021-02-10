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
        
        $cliente = array(
            'firstname' => 'Giovanna',
            'lastname' => 'pereira farias'
        );
        
        if(DBUpDate('myguests', $cliente, 'id = 3')){
            echo "Usuário alterado com sucesso";
        } else {
            echo "erro ao alterar";
        }
        
        
        ?>
    </body>
</html>
