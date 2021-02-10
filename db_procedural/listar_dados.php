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
        <h2>Dados registrados no banco</h2>       

        <?php
        require __DIR__ . '/config.php';
        require __DIR__ . '/database.php';
        require __DIR__ . '/connect.php';

        //lendo dados do banco 
        $cliente = DBRead('myguests', null, 'id, firstname, lastname,email,reg_date');
        // var_dump($cliente);     
        ?>
        <table border="1">
            <thead>
                <tr>                    
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>E-mail</th>
                    <th>Data de registro</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($cliente as $key => $value) {
                    ?> 

                    <tr>                        
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['firstname'] ?></td>
                        <td><?= $value['lastname'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td><?= $value['reg_date'] ?></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
        </table>
</html>
