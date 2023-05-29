
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>

<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tra cứu thiết bị</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Đặt lịch mượn thành công. Vui lòng chờ quản lý xét duyệt</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Ảnh</th>
                                        <th>Loại thiết bị</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    $query = "SELECT a.*,b.ten as 'tenloai'
                                    FROM thietbi as a,loaithietbi as b
                                     WHERE a.loaithietbi_id = b.id 
                                     AND a.soluong > 0
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                        $idModelDe = "exampleModalDe".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td> <img style="width: 300px !important;height: 200px !important;" src="./image/<?php echo $arUser['hinhanh'] ?>"></td>
                                        <td><?php echo $arUser["tenloai"] ?></td>
                                        <td><?php echo $arUser["tinhtrang"] ?> </td>
                                        <td style="width : 140px !important">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDe ?>">
                                                Chi tiết
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelEdit ?>">
                                                Mượn thiết bị
                                            </button>
                                            
                                        </td>
                                    <!-- Modal Detail-->
                                    <div class="modal fade" id="<?php echo $idModelDe ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="col">
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label"><strong>Loại thiết bị:</strong></label>
                                                               <br> <?php echo $arUser["tenloai"] ?><br>
                                                               <label for="category-film"
                                                                class="col-form-label"><strong>Tên thiết bị:</strong></label>
                                                                <br> <?php echo $arUser["ten"] ?><br>
                                                                <label for="category-film"
                                                                class="col-form-label"><strong>Tình trạng:</strong></label>
                                                                <br> <?php echo $arUser["tinhtrang"] ?><br>
                                                                <label for="category-film"
                                                                class="col-form-label"><strong>Số lượng:</strong></label>
                                                                <br> <?php echo $arUser["soluong"] ?><br>
                                                                <label for="category-film"
                                                                class="col-form-label"><strong>Giá trị:</strong></label>
                                                                <br> <?php echo $arUser["giatri"] ?><br>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ảnh:</label>
                                                                <br>
                                                                <img style="width: 300px !important;height: 270px !important;" src="./image/<?php echo $arUser['hinhanh'] ?>">
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label"><strong>Đặc tính kĩ thuật:</strong></label>
                                                                <br> <?php echo $arUser["dactinhkithuat"] ?><br>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    </tr>
                                    <!-- Modal D-->
                                    <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mượn thiết bị</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data" >
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="col">
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Thiết bị:</label>
                                                                <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["ten"] ?>" name="ten" readonly>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày mượn:</label>
                                                                <input type="date" class="form-control" min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>" id="ngay_muon" name="ngaymuon" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày trả:</label>
                                                                <input type="date" class="form-control" min="<?php echo date('Y-m-d', strtotime('+3 days')); ?>" id="ngay_tra" name="ngaytra" required  onchange="validateDate()">
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="muontb">Mượn</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    <?php $stt++;} ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
<script>
function validateDate() {
    var date1 = new Date(document.getElementById("ngay_muon").value);
    var date2 = new Date(document.getElementById("ngay_tra").value);

    // Kiểm tra ngày thứ hai phải lớn hơn ngày thứ nhất
    if (date2 <= date1) {
        alert("Ngày trả phải lớn hơn ngày mượn.");
        document.getElementById("ngay_tra").value = "";
        // Xử lý khi ngày không hợp lệ
    }
}
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>