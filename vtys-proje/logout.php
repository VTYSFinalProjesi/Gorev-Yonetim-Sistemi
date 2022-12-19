<?php
    include('config/constants.php');

    if(session_destroy())
    {
        header("location:index.php");
    }
?>
