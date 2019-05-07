<?php

if($_GET["signout"] == '1') {
    unset($_SESSION);
    session_destroy();
    header("Refresh:0");
}

?>