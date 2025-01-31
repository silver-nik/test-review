<?php

require_once 'src/db.php';
require_once 'src/modules/ReviewForm.php';
require_once 'src/modules/User.php';

use Reviews\ReviewForm\ReviewForm;
use Reviews\User\User;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

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

?>

</body>
</html>