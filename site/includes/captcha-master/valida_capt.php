<?php

session_start();

if ($_SESSION['captcha']['code'] === $_POST['code']) {
    echo 1;
} else {
    echo 0;
}
?>