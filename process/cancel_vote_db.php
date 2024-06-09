<?php require_once '../server/connet.php';
require_once '../function/student.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelvote'])) {
        $student_id = $_SESSION['student_ID'];

        // Call class
        $student = new Student_func();

        // Check vote
        $check_vote = $student->checkVote($student_id);
        if (!$check_vote) {
            $data = array(
                'status' => 'error',
                'message' => 'คุณยังไม่ได้ทำการโหวต'
            );
            echo json_encode($data);
            exit();
        }

        // Cancel vote
        $cancel_vote = $student->cancelVote($student_id);
        if ($cancel_vote) {
            // Update vote status for cancel
            $update_vote_status = $student->updateVoteStatusForCancel($student_id);
            if ($update_vote_status) {
                $data = array(
                    'status' => 'success',
                    'message' => 'ยกเลิกการโหวตเรียบร้อย'
                );
                echo json_encode($data);
                exit();
            }
        } else {
            $data = array(
                'status' => 'error',
                'message' => 'ยกเลิกการโหวตไม่สำเร็จ'
            );
            echo json_encode($data);
            exit();
        }
    }
} catch (PDOException $e) {
    $data = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
    echo json_encode($data);
    exit();
}