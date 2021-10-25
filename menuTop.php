<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container-fluid">
    <!-- <button class="btn btn-primary" id="sidebarToggle"><i class="fas fa-bars"></i> เมนู</button> -->
    <button class="navbar-toggler rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
        <li class="nav-item active"><span class="nav-link" href="#!">ระบบ พิมพ์ใบประกาศ วิทยาลัยเทคนิคชลบุรี</span></li>
        <?php if (empty($_SESSION["people_id"])) { ?>
          <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a></li>
        <?php } else { ?>
          <li class="nav-item active"><a class="nav-link" href="main.php"><i class="fas fa-print"></i> พิมพ์ใบประกาศ</a></li>
          <li class="nav-item active"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
        <?php } ?>

        <!-- <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#!">Action</a>
            <a class="dropdown-item" href="#!">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#!">Something else here</a>
          </div>
        </li> -->
      </ul>
    </div>
  </div>
</nav>