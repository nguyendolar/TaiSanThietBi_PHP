
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
                    <h1 class="mt-4">Lịch sử mượn trả</h1>
                    <div class="card mb-4">
                    <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                            
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Người dùng</th>
                                        <th>Tên thiết bị</th>
                                        <th>Ảnh</th>
                                        <th>Ngày mượn</th>
                                        <th>Ngày trả</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT a.*,b.ten, b.hinhanh, c.hoten
                                    FROM muon as a,thietbi as b, nguoidung as c
                                     WHERE a.thietbi_id = b.id 
                                     AND a.nguoidung_id = c.id
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["hoten"] ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td> <img style="width: 300px !important;height: 200px !important;" src="./image/<?php echo $arUser['hinhanh'] ?>"></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaymuon"])) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaytra"])) ?></td>
                                        <td><?php echo $arUser["trangthai"] ?> </td>
                                        <td>
                                        <?php if($arUser["trangthai"] != "Đã trả" && $arUser["trangthai"] != "Bị từ chối"){ ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                           data-bs-target="#<?php echo $idModelEdit ?>">
                                          Cập nhật
                                       </button>
                                       <?php } ?>
                                        </td>
                                        <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật tình trạng yêu cầu</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <input type="hidden" class="form-control" id="id" name="thietbiid" value="<?php echo $arUser["thietbi_id"] ?>">
                                                        <div class="col">
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Tình trạng:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="tinhtrang" required>
                                                                    <option value="" selected>Chọn tình trạng</option>
                                                                    <?php if($arUser["trangthai"] == "Chờ phê duyệt"){ ?>
                                                                        <option value="Đã phê duyệt" >Phê duyệt yêu cầu</option>
                                                                        <option value="Bị từ chối" >Từ chối yêu cầu</option>
                                                                        <?php } ?>
                                                                        <?php if($arUser["trangthai"] == "Đã phê duyệt"){ ?>
                                                                        <option value="Đang mượn" >Đang mượn</option>
                                                                        <?php } ?>
                                                                        <?php if($arUser["trangthai"] == "Đang mượn"){ ?>
                                                                        <option value="Đã trả" >Đã trả</option>
                                                                        <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="capnhat">Cập nhật</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </tr>
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
    CKEDITOR.replace("editor");
    </script>
    <script>
for (var i = 1; i < 200; i++) {
    var name = "editor" + i
    CKEDITOR.replace(name);

}

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>