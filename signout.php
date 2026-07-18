<?php
session_start();
if(session_destroy()) {
    sleep(2);
    header("Location:index.html");
    exit();
}

?>