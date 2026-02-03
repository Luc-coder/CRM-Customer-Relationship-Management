<?php
    class User
    {
        private $conn;

        // Constructor
        public function __construct()
        {
            require __DIR__ . '/../db/connection.php';

            if (!isset($conn)) {
                die("Conexão não encontrada");
            }

            $this->conn = $conn;
        }

        // Insert new user
        public function createNewUser($company, $name, $phone, $email, $password)
        {
            $sql = "INSERT INTO users (company, name, phone, email, password) VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("ssiss", $company, $name, $phone, $email, $password);

            return $stmt->execute();
        }

        // Select user by email
        public function getUserByEmail($email)
        {
            $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc();
        }

        // Get user By id
        public function getUserById($id)
        {
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            return $stmt->get_result()->fetch_assoc();
        }


        // Update user data
        public function updateUser($company, $name, $email, $phone, $id)
        {
            $sql = "UPDATE users SET company = ?, name = ?, email = ?, phone = ? WHERE id = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $company, $name, $email, $phone, $id);
            
            return $stmt->execute();

        }

        // Update user password
        public function updateUserPassword($password, $id)
        {
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("si", $password, $id);
            return $stmt->execute();
        }

        // Delete user account
        public function deleteUser($id)
        {
            $sql = "DELETE FROM users WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }


    }

   

?>