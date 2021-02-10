
<?php
include './Includes/Header.php';
//include ("{$_SERVER['DOCUMENT_ROOT']}/Mysqli/db_PDO/PDO/Class/ClassCrud.php");
include __DIR__ . "./Class/ClassCrud.php";
?>

<div class="content">
    <table class="TabelaCrud">
        <tr>
            <td>Nome</td>
            <td>Sexo</td>
            <td>Cidade</td>
            <td>Ações</td>
        </tr>

        <!-- Estrutura de loop -->
        <?php
        $Crud = new ClassCrud();
        $BFetch = $Crud->selectDB("*", "cadastro", "", array());

        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $Fetch['Nome']; ?></td>
                <td><?php echo $Fetch['Sexo']; ?></td>
                <td><?php echo $Fetch['Cidade']; ?></td>
                <td>
                    <a href="<?php echo "visualizar.php?id={$Fetch['Id']}"; ?>">
                        <img src="Images/Visualizar.png" alt="Visualizar">
                    </a>
                    <a href="<?php echo "cadastro.php?id={$Fetch['Id']}"; ?>">
                        <img src="Images/Edite.png" alt="Editar">
                    </a>
                    <a class="Deletar" href="<?php echo "Controllers/ControllerDeletar.php?id={$Fetch['Id']}"; ?>">
                        <img src="Images/Lixeira.png" alt="Deletar">
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include './Includes/Footer.php'; ?>