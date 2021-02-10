<?php
use core\classes\Store;
?>

<div>

   <?php if(Store::clienteLogado()):?>
    <p>Sim</p>
    <?php else: ?>
        <p>Não</p>
    <?php endif;?>

</div>