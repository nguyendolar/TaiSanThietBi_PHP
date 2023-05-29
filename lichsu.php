
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
                    <h1 class="mt-4">Lịch sử mượn trả của bạn</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Tên thiết bị</th>
                                        <th>Ảnh</th>
                                        <th>Ngày mượn</th>
                                        <th>Ngày trả</th>
                                        <th>Tình trạng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $idnd = $_SESSION['id'];
                                    $query = "SELECT a.*,b.ten, b.hinhanh
                                    FROM muon as a,thietbi as b
                                     WHERE a.thietbi_id = b.id 
                                     AND a.nguoidung_id = '{$idnd}'
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td> <img style="width: 300px !important;height: 200px !important;" src="./image/<?php echo $arUser['hinhanh'] ?>"></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaymuon"])) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaytra"])) ?></td>
                                        <td><?php echo $arUser["trangthai"] ?> </td>
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