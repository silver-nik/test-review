<?php

require_once 'src/db.php';
require_once 'src/modules/ReviewForm.php';
require_once 'src/modules/User.php';

use Reviews\ReviewForm\ReviewForm;
use Reviews\User\User;

$clientID = isset($_GET["id"]) ? $_GET["id"] : null;

if (!empty($clientID) || is_string($clientID)) {

    $user = new User($db, $clientID);
    $form = new ReviewForm($db, $clientID);
    $id = $user->validateUserId();

    if($id) {

        $form->render();
        $form->handleSubmitEvent();

    } else {

        echo "Ссылка на голосование недоступна, свяжитесь с нами по телефону";

    }

    $db->close();

} else {
    throw new Exception("ID не подходит");
}

