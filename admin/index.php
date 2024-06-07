<?php require_once '../server/connet.php'; 
require_once '../function/admin.php';
require_once '../function/student.php';
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
        <!-- Content header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- Count Student -->
                    <div class="col-12 col-md d-flex align-items-stretch">
                        <div class="info-box bg-info flex-fill">
                            <span class="info-box-icon"><i class="fa-solid fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวนนักเรียนทั้งหมด</span>
                                <span class="info-box-number"><?php echo $num_row_student ?> คน</span>
                            </div>
                        </div>
                    </div>

                    <!-- Count Vote -->
                    <div class="col-12 col-md d-flex align-items-stretch">
                        <div class="info-box bg-warning flex-fill">
                            <span class="info-box-icon"><i class="fa-solid fa-check-to-slot"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวนนักเรียนที่โหวต</span>
                                <span class="info-box-number"><?php echo $num_row_vote ?> คน</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo ($num_row_vote / $num_row_student) * 100 ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vote Status -->
                    <div class="col-12 col-md d-flex align-items-stretch">
                        <div id="voteStatusBtn" class="info-box <?php echo $setting["setting_status"] == "ON" ? "bg-success" : "bg-danger" ?> flex-fill">
                            <span class="info-box-icon" id="voteStatusIcon">
                                <?php echo $setting["setting_status"] == "ON" ? '<i class="fa-solid fa-unlock"></i>' : '<i class="fa-solid fa-lock"></i>' ?>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">สถานะ</span>
                                <span class="info-box-number" id="voteStatusText"><?php echo $setting["setting_status"] == "ON" ? "เปิดโหวด" : "ปิดโหวด" ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- Chart level vote -->
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">จำนวนนักเรียนที่โหวดในแต่ละระดับชั้น</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa-solid fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="chart">
                                            <canvas id="LevelVote"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <?php include_once './component/footer.php' ?>
</body>
<script src="../plugin/ChartJS/chart.js"></script>
<script src="../plugin/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugin/jquery.js"></script>
<script src="../plugin/adminlte/adminlte.min.js"></script>
<script src="../plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<!-- index -->
<script>
    // Level Vote
    $(document).ready(function() {
        var ctx = document.getElementById('LevelVote');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['ม.1', 'ม.2', 'ม.3', 'ม.4', 'ม.5', 'ม.6'],
            datasets: [{
                label: 'จำนวนนักเรียน',
                data: [<?php echo $student->getNumVoteWithLevel(1) ?>, 
                        <?php echo $student->getNumVoteWithLevel(2) ?>, 
                        <?php echo $student->getNumVoteWithLevel(3) ?>, 
                        <?php echo $student->getNumVoteWithLevel(4) ?>, 
                        <?php echo $student->getNumVoteWithLevel(5) ?>, 
                        <?php echo $student->getNumVoteWithLevel(6) ?>],
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
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
                            timer: 2000
                        }).then((result) => {
                            location.href = './login.php';
                        });
                    }
                });
            }
        });
    });

    // Change status vote
    $("#changeStatus").click(function() {
        var status = "<?php echo $setting["setting_status"] == "ON" ? "OFF" : "ON" ?>";
        Swal.fire({
            title: 'เปลี่ยนสถานะโหวด',
            text: "คุณต้องการเปลี่ยนสถานะโหวดหรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'เปลี่ยนสถานะ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../process/admin/changeStatusVote_db.php",
                    data: {
                        status: status
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'เปลี่ยนสถานะโหวดสำเร็จ',
                            text: "กำลังเปลี่ยนสถานะโหวด...",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        })
    });
</script>
</html>