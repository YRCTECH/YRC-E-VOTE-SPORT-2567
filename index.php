<?php require_once './server/connet.php'; 
require_once './function/student.php';
require_once './function/getColor.php';

// Call class
$student = new Student_func();

// Set color team from session
$color = $_SESSION["t_color"];

// Get Candidate
$candidates = $student->getCandidateData($color);
$candidates_num = $candidates->rowCount();
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
    <style>
        .card-img-top {
            object-fit: cover;
            height: 300px;
        }

        .ca-img, .ca-text {
            transition: 0.3s;
        }

        .ca-img:hover {
            box-shadow: 0 0 100px rgba(0, 0, 0, 0.3);
        }

        .ca-text:hover {
            color: <?php getColorText($color) ?>;
        }

        .blur {
            filter: blur(5px);
        }

        .candidate {
            cursor: pointer;
            transition: 0.3s;
        }

        .candidate:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="d-flex flex-column">
    <!-- Navbar -->
    <?php include_once './component/navbar.php' ?>

    <!-- Box -->
    <div class="w-100 p-4 p-lg-5 d-block d-lg-flex gap-5 justify-content-center">
        <!-- Infomation -->
        <div class="col-12 col-lg-3 d-block bg-white shadow-lg rounded-4 mb-5 mb-lg-auto" style="padding: 30px;">
            <h4 class="fs-bold mb-3">ข้อมูลส่วนตัว</h4>
            <p>ชื่อ <?php echo $studentData["st_title"] ?><?php echo $studentData["st_name"] ?> <?php echo $studentData["st_surname"] ?></p>
            <p>รหัสนักเรียน <?php echo $studentData["st_idstudent"] ?></p>
            <p>ระดับชั้น ม.<?php echo $studentData["st_level"] ?>/<?php echo $studentData["st_room"] ?> เลขที่ <?php echo $studentData["st_number"] ?></p>

            <!-- Status vote -->
            <?php if ($studentData["st_vote"] == 1) { ?>
                <p class="text-success">สถานะ: <b>เลือกตั้งแล้ว</b></p>
                <button class="btn btn-secondary cancel-vote">ยกเลิกการโหวต</button>
            <?php } else { ?>
                <p class="text-danger">สถานะ: <b>ยังไม่เลือกตั้ง</b></p>
            <?php } ?>

            <!-- Logout -->
            <button type="submit" id="logout" class="text-white bg-danger btn"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</button>
        </div>

        <!-- Body -->
        <div class="col-12 col-lg-8 d-block shadow-lg rounded-4 bg-white p-4">

            <!-- Title -->
            <div class="mb-0 mb-md-4">
                <h4 class="fs-bold text-center">เลือกตั้งประธานสี<br><b style="color: <?php getColorText($color) ?>;"><?php getNameColor($color) ?></b></h4>
            </div>

            <!-- Read candidates -->
            <?php if ($candidates_num % 2 == 0) { ?>
                <div class="row row-cols-1 row-cols-md-2">
                    <?php while ($row = $candidates->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col mt-5 mt-md-4">
                            <div class="col-12 col-md-10 col-xl-8 h-100 m-auto candidate">
                                <img src="./candidates/<?php echo htmlspecialchars($row['ca_image']); ?>" alt="Candidate Image" class="card-img-top w-100 rounded-4 ca-img">
                                <div class="card-body p-0 pt-3">
                                    <p class="text-center h5 ca-text">หมายเลข <?php echo htmlspecialchars($row['ca_number']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <?php while ($row = $candidates->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col mt-5 mt-md-0">
                            <div class="col-12 col-md-10 col-lg-12 col-xl-10 h-100 m-auto candidate">
                                <img src="./candidates/<?php echo htmlspecialchars($row['ca_image']); ?>" alt="Candidate Image" class="card-img-top w-100 rounded-4 ca-img">
                                <div class="card-body p-0 pt-3">
                                    <p class="text-center h5 ca-text">หมายเลข <?php echo htmlspecialchars($row['ca_number']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            
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
<!-- Everypage -->
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

<!-- index -->
<script>
    // Login Success
    <?php if (isset($_GET["success"]) && $_GET["success"] == "loginsuccess") { ?>
        Swal.fire({
            icon: 'success',
            title: 'เข้าสู่ระบบสำเร็จ',
            timer: 2000
        }).then(() => {
            window.location.href = './index.php';
        });
    <?php } ?>

    // Hover effects
    $(".candidate").hover(
        function() {
            $(".candidate").not(this).find(".ca-img, .ca-text").addClass("blur");
            $(this).find(".ca-img").addClass("highlight");
            $(this).find(".ca-text").addClass("highlight-text");
        }, function() {
            $(".candidate").not(this).find(".ca-img, .ca-text").removeClass("blur");
            $(this).find(".ca-img").removeClass("highlight");
            $(this).find(".ca-text").removeClass("highlight-text");
        }
    );

    // Click candidate
    $(".candidate").click(function() {
        Swal.fire({
            title: 'เลือกตั้ง',
            text: "คุณต้องการเลือกหมายเลข " + $(this).find(".ca-text").text().split(" ")[1] + " ใช่หรือไม่?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '<?php getColorText($color) ?>',
            confirmButtonText: 'ยืนยันการเลือก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./process/vote_db.php",
                    data: {
                        vote: true,
                        candidate: $(this).find(".ca-text").text().split(" ")[1]
                    }
                }).then((response) => {
                    var data = JSON.parse(response);
                    if (data.status == "error") {
                        Swal.fire({
                            title: 'เลือกตั้งไม่สำเร็จ',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: "gray",
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            title: 'เลือกตั้งสำเร็จ',
                            text: "ขอบคุณสำหรับการโหวตของคุณ",
                            icon: 'success',
                            confirmButtonColor: '<?php getColorText($color) ?>',
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });
    })

</script>
</html>