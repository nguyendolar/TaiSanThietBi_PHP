
<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                    <?php if($_SESSION['quyen'] == 1){ ?>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                           Thống kê dữ liệu
                        </a>
                        <a class="nav-link" href="taikhoan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý tài khoản
                        </a>
                        <a class="nav-link" href="thietbi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý thiết bị
                        </a>
                        <a class="nav-link" href="nhaphang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý mượn trả
                        </a>
                        <a class="nav-link" href="xuathang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý thông báo
                        </a>
                        <a class="nav-link" href="xuathang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý sửa chữa
                        </a>
                        <a class="nav-link" href="xuathang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Quản lý sự cố
                        </a>
                        <a class="nav-link" href="nguoidung.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Người dùng
                        </a>
                        <?php } else{?>
                        <a class="nav-link" href="nhacungcap.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Tra cứu thiết bị
                        </a>
                        <a class="nav-link" href="sanpham.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Lịch sử mượn trả
                        </a>
                        <a class="nav-link" href="nhaphang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thông báo sự cố
                        </a>
                        <a class="nav-link" href="xuathang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Gửi yêu cầu sửa chữa
                        </a>
                            <?php } ?>
                    </div>
                </div>
            </nav>
        </div>