</br>
<?php

if(isset($_SESSION['message_text']) && $_SESSION['message_text'] != '') {

    ?>
        
    <div class="alert alert-<?php echo $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
        <strong><?php echo $_SESSION['message_type'] == "success" ? "¡Bien!" : "¡Ups!" ?></strong> <?php echo $_SESSION['message_text'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php

    unset($_SESSION['message_text']);
    unset($_SESSION['message_type']);

}

?>