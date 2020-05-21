<?php
    //Start session
    session_start();
    
    //Unset the variables stored in session
    unset($_SESSION['user_id']);
    unset($_SESSION['user']);
    unset($_SESSION['logon']);
    header("location: index.php");
?>