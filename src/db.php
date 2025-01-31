<?php

require_once 'src/config.php';

$db = new mysqli(Config::SERVER_DB, Config::USERNAME_DB, Config::PASSWORD_DB, Config::NAME_DB);

if ($db->connect_errno) {
    printf("Соединение не удалось ", $db->connect_error);
    exit();
}