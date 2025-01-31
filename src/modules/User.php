<?php

namespace Reviews\User;

class User {

    private $db;
    private $clientID;

    public function __construct(object $db, string $clientID) {
        $this->db = $db;
        $this->clientID = $clientID;
    }
    
    public function validateUserId() {

        $stmt = $this->db->prepare("SELECT ClientID FROM reviews WHERE ClientID=?");
        $stmt->bind_param("s", $this->clientID);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        return $id;

    }
}