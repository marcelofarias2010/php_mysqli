<?php

include("../Includes/Variaveis.php");
include("../Class/ClassCrud.php");

$Crud=new ClassCrud();
$Crud->insertDB("enquete", "?,?", array($Id, $Radio));
echo "Voto realizado com sucesso";
