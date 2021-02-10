<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com mysqli prcedural</title>
    </head>
    <body>
        <?php
        // define variables and set to empty values
        $name = $email = $sobrenome = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $sobrenome = test_input($_POST["sobrenome"]);   
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Name: <input type="text" name="name">
            <br><br>
            Sobrenome: <input type="text" name="sobrenome">
            <br><br>
            E-mail: <input type="text" name="email">
            <br><br>            
            <input type="submit" name="submit" value="Submit">  
        </form>
        <?php
        require __DIR__ . '/config.php';
        require __DIR__ . '/database.php';
        require __DIR__ . '/connect.php';

        //Inserindo um dados 
//            $query = "INSERT INTO myguests (firstname, lastname, email) "
//                    . "VALUES ('Dudu','Murino','dudu@teste.com.br')";
//            var_dump(DBExecute($query));
//            
        // inserindo dados por array
        if(!empty($name && $sobrenome && $email)){
            $cliente = array(
                'firstname' => $name,
                'lastname' => $sobrenome,
                'email' => $email                
            );
            $grava = DBCreate('myguests', $cliente);
            //var_dump($grava);
            if($grava){
                echo 'ok, gravou';
            }else{
                echo 'erro ao gravar';
            }
        }else{
            return false;
        }
            
        //lendo dados do banco 
//        $cliente = DBRead('myguests', null, 'firstname, lastname,email');
//        var_dump($cliente);
        ?>
    </body>
</html>
