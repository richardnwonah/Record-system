<?php

session_start();

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

if (isset($_SESSION['isAdmin'])) {
    unset($_SESSION['isAdmin']);
}

readfile('header.tmpl.html');

echo 'User logged out.';

readfile('footer.tmpl.html');

?>