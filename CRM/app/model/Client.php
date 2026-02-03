<?php

class Client {

    private $conn;

    // Constructor
    public function __construct()
    {
        require __DIR__ . '/../db/connection.php';
        $this->conn = $conn;
    }

    // Create novo client 
    public function create($user_id, $name, $email, $phone, $company, $status, $source, $notes)
    {
        $sql = "INSERT INTO clients 
        (user_id, name, email, phone, company, status, source, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) return false;

        $stmt->bind_param(
            "isssssss",
            $user_id,
            $name,
            $email,
            $phone,
            $company,
            $status,
            $source,
            $notes
        );

        return $stmt->execute();
    }

    // Seleciona tudo de clients pelo id do user logado
    public function getAllByUser($user_id)
    {
        $sql = "SELECT * FROM clients WHERE user_id = ? ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Seleciona tudo de clients pelo prorpio id
    public function getById($id)
    {
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Altera os dados do client
    public function update($id, $name, $email, $phone, $company, $status, $source, $notes)
    {
        $sql = "UPDATE clients 
                SET name=?, email=?, phone=?, company=?, status=?, source=?, notes=?
                WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) return false;

        $stmt->bind_param(
            "sssssssi",
            $name,
            $email,
            $phone,
            $company,
            $status,
            $source,
            $notes,
            $id
        );

        return $stmt->execute();
    }

    // Deleta client cadastrado
    public function deleteClient($id)
    {
        $sql = "DELETE FROM clients WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Seleciona tudo de clients pelo id do user selecionado. tudo ordenado por nome
    public function getClientsByUser($user_id)
    {
        $sql = "SELECT * FROM clients WHERE user_id = ? ORDER BY name";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Seleciona tudo de clients pelo id do client
    public function getClientById($id)
    {
        $sql = "SELECT * FROM clients WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // Conta quantos clients existem para cada usuário cadastrado
    public function countClients($user_id)
    {
        $sql = "SELECT COUNT(*) AS total FROM clients WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function countLeads($user_id)
    {
        $sql = "SELECT COUNT(*) AS total 
            FROM clients 
            WHERE user_id = ? AND status = 'lead'";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc()['total'];
    }


}
