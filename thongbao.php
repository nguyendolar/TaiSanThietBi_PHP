
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
                    <h1 class="mt-4">Danh sách thông báo</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAdd">
                                Thêm mới
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    $query = "SELECT *
                                    FROM thongbao
                                     ORDER BY id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDes = "exampleModalDes".$arUser["id"] ;
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["tieude"] ?></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDes ?>">
                                                Xem</a>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaytao"])) ?></td>
                                        
                                            <!--Des-->
                                            <div class="modal fade" id="<?php echo $idModelDes ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $arUser["tieude"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $arUser["noidung"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="col">
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Tiêu đề :</label>
                                                                <input type="text" class="form-control" id="category-film" name="tieude" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Nội dung:</label>
                                                                <textarea name="noidung" class="form-control" cols="30" tabindex="8" rows="10"></textarea>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addtb">Lưu</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
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