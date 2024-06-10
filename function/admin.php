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

        // Get vote history
        public function getVoteHistory() {
            try {
                $sql = "SELECT * FROM `votehis` ORDER BY v_votetime DESC";
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get vote history for popular vote
        public function getVotePercentages() {
            try {
                $sql = "SELECT v_color, v_candidate, COUNT(*) as vote_count
                        FROM votehis
                        GROUP BY v_color, v_candidate";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
                $colorVotes = [];
                foreach ($results as $result) {
                    $colorVotes[$result['v_color']][] = $result;
                }
        
                $percentages = [];
                foreach ($colorVotes as $color => $votes) {
                    $totalVotes = array_sum(array_column($votes, 'vote_count'));
                    foreach ($votes as $vote) {
                        $percentages[$color][] = [
                            'candidate' => $vote['v_candidate'],
                            'vote_count' => $vote['vote_count'],
                            'percentage' => round(($vote['vote_count'] / $totalVotes) * 100, 2)
                        ];
                    }
                }
        
                return $percentages;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        // Get candidate with color and number
        public function getCandidatePopularVote($color_team, $candidate_number) {
            try {
                $sql = "SELECT * FROM `candidates` WHERE ca_color = :color_team AND ca_number = :candidate_number";
                $query = $this->conn->prepare($sql);
                $query->bindParam(':color_team', $color_team, PDO::PARAM_STR);
                $query->bindParam(':candidate_number', $candidate_number, PDO::PARAM_INT);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Get Top Vote
        public function getTopVote() {
            try {
                $sql = "SELECT v_color, v_candidate, COUNT(*) as vote_count
                        FROM votehis
                        GROUP BY v_color, v_candidate";
                $query = $this->conn->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
                $topVotes = [];
                foreach ($results as $result) {
                    $color = $result['v_color'];
                    $candidate = $result['v_candidate'];
                    $voteCount = $result['vote_count'];
        
                    if (!isset($topVotes[$color]) || $voteCount > $topVotes[$color]['vote_count']) {
                        $topVotes[$color] = [
                            'candidate' => $candidate,
                            'vote_count' => $voteCount
                        ];
                    }
                }
        
                return $topVotes;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }        
    }