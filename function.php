<?php
include('inc/connect.php');
$idnd = $_SESSION['id'];
//Người dùng
if(isset($_POST['addnv'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $matkhau  = $_POST['matkhau'];
    $sdt = $_POST['sdt'];
    $taikhoan = $_POST['taikhoan'];
    $diachi = $_POST['diachi'];
    $quyen = 2;
    $query = "INSERT INTO nguoidung ( hoten, email, matkhau, sodienthoai, taikhoan, diachi, quyen_id) 
    VALUES ( '{$hoten}', '{$email}', '{$matkhau}', '{$sdt}', '{$taikhoan}', '{$diachi}', '{$quyen}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: taikhoan.php?msg=1");
    } 
    else {
        header("Location: taikhoan.php?msg=2");
    }
}
if(isset($_POST['editnv'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $matkhau  = $_POST['matkhau'];
    $sdt = $_POST['sdt'];
    $taikhoan = $_POST['taikhoan'];
    $diachi = $_POST['diachi'];
    $quyen = 2;
    $id  = $_POST['id'];
    $query = "UPDATE `nguoidung` 
    SET `hoten`='{$hoten}',`email`='{$email}',`sodienthoai`='{$sdt}',`taikhoan`='{$taikhoan}',`diachi`='{$diachi}', `matkhau`='{$matkhau}', `quyen_id`='{$quyen}'
    WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: taikhoan.php?msg=1");
    } 
    else {
        header("Location: taikhoan.php?msg=2");
    }
}
if(isset($_POST['deletenv'])){
    $id  = $_POST['id'];
    $check = "SELECT nguoidung_id FROM muon WHERE nguoidung_id = '{$id}'
    UNION ALL
    SELECT nguoidung_id FROM suco WHERE nguoidung_id = '{$id}'
    UNION ALL
    SELECT nguoidung_id FROM suachua WHERE nguoidung_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: taikhoan.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM nguoidung WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: taikhoan.php?msg=1");
    }
}
//Thiết bị
if(isset($_POST['addma'])){
    $ten = $_POST['ten'];
    $tinhtrang = $_POST['tinhtrang'];
    $soluong = $_POST['soluong'];
    $giatri = $_POST['giatri'];
    $ltb  = $_POST['ltb'];
    $dtkt  = $_POST['dtkt'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_parts =explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($file_parts));
    $expensions= array("jpeg","jpg","png");
    $image = $_FILES['image']['name'];
    $target = "./image/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $query = "INSERT INTO thietbi ( ten, hinhanh, soluong, giatri, tinhtrang, loaithietbi_id, dactinhkithuat) 
    VALUES ( '{$ten}', '{$image}', '{$soluong}', '{$giatri}', '{$tinhtrang}', '{$ltb}', '{$dtkt}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: thietbi.php?msg=1");
    } 
    else {
        header("Location: thietbi.php?msg=2");
    }
}
if(isset($_POST['editma'])){
    $ten = $_POST['ten'];
    $tinhtrang = $_POST['tinhtrang'];
    $soluong = $_POST['soluong'];
    $giatri = $_POST['giatri'];
    $ltb  = $_POST['ltb'];
    $dtkt  = $_POST['dtkt'];
    $id  = $_POST['id'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    if(empty($file_name)){
        $query = "UPDATE `thietbi` 
        SET `ten`='{$ten}',`soluong`='{$soluong}',`dactinhkithuat`='{$dtkt}',`giatri`='{$giatri}', `tinhtrang`='{$tinhtrang}', `loaithietbi_id`='{$ltb}'
        WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
          header("Location: thietbi.php?msg=1");
        } 
        else {
            header("Location: thietbi.php?msg=2");
        }
    }
    else{
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_parts =explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($file_parts));
        $expensions= array("jpeg","jpg","png");
        $image = $_FILES['image']['name'];
        $target = "./image/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $query = "UPDATE `thietbi` 
        SET `ten`='{$ten}',`soluong`='{$soluong}',`dactinhkithuat`='{$dtkt}',`giatri`='{$giatri}', `tinhtrang`='{$tinhtrang}', `loaithietbi_id`='{$ltb}', `hinhanh`='{$image}'
        WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
          header("Location: thietbi.php?msg=1");
        } 
        else {
            header("Location: thietbi.php?msg=2");
        }
    }
    
}
if(isset($_POST['deletema'])){
    $id  = $_POST['id'];
    $check = "SELECT thietbi_id FROM muon WHERE thietbi_id = '{$id}'
    UNION ALL
    SELECT thietbi_id FROM suachua WHERE thietbi_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: thietbi.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM thietbi WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: thietbi.php?msg=1");
    }
    
}
?>
 