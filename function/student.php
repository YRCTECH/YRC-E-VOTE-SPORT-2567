<?php

    class Student_func extends DB_conn {
        // Login
        public function userLogin($student_ID) {
            try {
                $sql = "SELECT * FROM student WHERE st_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':student_ID', $student_ID, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get student data
        public function getStudentData($student_ID) {
            try {
                $sql = "SELECT * FROM student WHERE st_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }