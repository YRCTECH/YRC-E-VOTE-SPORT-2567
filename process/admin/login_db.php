<?php require_once '../../server/connet.php';
require_once '../../function/admin.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        $admin = new Admin_func();
        $result = $admin->adminLogin($username);
        
        if ($result) {
            if ($password != $result['ad_password']) {
                $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                header('location: ../../admin/login.php?error=1');
                exit();
            } else {
                $_SESSION['admin_ID'] = $result['ad_id'];
                $_SESSION['rank'] = 'admin';
                $_SESSION['success'] = 'เข้าสู่ระบบสำเร็จ';
                header('location: ../../admin/index.php?success=1');
                exit();
            }
        } else {
            $_SESSION['error'] = 'ไม่พบข้อมูลผู้ดูแลระบบ';
            header('location: ../../admin/login.php?error=1');
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: ../../admin/login.php?error=1');
    exit();
}