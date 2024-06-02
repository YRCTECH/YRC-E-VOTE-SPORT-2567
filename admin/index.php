<?php require_once '../server/connet.php'; 
require_once '../function/admin.php';

    // Check for login
    if (empty($_SESSION['admin_ID'])) {
        header('location: ./login.php');
    }

    // Check for rank
    if ($_SESSION['rank'] != 'admin') {
        header('location: ../index.php');
    }

    // Get admin data
    $admin_ID = $_SESSION['admin_ID'];
    $admin = new Admin_func();
    $admin_data = $admin->getAdminData($admin_ID);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเลือกตั้งประธานสี - โรงเรียนยุพราชวิทยาลัย</title>
    <link rel="shortcut icon" href="../assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../plugin/bootstrap-5.3.3-dist/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../plugin/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../plugin/adminlte/adminlte.min.css">
    <link rel="stylesheet" href="../dist/style.css">
</head>
<body class="wrapper">
    <!-- Navbar -->
    <?php include_once './component/navbar.php' ?>
    <!-- Sidebar -->
    <?php include_once './component/sidebar.php' ?>

    <!-- Content -->
    <div class="content-wrapper">
        dasdasdasd
    </div>

    <!-- Footer -->
    <?php include_once './component/footer.php' ?>
</body>
<script src="../plugin/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugin/jquery.js"></script>
<script src="../plugin/adminlte/adminlte.min.js"></script>
<script src="../plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<script>
    // Logout
    $("#logout").click(function() {
        Swal.fire({
            title: 'ออกจากระบบ',
            text: "คุณต้องการออกจากระบบหรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'ออกจากระบบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../process/logout_db.php",
                    data: {
                        logout: true
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ออกจากระบบสำเร็จ',
                            text: "กำลังออกจากระบบ...",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.href = './login.php';
                        });
                    }
                });
            }
        });
    });

    // Login success
    <?php if (isset($_GET["success"])) { ?>
        Swal.fire({
            icon: 'success',
            title: 'เข้าสู่ระบบสำเร็จ',
            timer: 2000
        }).then(() => {
            window.location.href = './index.php';
        });
    <?php } ?>
</script>
</html>