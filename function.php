<?php
include('inc/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('inc/library.php');
include('vendor/autoload.php');
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
//Loại thiết bị
if(isset($_POST['adddm'])){
    $ten = $_POST['ten'];
    $query = "INSERT INTO loaithietbi (ten) 
    VALUES ( '{$ten}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: loaithietbi.php?msg=1");
    } 
    else {
        header("Location: loaithietbi.php?msg=2");
    }
}
if(isset($_POST['editdm'])){
    $ten = $_POST['ten'];
    $id  = $_POST['id'];
    $query = "UPDATE `loaithietbi` 
        SET `ten`='{$ten}'
        WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: loaithietbi.php?msg=1");
    } 
    else {
        header("Location: loaithietbi.php?msg=2");
    }
}
if(isset($_POST['deletedm'])){
    $id  = $_POST['id'];
    $check = "SELECT * FROM thietbi WHERE loaithietbi_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: loaithietbi.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM loaithietbi WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: loaithietbi.php?msg=1");
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
//Thông báo
if(isset($_POST['addtb'])){
    $tieude = $_POST['tieude'];
    $noidung = $_POST['noidung'];
    $date = date('d-m-Y');
    $query = "INSERT INTO thongbao ( tieude, noidung) 
    VALUES ( '{$tieude}', '{$noidung}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $querytb = "SELECT * FROM nguoidung WHERE quyen_id = 2";
      $resultb = mysqli_query($connect, $querytb);
      $num_rows = mysqli_num_rows($resultb);
      if ($num_rows > 0) {
        $noidung = '<strong>Tiêu đề :</strong> '.$tieude.'<br> <strong>Ngày tạo :</strong>'.$date.'<br> <strong>Nội dung :</strong><br><p>'.$noidung.'</p>';
        $mail = new PHPMailer(true);                              
        try {
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = SMTP_HOST;  
            $mail->SMTPAuth = true;                               
            $mail->Username = SMTP_UNAME;                 
            $mail->Password = SMTP_PWORD;                           
            $mail->SMTPSecure = 'ssl';                            
            $mail->Port = SMTP_PORT;                                   
            $mail->setFrom(SMTP_UNAME, "WEBSITE NHÀ TRƯỜNG");
            while ($arUser = mysqli_fetch_array($resultb, MYSQLI_ASSOC)) {
            $mail->addAddress($arUser['email'], $arUser['hoten']);     
            }
            $mail->addReplyTo(SMTP_UNAME, 'WEBSITE NHÀ TRƯỜNG');
            $mail->isHTML(true);                                  
            $mail->Subject = 'Thông báo từ hệ thống quản lý tài sản, thiết bị tại trường đại học.';
            $mail->Body = $noidung;
            $mail->AltBody = $noidung; 
            $result = $mail->send();
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
      } 
      header("Location: thongbao.php?msg=1");
    } 
    else {
        header("Location: thongbao.php?msg=2");
    }
}
//Sự cố
if(isset($_POST['addsc'])){
    $tieude = $_POST['tieude'];
    $noidung = $_POST['noidung'];
    $date = date('d-m-Y');
    $query = "INSERT INTO suco ( tieude, noidung, nguoidung_id) 
    VALUES ( '{$tieude}', '{$noidung}', '{$idnd}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $querytb = "SELECT * FROM nguoidung WHERE quyen_id = 1";
      $resultb = mysqli_query($connect, $querytb);
      $num_rows = mysqli_num_rows($resultb);
      if ($num_rows > 0) {
        $noidung = '<strong>Tiêu đề :</strong> '.$tieude.'<br> <strong>Ngày gửi :</strong>'.$date.'<br> <strong>Nội dung :</strong><br><p>'.$noidung.'</p>';
        $mail = new PHPMailer(true);                              
        try {
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = SMTP_HOST;  
            $mail->SMTPAuth = true;                               
            $mail->Username = SMTP_UNAME;                 
            $mail->Password = SMTP_PWORD;                           
            $mail->SMTPSecure = 'ssl';                            
            $mail->Port = SMTP_PORT;                                   
            $mail->setFrom(SMTP_UNAME, "WEBSITE NHÀ TRƯỜNG");
            while ($arUser = mysqli_fetch_array($resultb, MYSQLI_ASSOC)) {
            $mail->addAddress($arUser['email'], $arUser['hoten']);     
            }
            $mail->addReplyTo(SMTP_UNAME, 'WEBSITE NHÀ TRƯỜNG');
            $mail->isHTML(true);                                  
            $mail->Subject = 'Thông báo sự cố.';
            $mail->Body = $noidung;
            $mail->AltBody = $noidung; 
            $result = $mail->send();
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
      } 
      header("Location: suco.php?msg=1");
    } 
    else {
        header("Location: suco.php?msg=2");
    }
}
//Mượn thiết bị
if(isset($_POST['muontb'])){
    $idtb = $_POST['id'];
    $ngaymuon = $_POST['ngaymuon'];
    $ngaytra = $_POST['ngaytra'];
    $query = "INSERT INTO muon (thietbi_id, ngaymuon, ngaytra, nguoidung_id, trangthai) 
    VALUES ( '{$idtb}', '{$ngaymuon}', '{$ngaytra}', '{$idnd}', 'Chờ phê duyệt') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $update = "UPDATE `thietbi` 
        SET `soluong`= soluong - 1
        WHERE `id`='{$idtb}'";
        $resultud = mysqli_query($connect, $update);
      header("Location: tracuu.php?msg=1");
    } 
    else {
        header("Location: tracuu.php?msg=2");
    }
}
//Yêu cầu sửa chữa
if(isset($_POST['ycsc'])){
    $idtb = $_POST['thietbi'];
    $noidung = $_POST['noidung'];
    $query = "INSERT INTO suachua (thietbi_id, noidung, nguoidung_id, tinhtrang) 
    VALUES ( '{$idtb}', '{$noidung}','{$idnd}', 'Chờ xử lý') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: suachua.php?msg=1");
    } 
    else {
        header("Location: suachua.php?msg=2");
    }
}
//Xác nhận sửa chữa
if(isset($_POST['xnsc'])){
    $thoigian = $_POST['thoigian'];
    $chiphi = $_POST['chiphi'];
    $id  = $_POST['id'];
    $query = "UPDATE `suachua` 
        SET `chiphi`='{$chiphi}', `thoigian`='{$thoigian}', `tinhtrang`='Đã xử lý'
        WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: suachua.php?msg=1");
    } 
    else {
        header("Location: suachua.php?msg=2");
    }
}
//Cập nhật cho mượn
if(isset($_POST['capnhat'])){
    $tinhtrang = $_POST['tinhtrang'];
    $id  = $_POST['id'];
    $idtb  = $_POST['thietbiid'];
    $query = "UPDATE `muon` 
        SET `trangthai`='{$tinhtrang}'
        WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        if($tinhtrang == "Đã trả" || $tinhtrang == "Bị từ chối"){
            $update = "UPDATE `thietbi` 
            SET `soluong`= soluong + 1
            WHERE `id`='{$idtb}'";
            $resultud = mysqli_query($connect, $update);
        }
        header("Location: muontra.php?msg=1");
    } 
    else {
        header("Location: muontra.php?msg=2");
    }
}
?>
 