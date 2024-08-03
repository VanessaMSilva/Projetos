<?php
    include_once("templates/header.php")
?>
   <div class="container">
        <?php include_once("templates/backbtn.html");?>
        <h1 id="main-title">EDITAR CONTATO</h1>

        <form id="create-form" action="<?=$BASE_URL?>config/process.php" method="POST">
            <input type="hidden" name="type" value="edit">
            <input type="hidden" name="id" value="<?=$contact['id']?>">

            <div class="form-group">
                <label for="name">Nome do contato:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$contact['name']?>" "Digite o nome" required>
            </div>
            <div  class="form-group">
                <label for="phone">Telefone do contato:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?=$contact['phone']?>" placeholder="Digite o telefone" required>
            </div>
            <div  class="form-group">
                <label for="observations">Nome do observações:</label>
                <textarea type="text" class="form-control" id="observations" name="observations"  placeholder="Digite as observações do contato" rows="3"><?=$contact['observations']?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">EDITAR</button>
        </form>
   </div>
    <?php
    include_once("templates/footer.php")
?>