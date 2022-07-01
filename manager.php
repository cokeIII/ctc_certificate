<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "setHead.php";
    if (empty($_SESSION["people_id"])) {
        header("location:logout.php");
    }
    ?>
</head>
<style>
    .dataTableLayout {
        table-layout: fixed;
        width: auto;
    }
</style>

<body class="bg-login">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php //require_once "menuSidebar.php"; 
        ?>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once "menuTop.php"; ?>
            <!-- Page content-->
            <div class="container-fluid">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#insertData"><i class="fas fa-plus-circle"></i> เพิ่มรายการอบรม</button>
                            </div>
                        </div>
                        <table class="table" id="listTrain">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รายการอบรม</th>
                                    <th>ระหว่างวันที่</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Modal -->
<div class="modal fade" id="insertData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>เพิ่มรายการอบรม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_train.php" method="post" enctype="multipart/form-data">
                    <div class="form-group mt-2">
                        <label>ชื่อรายการอบรม</label>
                        <input type="text" name="train_name" id="train_name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>วันที่เริ่ม</label>
                        <input type="date" name="date_start" id="date_start" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>วันที่จบ</label>
                        <input type="date" name="date_end" id="date_end" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>หมายเลขเริ่มใบประกาศ</label>
                        <input type="numer" name="cer_min" id="cer_min" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>หมายเลขจบใบประกาศ</label>
                        <input type="numer" name="cer_max" id="cer_max" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label>รูปใบประกาศ</label>
                        <input type="file" name="pic_cer" id="pic_cer" class="form-control" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-md-12"><button class="btn btn-primary mt-3 float-end">เพิ่มรายการ</button></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="passUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>เลือกรายชื่อเพื่อรับใบประกาศ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body w-100">
                <form action="insert_pass.php" method="post">
                    <input type="hidden" name="train_id" id="train_id">
                    <table class="table dataTableLayout" id="listName">
                        <thead>
                            <tr>
                                <td>ลำดับ</td>
                                <td>ชื่อ - สกุล</td>
                                <td>เลือกรายชื่อ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlP = "select * from people";
                            $resP = mysqli_query($conn, $sqlP);
                            $i = 1;
                            while ($rowP = mysqli_fetch_array($resP)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $rowP["people_name"] . " " . $rowP["people_surname"]; ?></td>
                                    <td><input type="checkbox" value="<?php echo $rowP["people_id"]; ?>" name="people_id[]" <?php echo checkName($rowP["people_id"]); ?>></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-end mt-3">บันทึกรายชื่อ</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "setFoot.php"; ?>
<?php
function checkName($people_id)
{
    global $conn;
    $sql = "select * from pass_users where people_id = '$people_id'";
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        return "checked";
    }
    return "";
}
?>
<script>
    $(document).ready(function() {
        // $(document).on('click', '.btnPrint', function() {
        //     $.redirect("report_1.php", {train_id:$(this).attr("trainId")}, "POST", "_blank");
        // })
        let train_id = ""
        $(document).on('click', '.btnSet', function() {
            train_id = $(this).attr("trainId")
            $("#train_id").val(train_id)
        })
        $('#passUsers').on('shown.bs.modal', function() {
            var table = $('#listName').DataTable();
            table.columns.adjust();
        });
        // $("#listName").DataTable().columns.adjust();
        $(document).on('click', '.btnDel', function() {
            if (confirm("ต้องการลบรายการใช่หรือไม่ ?")) {
                $.redirect("del.php", {
                    trainId: $(this).attr("trainId")
                }, "GET");
            }
        })
        $('#listTrain').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true,
            "responsive": true,
            "autoWidth": false,
            "pageLength": 30,
            "scrollX": true,
            "ajax": {
                "url": "getTrainSet.php",
                "type": "POST",
                "data": function(d) {
                    d.getData = true
                }
            },
            'processing': true,
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "train_name"
                },
                {
                    "data": "date"
                },
                {
                    "data": "btn_set"
                },
                {
                    "data": "btn_del"
                }
            ],
            "language": {
                'processing': '<img src="img/tenor.gif" width="80">',
                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "กำลังแสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "search": "ค้นหา:",
                "infoEmpty": "ไม่มีข้อมูลแสดง",
                "infoFiltered": "(ค้นหาจาก _MAX_ total records)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "หน้าต่อไป",
                    "previous": "หน้าก่อน"
                }
            }
        });
    })
</script>