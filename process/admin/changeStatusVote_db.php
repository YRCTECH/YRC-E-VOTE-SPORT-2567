<?php require_once '../../server/connet.php';
require_once '../../function/admin.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
        $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
        $admin = new Admin_func();
        $admin->changeStatusVote($status);

        $_SESSION['success'] = 'เปลี่ยนสถานะระบบโหวดเรียบร้อย';
        header('location: ../../admin/index.php');
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error: ' . $e->getMessage();
    header('location: ../../admin/index.php');
    exit();
}