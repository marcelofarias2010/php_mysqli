<?php

include("../Class/ClassCrud.php");

$Crud = new ClassCrud();
$IdUser = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$Crud->deleteDB(
        "cadastro", "Id=?", "i", array(
    $IdUser
        )
);

echo "Dado deletado com sucesso!";
