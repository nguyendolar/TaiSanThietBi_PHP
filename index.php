
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>
<?php 
    if (isset($_GET['msg'])) {
        echo "
                    <script>
                        function Redirect() {
                        window.location = 'index.php';
                        }
                        alert('Đăng nhập thành công !') 
                        Redirect()
                    </script>
                    ";
    }
    ?>
<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
            <?php
        $sumbd = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM thietbi 
        ");
        $artinhnk = mysqli_fetch_array($sumbd);
        $sumkh = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM suachua
        ");
        $artinhkh = mysqli_fetch_array($sumkh);
        $sumpheduyet = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM muon WHERE trangthai = 'Chờ phê duyệt'
        ");
        $pheduyet = mysqli_fetch_array($sumpheduyet);
        $sumchomuon = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM muon WHERE trangthai = 'Đang mượn'
        ");
        $chomuon = mysqli_fetch_array($sumchomuon);

    ?>
                <div class="container-fluid px-4">
                <?php if($_SESSION['quyen'] == 1){ ?>
                <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-danger text-white mb-4">
            <div class="card-body">Yêu cầu đang chờ phê duyệt : <strong> <?php echo $pheduyet['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <div class="small text-white"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">Số thiết bị đang mượn : <strong> <?php echo $chomuon['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <div class="small text-white"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body">Tổng số sửa chữa : <strong> <?php echo $artinhkh['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <div class="small text-white"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-info text-white mb-4">
            <div class="card-body">Tổng số thiết bị : <strong> <?php echo $artinhnk['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <div class="small text-white"></div>
            </div>
          </div>
        </div>
      </div>
      <?php } else{?> 
        <h2>Chào mừng bạn đến với Website tài sản thiết bị nhà trường</h2>
        <?php } ?>
    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>