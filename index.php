<?php require_once './server/connet.php'; 
require_once './function/student.php';

    // Check for login
    if (empty($_SESSION['student_ID'])) {
        header("location: ./login.php");
        exit();
    }

    $st_ID = $_SESSION['student_ID'];

    // Call function student
    $student = new Student_func();
    $studentData = $student->getStudentData($st_ID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเลือกตั้งประธานสี - โรงเรียนยุพราชวิทยาลัย</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./plugin/bootstrap-5.3.3-dist/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./plugin/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="./plugin/adminlte/adminlte.min.css">
    <link rel="stylesheet" href="./dist/style.css">
</head>
<body class="d-flex flex-column">
    <?php include_once './component/navbar.php' ?>

    <!-- Box -->
    <div class="w-100 p-4 p-lg-5 d-block d-lg-flex gap-5 justify-content-center" style="min-height: 80vh;">
        <!-- Infomation -->
        <div class="col-12 col-lg-3 d-block bg-white shadow-lg rounded-4 mb-5 mb-lg-auto" style="padding: 30px;">
            <h4 class="fs-bold mb-3">ข้อมูลส่วนตัว</h4>
            <p>ชื่อ <?php echo $studentData["st_title"] ?><?php echo $studentData["st_name"] ?> <?php echo $studentData["st_surname"] ?></p>
            <p>รหัสนักเรียน <?php echo $studentData["st_idstudent"] ?></p>
            <p>ระดับชั้น ม.<?php echo $studentData["st_level"] ?>/<?php echo $studentData["st_room"] ?> เลขที่ <?php echo $studentData["st_number"] ?></p>
            <button type="submit" id="logout" class="text-white bg-danger btn"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</button>
        </div>

        <!-- Body -->
        <div class="col-12 col-lg-8 d-block shadow-lg rounded-4 bg-white p-4" style="height: 90vh;"> <!-- Fix height -->

            <!-- Status -->
            <?php include_once './component/success.php' ?>
            <?php include_once './component/error.php' ?>
            
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-auto w-100">
        <?php include_once './component/footer.php' ?>
    </div>
</body>
<script src="./plugin/sweetalert2/sweetalert2.min.js"></script>
<script src="./plugin/jquery.js"></script>
<script src="./plugin/adminlte/adminlte.min.js"></script>
<script src="./plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
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
                    url: "./process/logout_db.php",
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
</script>
<!-- Login success -->
<?php if (isset($_GET["success"])) { ?>
    <script>
        Swal.fire({
                icon: 'success',
                title: 'เข้าสู่ระบบสำเร็จ',
                timer: 2000
            }).then(() => {
                window.location.href = './index.php';
            });
    </script>
<?php } ?>
</html>