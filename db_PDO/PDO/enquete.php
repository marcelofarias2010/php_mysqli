<?php
include("Includes/Header.php");
include("Class/ClassCrud.php");
?>

<div class="Content">
    <form name="FormEnquete" id="FormEnquete" action="Controllers/ControllerEnquete.php" method="post">
        Você gostou do curso: <br>
        <input type="radio" name="Radio" value="Sim"> Sim <br>
        <input type="radio" name="Radio" value="Não"> Não <br>
        <input type="submit" value="Votar">
    </form>
</div>

<div>
    <?php
    $Crud=new ClassCrud();
    $BSim=$Crud->selectDB("*", "enquete", "where Voto=?", array("Sim"));
    $BNao=$Crud->selectDB("*", "enquete", "where Voto=?", array("Não"));

    $FSim=$BSim->rowCount();
    $FNao=$BNao->rowCount();

    echo "Votaram sim: ".$FSim."<br>";
    echo "Votaram não: ".$FNao."<br>";
    ?>
</div>

<?php include("Includes/Footer.php"); ?>
