<?php
    session_start();

    if((isset ($_SESSION['email']) == false) || (isset($_SESSION['senha']) == false)) {
        session_destroy();
        header("location:index.php");
    }


 ?>
