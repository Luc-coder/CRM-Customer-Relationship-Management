<?php

class Message {

    private $conn;

    // Constructor
    public function __construct() 
    {
        require __DIR__ . '/../db/connection.php';
        $this->conn = $conn;
    }

    // Enviar mensagem
    public function sendMessage($user_id, $client_id, $sender, $message) 
    {

        $sql = "INSERT INTO messages (user_id, client_id, sender, message)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $user_id, $client_id, $sender, $message);

        return $stmt->execute();
    }

    // Buscar histórico
    public function getMessages($user_id, $client_id) 
    {

        $sql = "SELECT * FROM messages
                WHERE user_id = ?
                AND client_id = ?
                ORDER BY created_at ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $client_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Conta quantas mensagens pelo user logado
    public function countMessages($user_id)
    {
        $sql = "SELECT COUNT(*) AS total FROM messages WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc()['total'];
    }

}