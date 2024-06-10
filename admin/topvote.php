<?php 
require_once '../server/connet.php'; 
require_once '../function/admin.php';
require_once '../function/student.php';
require_once '../function/getColor.php';

// Call class
$admin = new Admin_func();
$student = new Student_func();

// Get vote percentages
$votePercentages = $admin->getVotePercentages();

// Debug
// $debug = $admin->getTopVote();
// echo "<pre>";
//     print_r($debug);
// echo "</pre>";
// exit();
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
    <link rel="stylesheet" href="../plugin/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../dist/style.css">
    <style>
        .card-img-top {
            object-fit: cover;
            height: 300px;
        }
    </style>
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
                    <div class="col-12">
                        <h1 class="float-left text-dark">ผลโหวตยอดนิยม</h1>

                        <!-- Relaod page -->
                        <div class="float-end">
                            <button type="button" class="btn btn-box-tool" onclick="location.reload()">
                                รีโหลด
                                <i class="fas fa-sync-alt ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Color team -->
                    <?php foreach ($votePercentages as $color => $votes): ?>
                        <div class="col-12 col-md-4 col-xl-4">
                            <div class="card card-primary card-outline" style="border-top: 3px solid <?php getColor(htmlspecialchars($color)); ?>;">
                                <div class="card-header">
                                    <h3 class="card-title fs-5 fs-bold" style="color: <?php getColor(htmlspecialchars($color)); ?>;"><?php getNameColorPar(htmlspecialchars($color)); ?></h3>
                                    <!-- Close button -->
                                    <div class="card-tools float-right">
                                        <button type="button" class="btn btn-box-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <?php 
                                            $topCandidate = $admin->getTopVote()[$color];
                                            $Candidate = $admin->getCandidatePopularVote($color, $topCandidate['candidate']);
                                        ?>
                                        <img src="../candidates/<?php echo $Candidate["ca_image"] ?>" alt="" class="w-100 card-img-top rounded-4 shadow">
                                        <p class="fs-6 text-center mt-1">หมายเลข <?php echo $Candidate["ca_number"] ?></p>
                                    </div>
                                    <?php
                                    usort($votes, function($a, $b) {
                                        return $b['vote_count'] <=> $a['vote_count'];
                                    });
                                    foreach ($votes as $vote): ?>
                                        <div class="progress-group">
                                            <div class="progress mb-1" style="height: 1.5rem;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo htmlspecialchars($vote['percentage']); ?>%; background-color: <?php echo getColor(htmlspecialchars($color)) ?>;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                    หมายเลข <?php echo htmlspecialchars($vote['candidate']); ?> - <?php echo htmlspecialchars($vote['percentage']); ?>%
                                                </div>
                                            </div>
                                            <p>จำนวนโหวต: <?php echo htmlspecialchars($vote['vote_count']); ?> คน</p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
<script src="../plugin/DataTables/datatables.min.js"></script>
<script src="../plugin/adminlte/adminlte.min.js"></script>
<script src="../plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<!-- Top Vote -->
<script>
    

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
