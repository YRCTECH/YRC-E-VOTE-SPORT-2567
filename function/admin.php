<?php

    class Admin_func extends DB_conn {
        
        // Login
        public function adminLogin($username) {
            try {
                $sql = "SELECT * FROM `admin` WHERE ad_name = :username";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':username', $username, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get admin data
        public function getAdminData($admin_ID) {
            try {
                $sql = "SELECT * FROM `admin` WHERE ad_id = :admin_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':admin_ID', $admin_ID, PDO::PARAM_INT);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get setting
        public function getSetting() {
            try {
                $sql = "SELECT * FROM `settings`";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Change status vote
        public function changeStatusVote($status) {
            try {
                $sql = "UPDATE `settings` SET setting_status = :statusVote";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':statusVote', $status, PDO::PARAM_STR);
                $query->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }