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
<?php require_once "setFoot.php"; ?>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btnPrint', function() {
            $.redirect("report_1.php", {train_id:$(this).attr("trainId")}, "POST", "_blank");
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
                "url": "getTrain.php",
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
                    "data": "btn_print"
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