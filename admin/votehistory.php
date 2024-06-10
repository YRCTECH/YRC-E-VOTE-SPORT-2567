<?php require_once '../server/connet.php'; 
require_once '../function/admin.php';
require_once '../function/student.php';
require_once '../function/getColor.php';

// Call class
$admin = new Admin_func();
$student = new Student_func();

// Vote history
$voteHis = $admin->getVoteHistory();
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
                        <h1 class="float-left text-dark">ประวัติการโหวต</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- Vote history -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    รายการ
                                </h3>
                            </div>
                            <div class="card-body">
                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0" id="table-votehis">
                                        <thead>
                                            <tr>
                                                <th scope="col">รหัสนักเรียน</th>
                                                <th scope="col">หมายเลขที่เลือก</th>
                                                <th scope="col">ทีมคณะสี</th>
                                                <th scope="col">เวลาโหวต</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $voteHis->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <tr>
                                                        <td><?php echo $row["v_idstudent"] ?></td>
                                                        <td>หมายเลข <?php echo $row["v_candidate"] ?></td>
                                                        <td><?php echo getTranslateColor($row["v_color"]) ?></td>
                                                        <td><?php echo date("H:i:s น. วันที่ d/m/Y", strtotime($row["v_votetime"])) ?></td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
<script src="../plugin/DataTables/datatables.min.js"></script>
<script src="../plugin/adminlte/adminlte.min.js"></script>
<script src="../plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<!-- Vote histoey -->
<script>
    // Table vote history
    $(document).ready(function() {
        $('#table-votehis').DataTable({
            "order": [
                [3, "desc"]
            ],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "ไม่พบข้อมูล",
                "info": "แสดง _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่พบข้อมูล",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                }
            },

            // Start page length 25
            "pageLength": 10,

            // Design css search order and paging
            
        });
    });

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