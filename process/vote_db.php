<?php require_once '../server/connet.php';
require_once '../function/student.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vote"])) {
        $candidate_number = htmlspecialchars($_POST["candidate"], ENT_QUOTES, "UTF-8");
        $vote = htmlentities($_POST["vote"], ENT_QUOTES, "UTF-8");

        // Call class
        $student = new Student_func();

        // Get student data
        $student_id = $_SESSION['student_ID'];
        $color = $_SESSION["t_color"];

        // Check vote
        $check_vote = $student->checkVote($student_id);
        if ($check_vote) {
            $data = array(
                "status" => "error",
                "message" => "คุณได้ทำการโหวตแล้ว"
            );
            echo json_encode($data);
            exit();
        }

        // Vote candidate
        $vote_candidate = $student->voteCandidate($student_id, $candidate_number, $color);
        if ($vote_candidate) {
            // Update vote status
            $update_vote_status = $student->updateVoteStatus($student_id);
            if ($update_vote_status) {
                $data = array(
                    "status" => "success",
                    "message" => "ขอบคุณสำหรับการโหวตของคุณ"
                );
                echo json_encode($data);
                exit();
            }
        } else {
            $data = array(
                "status" => "error",
                "message" => "โหวตไม่สำเร็จ"
            );
            echo json_encode($data);
            exit();
        }
    }

} catch (Exception $e) {
    $data = array(
        "status" => "error",
        "message" => "โหวตไม่สำเร็จ"
    );
    echo json_encode($data);
    exit();
}