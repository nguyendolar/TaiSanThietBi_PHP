<?php
include('inc/connect.php');

if(isset($_POST['login'])){
    $taikhoan = $_POST['taikhoan'];
    $upass  = $_POST['matkhau'];
    $query = "SELECT * FROM nguoidung WHERE taikhoan='$taikhoan'";
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
      header("Location: login.php?fail=1");
    } 
    else {
    
      $row = mysqli_fetch_array($result);
      if ($upass != $row['matkhau']) {
        header("Location: login.php?fail=1");
      }
      else{
        header("Location: index.php?msg=1");
      $_SESSION['taikhoanadmin'] = $taikhoan;
      $_SESSION['id'] = $row['id'];
      $_SESSION['tenhienthi'] = $row['hoten'];
      $_SESSION['quyen'] = $row['quyen_id'];
      }
    }
    }
    if(isset($_POST['register'])){
      $hoten = $_POST['hoten'];
      $email  = $_POST['email'];
      $sodienthoai  = $_POST['sodienthoai'];
      $diachi = $_POST['diachi'];
      $taikhoan  = $_POST['taikhoan'];
      $matkhau  = $_POST['matkhau'];
      $query = "INSERT INTO nguoidung ( hoten, email, sodienthoai, diachi, taikhoan, matkhau, quyen_id) VALUES ( '{$hoten}', '{$email}', '{$sodienthoai}', '{$diachi}', '{$taikhoan}', '{$matkhau}', 2) ";
      $result = mysqli_query($connect, $query);
      if ($result) {
        header("Location: login.php?msg=1");
      } 
      else {
          header("Location: register.php?msg=2");
      }
    }
 ?> 