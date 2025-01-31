<?php

namespace Reviews\ReviewForm;

require_once 'src/interfaces/ReviewFormInterface.php';

use Reviews\Interfaces\ReviewFormInterface;

class ReviewForm implements ReviewFormInterface {

    private $db;
    private $clientID;

    public function __construct(object $db, string $clientID) {
        $this->db = $db;
        $this->clientID = $clientID;
    }

    public function handleSubmitEvent() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $ratingValue = isset($_POST["rating"]) ? $_POST["rating"] : null;
            $reviewsValue = isset($_POST["review"]) ? $_POST["review"] : null;

            if ($ratingValue >= 1 && $ratingValue <= 5) {
                
                $stmt = $this->db->prepare("INSERT INTO reviews (ClientID, ReviewValue) VALUES (?, ?)");
                $stmt->bind_param("si", $this->clientID, $ratingValue);
                $stmt->execute();
                
                if($stmt->affected_rows > 0) {
                    echo "Отзыв успешно добавлен";
                }

                $stmt->close();

            }

        }

    }

    public function render() {
        echo <<<FORM

            <!DOCTYPE html>
            <html lang="ru">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <form method="POST" action="">
                    <p>Оцените качество обслуживания 1, 2, 3, 4, 5</p>
                    <div class="rating">
                        <input type="radio" id="rating1" name="rating" value="1">
                        <label for="rating1">1</label>
                        <input type="radio" id="rating2" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input type="radio" id="rating3" name="rating" value="3">
                        <label for="rating3">3</label>
                        <input type="radio" id="rating4" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input type="radio" id="rating5" name="rating" value="5">
                        <label for="rating5">5</label>
                    </div>
                    <p>При желании оставьте комментарий к отзыву:</p>
                    <textarea name="review" placeholder="Оставить комментарий к оценке (необязательное)"></textarea><br><br>
                    <button type="submit">Оставить отзыв</button>
                </form>
            </body>
            </html>

        FORM;
    }

}