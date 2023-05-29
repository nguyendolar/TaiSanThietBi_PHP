-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 29, 2023 lúc 10:17 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `taisanthietbi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithietbi`
--

CREATE TABLE `loaithietbi` (
  `id` int(11) NOT NULL,
  `ten` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaithietbi`
--

INSERT INTO `loaithietbi` (`id`, `ten`) VALUES
(1, 'Thiết bị phòng học'),
(2, 'Thiết bị ngoài trời');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muon`
--

CREATE TABLE `muon` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `thietbi_id` int(11) NOT NULL,
  `ngaymuon` date NOT NULL,
  `ngaytra` date NOT NULL,
  `trangthai` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `muon`
--

INSERT INTO `muon` (`id`, `nguoidung_id`, `thietbi_id`, `ngaymuon`, `ngaytra`, `trangthai`) VALUES
(1, 2, 6, '2023-05-30', '2023-06-03', 'Đã trả'),
(2, 2, 5, '2023-05-30', '2023-06-03', 'Đã trả'),
(3, 2, 6, '2023-05-31', '2023-06-22', 'Chờ phê duyệt'),
(4, 2, 5, '2023-06-01', '2023-07-04', 'Chờ phê duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id` int(11) NOT NULL,
  `hoten` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sodienthoai` varchar(250) NOT NULL,
  `diachi` varchar(2500) NOT NULL,
  `taikhoan` varchar(500) NOT NULL,
  `matkhau` varchar(500) NOT NULL,
  `quyen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `hoten`, `email`, `sodienthoai`, `diachi`, `taikhoan`, `matkhau`, `quyen_id`) VALUES
(1, 'Quản trị viên', 'nguyencaonguyencmu@gmail.com', '0394073645', 'Hà Nội', 'admin', '123456', 1),
(2, 'Lê Văn Nguyên', 'nguyencaonguyencmu@gmail.com', '0394073746', 'Hà Nội', 'lenguyen', '123456', 2),
(4, 'Lê Văn Oanh', 'lethikieuoanh1a10@gmail.com', '0394073746', 'Hà Nội', 'len1guyen', '123456', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id` int(11) NOT NULL,
  `ten` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id`, `ten`) VALUES
(1, 'Admin'),
(2, 'Người dùng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suachua`
--

CREATE TABLE `suachua` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `thietbi_id` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `ngaygui` date NOT NULL DEFAULT current_timestamp(),
  `chiphi` varchar(500) NOT NULL,
  `thoigian` varchar(500) NOT NULL,
  `tinhtrang` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `suachua`
--

INSERT INTO `suachua` (`id`, `nguoidung_id`, `thietbi_id`, `noidung`, `ngaygui`, `chiphi`, `thoigian`, `tinhtrang`) VALUES
(1, 2, 5, 'yêu cầu sửa cho tôi\r\n', '2023-05-29', '400000', '3 ngày', 'Đã xử lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suco`
--

CREATE TABLE `suco` (
  `id` int(11) NOT NULL,
  `tieude` varchar(2500) NOT NULL,
  `noidung` text NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `ngaygui` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `suco`
--

INSERT INTO `suco` (`id`, `tieude`, `noidung`, `nguoidung_id`, `ngaygui`) VALUES
(2, 'Máy tính bị lag và chậm', 'Dung lượng máy còn ít nên xảy ra tình trạng chạy chậm và giật lag', 2, '2023-05-21'),
(3, 'Quạt ko nhận nguồn điện', 'Đã cắm điện nhưng bật quạt không chạy', 4, '2023-05-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thietbi`
--

CREATE TABLE `thietbi` (
  `id` int(11) NOT NULL,
  `ten` varchar(500) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dactinhkithuat` text NOT NULL,
  `hinhanh` varchar(500) NOT NULL,
  `giatri` int(11) NOT NULL,
  `tinhtrang` varchar(500) NOT NULL,
  `loaithietbi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thietbi`
--

INSERT INTO `thietbi` (`id`, `ten`, `soluong`, `dactinhkithuat`, `hinhanh`, `giatri`, `tinhtrang`, `loaithietbi_id`) VALUES
(5, 'Máy tính', 10, 'Đặc tính kĩ thuật\r\n', 'download (15).jpg', 300000, 'Hoạt động tốt', 1),
(6, 'a', 8, 'a', '040H đen (4).png', 10000, 'a', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `tieude` varchar(2500) NOT NULL,
  `noidung` text NOT NULL,
  `ngaytao` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`id`, `tieude`, `noidung`, `ngaytao`) VALUES
(7, 'Thông báo tạm dừng cho mượn máy tính', 'Hiện nay nhà trường đang bảo trì các máy tính nên tạm dừng cho mượn, các bạn chú ý', '2023-05-21');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loaithietbi`
--
ALTER TABLE `loaithietbi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `muon`
--
ALTER TABLE `muon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `suachua`
--
ALTER TABLE `suachua`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `suco`
--
ALTER TABLE `suco`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `loaithietbi`
--
ALTER TABLE `loaithietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `muon`
--
ALTER TABLE `muon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `suachua`
--
ALTER TABLE `suachua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `suco`
--
ALTER TABLE `suco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
