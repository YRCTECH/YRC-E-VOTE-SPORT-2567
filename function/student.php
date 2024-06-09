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

        // Get num row
        public function getNumRowStudent() {
            try {
                $sql = "SELECT * FROM student";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $result = $query->rowCount();
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get num row vote
        public function getNumRowVote() {
            try {
                $sql = "SELECT * FROM student WHERE st_vote = 1";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $result = $query->rowCount();
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get student level vote
        public function getNumVoteWithLevel($student_level) {
            try {
                $sql = "SELECT * FROM student WHERE st_vote = 1 AND st_level = :student_level";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_level", $student_level, PDO::PARAM_STR);
                $query->execute();
                $result = $query->rowCount();
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get status vote
        public function getStatusVote() {
            try {
                $sql = "SELECT * FROM settings WHERE setting_id = 1";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get candidate data
        public function getCandidateData($color_t) {
            try {
                $sql = "SELECT * FROM candidates WHERE ca_color = :color";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":color", $color_t, PDO::PARAM_STR);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Vote candidate
        public function voteCandidate($student_ID, $candidate_number, $color_t) {
            try {
                $sql = "INSERT INTO votehis (v_idstudent, v_candidate, v_color) VALUES (:student_ID, :candidate_number, :color_t)";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->bindParam(":candidate_number", $candidate_number, PDO::PARAM_STR);
                $query->bindParam(":color_t", $color_t, PDO::PARAM_STR);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Update vote status
        public function updateVoteStatus($student_ID) {
            try {
                $sql = "UPDATE student SET st_vote = 1 WHERE st_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Check vote
        public function checkVote($student_ID) {
            try {
                $sql = "SELECT * FROM votehis WHERE v_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Cancel vote
        public function cancelVote($student_ID) {
            try {
                $sql = "DELETE FROM votehis WHERE v_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Update vote status for cancel
        public function updateVoteStatusForCancel($student_ID) {
            try {
                $sql = "UPDATE student SET st_vote = 0 WHERE st_idstudent = :student_ID";
                $query = $this->conn->prepare($sql);
                $query->bindParam(":student_ID", $student_ID, PDO::PARAM_STR);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }