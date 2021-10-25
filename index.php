<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "setHead.php"; ?>
</head>
<style>
    .bg-login{
        background-image: url("img/bg-login.png");
        background-size: cover;
        background-position: top;  
        background-repeat: no-repeat;
        border-radius: 50px;
      }
    .box{
        height: 350px;
    }
    .r-box{
        border-radius: 50px;
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
                <div id="login">
                    <div class="container">
                        <div class="card mt-5">
                            <div class="card-body shadow-lg r-box">
                                <div id="login-row" class="row justify-content-center align-items-center box">
                                    <div id="login-column" class="col-md-6">
                                        <div id="login-box" class="col-md-12">
                                            <form id="login-form" class="form" action="login.php" method="post">
                                                <h3 class="text-center ">ระบบ พิมพ์ใบประกาศ วิทยาลัยเทคนิคชลบุรี</h3>
                                                <div class="form-group">
                                                    <label for="username" class="">ชื่อผู้ใช้งาน :</label><br>
                                                    <input type="text" name="username" id="username" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="">รหัสผ่าน :</label><br>
                                                    <input type="password" name="password" id="password" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="เข้าสู่ระบบ">
                                                </div>
                                            </form>
                                            <div class="note mt-3">
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
    </div>
</body>

</html>
<?php require_once "setFoot.php"; ?>