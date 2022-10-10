-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3360
-- Thời gian đã tạo: Th10 10, 2022 lúc 04:18 PM
-- Phiên bản máy phục vụ: 10.8.3-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vn_mart`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `thongkebanchay` ()  BEGIN
    select sp.SP_Ma, sp.Ten, 
    sum(ctdh.SoLuong) as TongBan, sum(ctdh.SoLuong * sp.DonGia * (100 - sp.GiamGia) / 100) as TongTien
    from chitiet_dh ctdh, sanpham sp
    where ctdh.SP_Ma = sp.SP_Ma
    group by sp.SP_Ma
    order by TongTien DESC
    LIMIT 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `thongkedonhang` ()  BEGIN
	select dh.Email, count(dh.DH_Ma) as sodon
	from donhang dh
	group by Email
	order by sodon DESC
    limit 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `xoakh` (IN `email` CHAR(255))  BEGIN
    if email != '' then
        delete ctdh from chitiet_dh ctdh
        where ctdh.DH_Ma IN (
            select dh.DH_Ma 
            from donhang dh
            where dh.Email LIKE email
        );
        delete dh2 from donhang dh2 where dh2.Email LIKE email;
        delete kh from khachhang kh where kh.Email LIKE email;
    end if;
END$$

--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `tongdh` () RETURNS INT(11) BEGIN
	DECLARE countdh INT(11) DEFAULT 0;
	select count(dh.DH_Ma) into countdh from donhang dh; 
	RETURN countdh;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tongHetHang` () RETURNS INT(11) BEGIN
	DECLARE counthethang INT DEFAULT 0;
	select count(sp.SP_Ma) into counthethang from sanpham sp where sp.SoLuong < 10; 
	return counthethang;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tongkh` () RETURNS INT(11) BEGIN 
	DECLARE countkh INT DEFAULT 0;
	select count(kh.email) into countkh from khachhang kh;
	RETURN countkh;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tongmuahang` (`e` CHAR(255)) RETURNS INT(11) BEGIN
DECLARE sum int(11) DEFAULT 0;
select SUM(kq.thanhtien) INTO sum
 from (
	 select listspMa.Email, listspMa.SoLuong * sp.DonGia as thanhtien
		from sanpham sp, (
			select ctdh.SP_Ma, ctdh.SoLuong as SoLuong, dh_ma.Email
			from chitiet_dh ctdh
			, (
			select kh.Email, dh.DH_Ma
				from khachhang kh, donhang dh
				where
					kh.Email = e
					AND
					kh.Email = dh.Email
			) dh_ma
			where
				ctdh.DH_Ma = dh_ma.DH_Ma
		) listspMa
		where
			listspMa.SP_Ma = sp.SP_Ma
 ) kq
group by Email;
return sum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tongsp` () RETURNS INT(11) BEGIN 
	DECLARE countsp INT DEFAULT 0;
	select count(sp.SP_Ma) into countsp from sanpham sp; 
	return countsp;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_dh`
--

CREATE TABLE `chitiet_dh` (
  `DH_Ma` int(11) NOT NULL,
  `SP_Ma` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitiet_dh`
--

INSERT INTO `chitiet_dh` (`DH_Ma`, `SP_Ma`, `SoLuong`) VALUES
(12, 54, 1),
(12, 55, 1),
(13, 51, 1),
(13, 52, 1),
(14, 45, 1),
(14, 47, 1),
(14, 103, 1),
(15, 47, 1),
(15, 102, 1),
(15, 118, 1),
(15, 119, 1),
(16, 47, 1),
(16, 57, 1),
(16, 59, 1),
(17, 49, 1),
(17, 50, 1),
(18, 102, 1),
(18, 104, 1),
(18, 118, 1),
(19, 46, 1),
(19, 65, 1),
(19, 77, 1),
(20, 44, 1),
(20, 102, 1),
(20, 118, 1),
(20, 119, 1),
(21, 52, 1),
(21, 54, 1),
(21, 55, 1),
(22, 47, 1),
(22, 119, 1),
(23, 80, 1),
(23, 81, 1),
(23, 89, 1),
(23, 94, 1),
(23, 107, 1),
(24, 95, 1),
(24, 96, 1),
(24, 108, 1),
(25, 40, 1),
(26, 47, 1),
(26, 102, 1),
(27, 40, 3),
(27, 44, 1),
(27, 45, 4),
(27, 47, 1),
(27, 50, 4),
(27, 51, 2),
(27, 52, 2),
(27, 53, 3),
(27, 54, 2),
(27, 55, 2),
(27, 58, 3),
(27, 102, 1),
(27, 118, 1),
(27, 119, 1),
(27, 121, 1),
(28, 40, 3),
(28, 44, 1),
(28, 45, 4),
(28, 47, 1),
(28, 50, 4),
(28, 51, 2),
(28, 52, 2),
(28, 53, 3),
(28, 54, 2),
(28, 55, 2),
(28, 58, 3),
(28, 102, 1),
(28, 118, 1),
(28, 119, 1),
(28, 121, 1),
(29, 40, 3),
(29, 44, 1),
(29, 45, 4),
(29, 47, 1),
(29, 50, 4),
(29, 51, 2),
(29, 52, 2),
(29, 53, 3),
(29, 54, 2),
(29, 55, 2),
(29, 58, 3),
(29, 102, 1),
(29, 118, 1),
(29, 119, 1),
(29, 121, 1),
(30, 40, 3),
(30, 47, 3),
(31, 40, 3),
(32, 40, 3),
(33, 44, 3),
(33, 47, 3),
(34, 47, 7),
(34, 102, 7),
(34, 118, 7),
(35, 47, 7),
(35, 102, 7),
(35, 118, 7),
(36, 47, 7),
(36, 102, 7),
(36, 118, 7),
(37, 47, 7),
(37, 102, 7),
(37, 118, 7),
(38, 47, 7),
(38, 102, 7),
(38, 118, 7),
(39, 56, 5),
(39, 58, 1),
(39, 59, 1),
(40, 40, 7),
(40, 44, 6),
(40, 47, 5),
(41, 87, 1),
(41, 88, 1),
(41, 89, 1),
(41, 90, 1),
(41, 91, 1),
(42, 40, 3),
(42, 44, 9),
(42, 47, 5),
(42, 59, 4),
(42, 60, 1),
(42, 119, 10),
(42, 121, 3),
(43, 40, 97),
(43, 102, 97),
(44, 40, 1),
(44, 44, 1),
(44, 102, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `DH_Ma` int(11) NOT NULL,
  `Email` char(255) NOT NULL,
  `NgayNhanHang` date DEFAULT NULL,
  `DiaChiNhan` varchar(255) DEFAULT NULL,
  `TTDH_Ma` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`DH_Ma`, `Email`, `NgayNhanHang`, `DiaChiNhan`, `TTDH_Ma`, `created_at`, `updated_at`) VALUES
(12, 'trietb1910470@student.ctu.edu.vn', NULL, NULL, 1, '2022-04-29 21:20:17', NULL),
(13, 'vinh466@gmail.com', NULL, NULL, 1, '2022-05-06 18:51:24', NULL),
(14, 'vinh466@gmail.com', NULL, NULL, 1, '2022-05-08 05:21:09', NULL),
(15, 'vinhb1910483@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-08 06:07:00', NULL),
(16, 'vinhb1910483@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-08 06:07:13', NULL),
(17, 'vinhb1910483@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-08 06:07:20', NULL),
(18, 'nvinhcorp@gmail.com', NULL, NULL, 1, '2022-05-08 06:07:39', NULL),
(19, 'nvinhcorp@gmail.com', NULL, NULL, 1, '2022-05-08 06:07:47', NULL),
(20, 'nvinhcorp@gmail.com', NULL, NULL, 1, '2022-05-08 06:08:06', NULL),
(21, 'nvinhcorp@gmail.com', NULL, NULL, 1, '2022-05-08 06:08:13', NULL),
(22, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-10 15:57:39', NULL),
(23, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-10 15:57:52', NULL),
(24, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-10 15:58:04', NULL),
(25, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-10 16:08:15', NULL),
(26, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 14:16:43', NULL),
(27, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:02:27', NULL),
(28, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:02:38', NULL),
(29, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:02:40', NULL),
(30, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:02:53', NULL),
(31, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:03:06', NULL),
(32, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:03:09', NULL),
(33, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 15:03:29', NULL),
(34, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:27:26', NULL),
(35, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:30:13', NULL),
(36, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:30:20', NULL),
(37, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:32:11', NULL),
(38, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:32:14', NULL),
(39, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:35:29', NULL),
(40, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:35:56', NULL),
(41, 'vub1910486@student.ctu.edu.vn', NULL, NULL, 1, '2022-05-11 16:37:43', NULL),
(42, 'vinh466@gmail.com', NULL, NULL, 1, '2022-05-11 16:40:04', NULL),
(43, 'vinh466@gmail.com', NULL, NULL, 1, '2022-05-11 16:57:46', NULL),
(44, 'vinh466@gmail.com', NULL, NULL, 1, '2022-10-10 13:53:22', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `Email` char(255) NOT NULL,
  `MatKhau` char(20) NOT NULL,
  `Ho` char(20) NOT NULL,
  `Ten` char(20) NOT NULL,
  `SoDienThoai` text DEFAULT NULL,
  `DiaChi` int(11) DEFAULT NULL,
  `AnhCaNhan` varchar(2000) DEFAULT NULL,
  `GoogleId` char(255) NOT NULL,
  `FacebookId` char(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`Email`, `MatKhau`, `Ho`, `Ten`, `SoDienThoai`, `DiaChi`, `AnhCaNhan`, `GoogleId`, `FacebookId`, `created_at`, `updated_at`) VALUES
('nvinhcorp@gmail.com', '', 'Nguyễn', 'Vinh', '', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GiauYffljmS5rhfVYPzXsg1S27yf48UvJV3V5r5=s96-c', '110888706781121983889', '', '2022-04-25 08:24:34', NULL),
('trietb1910470@student.ctu.edu.vn', '', 'B1910470', 'Le Minh Triet', '', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GgklKL46W3cl6EpGf-8pY419sjNL0VGLJ6Va94p=s96-c', '105915385796216515815', '', '2022-04-29 20:59:07', NULL),
('vinh466@gmail.com', '11111', 'Vinh', 'Nguyến', '0334680701', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GiEQ5ZfvLNWU_AfvqoYKfVUpyCcpb89KyPmgHVdKw=s96-c', '111021367217317193366', '', '2022-04-23 03:23:51', '2022-05-08 00:21:05'),
('vinhb1910483@student.ctu.edu.vn', '', 'B1910483', 'Nguyen Thanh Vinh', '', NULL, 'https://lh3.googleusercontent.com/a-/AOh14Ggmxdf7OZmWju6GZiMKcIIVNLXVGlLAxMl_6dVz=s96-c', '106688159007960904025', '', '2022-04-25 05:38:40', NULL),
('vub1910486@student.ctu.edu.vn', '11111', 'Vu', 'Nguyen', '', 0, 'https://lh3.googleusercontent.com/a-/AOh14GjqB0dv5CMwR1dYdd6kx6vMC8Mr9nA-MVJdrK2O=s360-p-rw-no', '', '', '2022-05-10 13:31:26', '2022-05-10 08:34:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `DM_Ma` int(11) NOT NULL,
  `Ten` char(50) NOT NULL,
  `MoTa` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loai_sp`
--

INSERT INTO `loai_sp` (`DM_Ma`, `Ten`, `MoTa`, `created_at`, `updated_at`) VALUES
(1, 'Sản Phẩm Khuyến Mãi', NULL, '2022-04-12 14:57:04', NULL),
(2, 'Mì, Miến, Cháo, Phở', NULL, '2022-04-12 14:57:04', NULL),
(3, 'Bột, Đồ Khô', NULL, '2022-04-12 14:57:04', NULL),
(4, 'Dầu Ăn, Nước Chấm, Gia Vị', NULL, '2022-04-12 14:57:04', NULL),
(5, 'Sữa Các Loại', NULL, '2022-04-12 14:57:04', NULL),
(6, 'Đồ Uống Các Loại', NULL, '2022-04-27 14:10:40', NULL),
(7, 'Bánh Kẹo Các Loại', NULL, '2022-04-27 14:10:40', NULL),
(8, 'Hóa Phẩm', NULL, '2022-04-27 14:10:40', NULL),
(9999, 'Khác', NULL, '2022-05-10 12:41:37', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanloai_sp`
--

CREATE TABLE `phanloai_sp` (
  `SP_Ma` int(11) NOT NULL,
  `DM_Ma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phanloai_sp`
--

INSERT INTO `phanloai_sp` (`SP_Ma`, `DM_Ma`) VALUES
(40, 1),
(40, 3),
(41, 7),
(42, 7),
(43, 7),
(44, 1),
(44, 3),
(45, 3),
(46, 3),
(47, 1),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(71, 4),
(72, 4),
(73, 4),
(74, 4),
(75, 5),
(76, 5),
(77, 5),
(78, 5),
(79, 5),
(80, 6),
(81, 6),
(82, 6),
(83, 6),
(84, 6),
(85, 6),
(86, 6),
(87, 8),
(88, 8),
(89, 8),
(90, 8),
(91, 8),
(92, 8),
(93, 8),
(94, 8),
(95, 8),
(96, 8),
(97, 8),
(98, 8),
(99, 7),
(100, 7),
(101, 7),
(102, 1),
(102, 7),
(103, 3),
(104, 3),
(105, 3),
(106, 3),
(107, 7),
(108, 7),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 1),
(118, 6),
(119, 1),
(119, 6),
(120, 6),
(121, 1),
(121, 2),
(121, 5),
(121, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantrivien`
--

CREATE TABLE `quantrivien` (
  `TaiKhoan` char(50) NOT NULL,
  `MatKhau` char(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quantrivien`
--

INSERT INTO `quantrivien` (`TaiKhoan`, `MatKhau`, `updated_at`, `created_at`) VALUES
('admin', '1', '2022-04-12 14:38:39', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `SP_Ma` int(11) NOT NULL,
  `Ten` char(50) DEFAULT NULL,
  `MoTa` varchar(500) DEFAULT NULL,
  `Anh` char(100) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` int(11) DEFAULT NULL,
  `GiamGia` int(11) DEFAULT NULL,
  `TrangThai` int(11) DEFAULT NULL,
  `DonVi` char(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`SP_Ma`, `Ten`, `MoTa`, `Anh`, `SoLuong`, `DonGia`, `GiamGia`, `TrangThai`, `DonVi`, `created_at`, `updated_at`) VALUES
(40, 'Kẹo gum không đường Lotte Xylitol hương Lime Min', 'Kẹo gum không đường hương bạc hà mang đến cho bạn hơi thở thơm mát. Kẹo gum không đường Lotte Xylitol hương Lime Mint vỉ 11.6g bảo vệ răng của bạn, giúp bạn lấy thức ăn trong kẽ răng, Kẹo Singum Lotte Xylitol cho tinh thần thoải mái và bảo vệ răng miệng', 'keo4.jpg', 3000, 5500, 20, 1, 'Gói', '2022-04-30 06:04:11', '2022-05-11 08:07:59'),
(41, 'Socola viên Milo Nuggets gói 25g', 'Kẹo socola ngọt thanh, không quá đắng, kích thích vị giác nhờ đậm vị socola. Socola viên Milo Nuggets gói 25g có chia từng viên dễ bảo quảng và ăn dễ dàng. Socola Milo được nhập khẩu từ Malaysia chất lượng, an toàn và hấp dẫn.', 'keo2.jpg', 9, 14000, 0, 1, '', '2022-04-30 06:04:11', '2022-05-10 08:28:09'),
(42, 'Kẹo dẻo hình trái cây Haribo Goldbears gói 30g', 'Vị chua ngọt hài hoà của hoa quả được chiết xuất từ nước ép trái cây cô đặc (dâu, táo, phúc bồn tử,...) với hình dáng ngộ nghĩnh mang lại cảm giác thích thú khi thưởng thức. Kẹo dẻo trái cây Haribo Goldbears gói 30g tiện lợi, hấp dẫn và vui miệng. Kẹo Haribo được sản xuất tại Thổ Nhĩ Kỳ chất lượng', 'keo1.jpg', 7500, 9600, 0, 1, NULL, '2022-04-30 06:04:11', NULL),
(43, 'Kẹo UTOO fruity gói 45g', 'Kẹo UTOO với hương vị trái cây thơm ngon, đầy mê ly khiến bạn không thể cưỡng lại. Kẹo UTOO fruity gói 45g với gói nhỏ tiện lợi mang theo bên người, cùng chia sẻ cho gia đình và bạn bè thưởng thức. Kẹo giúp chúng ta vui hơn, cung cấp năng lượng hoạt động hiệu quả', 'keo.jpg', 3000, 13600, 0, 1, NULL, '2022-04-30 06:04:11', NULL),
(44, 'Bột năng Tài Ký gói 1kg', 'Tiện lợi, bột được tẩm gia vị vừa phải, sánh mịn, thơm ngon. Mua Bột năng Tài Ký gói 1kg có thể làm nguyên liệu cho nhiều loại bánh như bánh bột lọc, hoặc làm nguyên liệu sệt các món chè, súp. Bột năng Tài Ký chất lượng, an toàn', 'botnang.jpg', 8000, 35000, 14, 1, NULL, '2022-04-30 05:58:47', NULL),
(45, 'Bột chiên giòn đỏ Tài Ký gói 150g', 'Sản phẩm được làm từ những loại bột tự nhiên an toàn cho sức khỏe như bột mì, bột gạo, bột năng, bột đậu xanh, bột gạo, tinh bột bắp, tinh bột khoai mì,… đảm bảo sức khỏe cho gia đình.Bột chiên giòn đỏ Tài Ký gói 150g để tự tay làm các món như mực chiên, tôm chiên...', 'botchiengion.jpg', 7500, 10000, 0, 1, NULL, '2022-04-30 05:58:47', NULL),
(46, 'Bột bắp Meizan gói 150g', 'Bột bắp Meizan chất lượng, được dùng phổ biến trong nhiều loại bánh như bánh bông lan, cookie,.... Bột bắp Meizan gói 150g gói nhỏ tiện lợi, sử dụng cho cá nhân, nhỏ gọn mang theo. Bột bắp còn giúp cho cá món phủ bột chiên thêm thơm giòn hơn nữa.', 'botbap.jpg', 7000, 8400, 29, 1, NULL, '2022-04-30 05:58:47', NULL),
(47, 'Gạo thơm đặc sản Neptune ST25 túi 5kg', 'Gạo là lương thực thực phẩm thiết yếu có trong mọi căn bếp. Gạo thơm đặc sản Neptune ST25 túi 5kg với giống gạo ST25 ngon nhất thế giới vào năm 2019, hạt cơm ngọt, dẻo nhiều và ít nở, giúp bạn ăn ngon miệng. Gạo Neptune chất lượng, thơm ngon, giúp bạn ăn được nhiều cơm.', 'gao1.jpg', 5000, 210000, 23, 1, NULL, '2022-04-30 05:53:24', NULL),
(48, 'Gạo Hoa Lúa vàng túi 2kg', 'Được thu hoạch từ giống lúa Jasmine thơm ngon được canh tác trên các cánh đồng đạt chuẩn GLOBAL G.A.P. đến từ thương hiệu Hoa Lúa. Gạo hạt lớn, thơm nhẹ, dẻo mềm và nở ít, không tẩy trắng, không chứa chất bảo quản, an toàn cho sức khoẻ người dùng.', 'gao.jpg', 3000, 62000, 0, 1, NULL, '2022-04-30 05:53:24', NULL),
(49, 'Lạp xưởng Mai Quế Lộ Vissan gói 200g', 'Lạp xưởng được chế biến an toàn, sạch sẽ mang đến sản phẩm thơm ngon, màu sắc đẹp mắt. Lạp xưởng Mai Quế Lộ Vissan gói 200g có thể chiên, nướng, hấp, ăn trực tiếp hoặc ăn kèm cơm, xôi, củ kiệu,...Lạp xưởng Vissan chất lượng, thơm ngon, hấp dẫn và tiện lợi cho người dùng.', 'lapxuong.jpg', 500, 46000, 0, 1, NULL, '2022-04-30 05:49:53', NULL),
(50, 'Lạp xưởng bò Vissan gói 200g', 'Lạp xưởng được chế biến an toàn, sạch sẽ mang đến sản phẩm thơm ngon, màu sắc đẹp mắt. Lạp xưởng bò Vissan 200g từ thịt bò, có thể chiên, nướng, hấp, ăn trực tiếp hoặc ăn kèm cơm, xôi, củ kiệu,...Lạp xưởng Vissan chất lượng, thơm ngon, hấp dẫn và tiện lợi cho người dùng.', 'lapxuong1.jpg', 300, 65000, 0, 1, NULL, '2022-04-30 05:49:53', NULL),
(51, 'Thùng 30 gói mì Hảo Hảo tôm chua cay 75g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp tôm chua cay Hảo Hảo, đậm đà thấm đẫm từng sợi sóng sánh cùng hương thơm quyến rũ ngất ngây. Mì Hảo Hảo tôm chua cay gói 75g là lựa chọn hấp dẫn không thể bỏ qua đặc biệt là những ngày bận rộn cần bổ sung năng lượng nhanh chóng đơn giản mà vẫn đủ chất.', 'haohao.jpg', 100, 106000, 0, 1, NULL, '2022-04-12 15:33:55', '2022-04-12 18:12:59'),
(52, 'Thùng 30 gói mì 3 Miền tôm chua cay 65g', 'Sở hữu nét đậm đà chuẩn hương vị truyền thống. Mì 3 Miền tôm chua cay gói 65g có được vị chua cay từ quá trình tìm tòi cũng như chắt lọc các nét đặc trưng nhất của các món chua cay dọc 3 miền tổ quốc. Để rồi thành phẩm mang đến cho người tiêu dùng hương vị tinh tế nhất và tuyệt hảo nhất', '3mien.jpg', 100, 87500, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(53, 'Thùng 24 ly mì Modern lẩu Thái tôm 65g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp Vifon vị lẩu Thái tôm đậm đà thấm đều trong từng sợi cùng hương thơm lừng quyến rũ ngất ngây. 24 ly mì Modern lẩu Thái tôm 65g tiện lợi thơm ngon là lựa ngọn hấp dẫn cho những bữa ăn nhanh gọn, đơn giản và đầy đủ dưỡng chất', 'myly.jpg', 50, 156000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(54, 'Thùng 30 gói mì khoai tây Omachi Special bò hầm xố', 'Sợi mì từ trứng và khoai tây vàng dai ngon hòa quyện trong nước súp Omachi bò hầm xốt vang đậm đà cùng gói thịt thật 100% tạo ra siêu phẩm mì với sự kết hợp hương vị hài hòa, độc đáo. 30 gói mì khoai tây Omachi Special bò hầm xốt vang 92g thơm ngon hấp dẫn không thể chối từ', 'oamchi.jpg', 40, 227000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(55, 'Thùng 24 ly mì khoai tây Omachi sườn hầm ngũ quả 1', 'Sợi mì từ trứng và khoai tây vàng dai ngon hòa quyện trong nước súp Omachi vị sườn hầm ngũ quả đậm đà cùng cây thịt thật chất lượng tạo ra siêu phẩm mì với sự kết hợp hương vị hài hòa, độc đáo. Thùng 24 ly mì khoai tây Omachi sườn hầm ngũ quả ly 113g tiện lợi, thơm ngon hấp dẫn không thể chối từ', 'omachisuon.jpg', 100, 378000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(56, 'Thùng 30 gói mì Kokomi hải sản Kayakay gói 90g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp mì nấu hải sản Kokomi đậm đà cay cay cực đã cùng hương thơm lừng ngất ngây tạo ra siêu phẩm mì với sự kết hợp hương vị hài hòa, độc đáo. 30 gói mì Kokomi hải sản Kayakay 90g thơm ngon hấp dẫn không thể chối từ', 'kokomi.jpg', 100, 175000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(57, 'Thùng 30 gói mì Kokomi 90 tôm chua cay 90g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp Kokomi vị tôm chua cay đậm đà thấm đẫm từng sợi cùng hương thơm lừng quyến rũ. 30 gói mì Kokomi Kokomi 90 tôm chua cay 90g tiện lợi, nhanh chóng, hấp dẫn cho bữa ăn nhanh gọn đơn giản nhưng vẫn đầy đủ dưỡng chất.', 'kokomi90.jpg', 70, 106000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(58, 'Thùng 24 ly mì khoai tây Cung Đình cua bể rau răm', 'Sợi mì từ khoai tây và trứng vàng dai ngon hòa quyện trong nước súp cua bể rau răm Cung Đình đậm đà cùng hương thơm lừng quyến rũ. 24 ly mì khoai tây Cung Đình cua bể rau răm 65g nhanh chóng, là lựa chọn hấp dẫn cho bữa ăn nhanh gọn đơn giản nhưng vẫn đầy đủ dưỡng chất', 'cungdinh.jpg', 60, 192000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(59, 'Thùng 30 gói hủ tiếu sườn heo Nhịp Sống 70g', 'Bữa ăn cực tiện lợi và thơm ngon. 30 gói hủ tiếu sườn heo Nhịp Sống 70g là sản phẩm hủ tiếu ăn liền của thương hiệu Nhịp sống với hương vị sườn heo đậm đà thấm đều trong từng sợi dai ngon cực đã cùng mùi hương hấp dẫn lôi cuốn không thể chối từ', 'hutieu.jpg', 30, 206000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(60, 'Thùng 30 gói hủ tiếu Nam Vang Cung Đình 78g', 'Bữa ăn cực tiện lợi và thơm ngon. 30 gói hủ tiếu Nam Vang Cung Đình 78g là sản phẩm hủ tiếu ăn liền của Cung Đình hương vị Nam Vang đặc trưng thấm đều trong từng sợi hủ tiếu dai ngon đậm đà cực đã cùng mùi hương hấp dẫn lôi cuốn không thể chối từ', 'namvang.jpg', 30, 206000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(61, 'Thùng 30 gói cháo yến Yến Việt vị thịt bằm 50g', 'Là dòng sản phẩm cháo yến ăn liền tiện lợi từ thương hiệu Yến Việt. 30 gói cháo yến Yến Việt vị thịt bằm 50g có chứa tổ yến tự nhiên cùng rau thịt tươi sấy thăng hoa mang hương vị thịt bằm tươi ngon và dinh dưỡng là lựa chọn hoàn hảo cho bữa ăn nhanh đơn giản những vẫn đủ chất', 'chaoyen.jpg', 30, 270000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(62, 'Thùng 50 gói cháo gà Gấu Đỏ 50g', 'Sản phẩm cháo ăn liền tiện lợi từ thương hiệu Gấu Đỏ. 50 gói cháo gà Gấu Đỏ 50g từ các nguyên liệu tự nhiên, không chất bảo quản an toàn cho sức khỏe, cháo có vị thịt gà thơm ngon cùng mùi hương hấp dẫn, đủ dinh dưỡng cho một bữa ăn mà lại cực nhanh và đơn giản\r\n', 'chaogau.jpg', 30, 160000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(63, 'Hạt nêm vị heo Aji-ngon gói 170g', 'Được làm từ nước dùng của xương và thịt heo cùng với một lượng cân đối các loại gia vị khác. Hạt nêm vị heo Aji-ngon 170g là đến từ loại hạt nêm mang lại hương vị thơm ngon tự nhiên cho món ăn của gia đình bạn. Hạt nêm Aji-ngon gói nhỏ phù hợp nhu cầu sử dụng gia đình và dễ mang đi.', 'hatnem.jpg', 40, 15000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(64, 'Hạt nêm thịt thăn, xương ống, tủy Knorr gói 170g', 'Sản phẩm được làm từ những nguyên liệu quen thuộc, gần gũi với sức khoẻ người tiêu dùng như chiết xuất thịt thăn, đường,... Sản phẩm không chỉ mang đến hương vị ngọt thanh, đậm đà cho mỗi món ăn từ chiên, xào, nấu canh,... mà gói nhỏ tiện lợi, sử dụng phù hợp nhu cầu gia đình. ', 'hatnem1.jpg', 30, 17000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(65, 'Hạt nêm nấm hương, hạt sen Aji-ngon gói 200g', 'Được sản xuất theo công nghệ hiện đại kết hợp với nguyên liệu từ nấm, hạt sen và các loại rau củ thiên nhiên của hạt nêm chay Aji-ngon. Hạt nêm nấm hương, hạt sen Aji-ngon gói 200g mang đến hương vị thơm ngon, tạo nên sự hấp dẫn đặc trưng cho bữa cơm gia đình với dòng hạt nêm ăn chay này.', 'hatnem2.jpg\r\n', 40, 20000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(66, 'Đường mía thượng hạng Biên Hòa gói 1kg', 'Sản phẩm ứng dụng công nghệ tiên tiến, chiết ép lượng đường từ những cây mía tốt nhất, không sử dụng hóa chất tẩy trắng. Đường mía thượng hạng Biên Hòa có vị ngọt dịu, thơm ngon, hấp dẫn, có màu trắng tự nhiên, dễ hòa tan, do đó có thể dùng chế biến nhiều món ăn, pha chế nhiều loại đồ uống khác.', 'duong.jpg', 30, 27000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(67, 'Đường ăn kiêng Tropicana Slim Diabetics hộp 100g (', 'Là sự kết hợp với bột bắp tự nhiên để mang lại hương vị ngọt ngào cho người sử dụng. Sản phẩm đường bắp ăn kiêng Tropicana Slim không calo hộp 100g phù hợp cho người ăn kiêng, bệnh nhân tiểu đường hoặc những người muốn duy trì một lối sống lành mạnh.', 'duong1.jpg', 40, 81000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(68, 'Đường mía Toàn Phát gói 1kg', 'Với chiết xuất từ mía tốt cho sức khỏe, sản phẩm có hạt đường nhỏ màu trắng tinh khiết, không chứa chất độc hại đảm bảo an toàn sức khỏe cho người sử dụng, giúp chế biến nhiều món ăn, thức uống thơm ngon, hấp dẫn. Gói 1kg giúp người dùng tiết kiệm hơn.', 'duong2.jpg', 30, 26000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(69, 'Nước chấm Nam Ngư Đệ Nhị chai 900ml', 'Nước mắm là gia vị không thể thiếu để giúp món ăn thêm đậm đà. Nước chấm Nam Ngư đệ nhị chai 900ml với thành phần cá cơm tươi ngon cùng với công thức pha chế đặc biệt, mang đến hương vị thơm ngon, đậm đà. Nước chấm Nam Ngư mang đến những bữa ăn trọn vẹn, đảm bảo an toàn cho gia đình.', 'nuocmam.jpg', 40, 21000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(70, 'Nước mắm cá cơm đặc sản Hưng Thịnh 40 độ đạm chai', 'Nước mắm Hưng Thịnh được sản xuất từ cá cơm nguyên chất với công nghệ ủ mắm hoàn toàn mới, sản xuất theo quy trình khép kín. Nước mắm Hưng Thịnh đặc sản 40 độ đạm chai 750ml mang đến hương vị đậm đà, đặc trưng của nước mắm cá cơm nguyên chất cùng độ đạm cao, mang đến những bữa ăn tuyệt vời. ', 'nuocmam1.jpg', 30, 76000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(71, 'Nước mắm cá cơm Thuận Phát 40 độ đạm chai 500ml', 'Nước mắm Thuận Phát được sản xuất theo phương pháp truyền thống kết hợp quy trình kiểm định khép kín, đảm bảo chất lượng, mùi vị thơm ngon của nước mắm nguyên chất. Nước mắm cá cơm Thuận Phát 40 độ đạm chai 500ml mang đến hương vị từ những nguyên liệu tươi ngon từ chính thổ nhưỡng của Việt Nam.', 'nuocmam2.jpg', 30, 52000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(72, 'Nước tương đậu nành Maggi chai 700ml', 'Với hương vị thanh ngon đặc trưng trong từng giọt nước tương sánh đậm, để lại dư vị tinh tế cho từng món ăn. Nước tương đậu nành Maggi chai 700ml đảm bảo dinh dưỡng cùng vị thanh ngon, dịu ngọt, tinh tến từ thương hiệu nước tương Maggi. ', 'nuoctuong.jpg', 70, 27000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(73, 'Nước tương đậm đặc Nam Dương chính hiệu Con Mèo Đe', 'Là loại nước tương quen thuộc của các bà nội trợ đến từ thương hiệu nước tương Nam Dương. Nước tương chính hiệu Con Mèo Đen Nam Dương 500ml vẫn lưu giữ nguyên vẹn vị ngọt thanh, thơm dịu của nước tương truyền thống, mang đến hương vị thơm ngon cho mọi món ăn.', 'nuoctuong1.jpg', 60, 16000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(74, 'Nước tương Nhị ca Tam Thái Tử chai 500ml', 'Với hương vị thơm ngon, vừa miệng theo hương vị truyền thống, phù hợp với khẩu vị người Việt Nam. Nước tương nhị ca Tam Thái Tử chai 500ml dùng để chấm nguyên chất rất ngon, hay pha thêm ớt, tỏi…dùng ướp thịt – cá – hải sản, nếm các món xào,... dùng cho cả món chay và món mặn.', 'nuoctuong2.jpg', 70, 8000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(75, 'Thùng 48 bịch sữa tiệt trùng có đường Dutch Lady C', 'Sữa Dutch Lady là nguồn bổ sung canxi và protein thiết yếu mỗi ngày cho bé, giúp bé khoẻ mạnh, cao lớn hơn. Sữa thêm đường, thơm ngon, uống không ngán. Thùng 48 bịch sữa tiệt trùng có đường Dutch Lady Canxi & Protein 220ml sử dụng lâu dài', 'sua.jpg', 30, 300000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(76, 'Thùng 48 hộp sữa tươi tiệt trùng có đường TH true', 'Đảm bảo không sử dụng thêm hương liệu, vị ngon 100% đến từ sữa tươi từ trang trại của TH True Milk nên được các bà mẹ ưu tiên lựa chọn hàng đầu. Thùng 48 hộp sữa tươi tiệt trùng có đường TH true MILK 180ml đóng thùng tiện lợi, tiết kiệm, có thể dùng lâu dài, thơm ngon hấp dẫn', 'sua1.jpg', 30, 396000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(77, 'Thùng 48 bịch sữa dinh dưỡng có đường Vinamilk A&D', 'Được chế biến từ nguồn sữa tươi 100% chứa nhiều dưỡng chất như vitamin A, D3, canxi,... tốt cho xương và hệ miễn dịch. Sữa tươi Vinamilk là thương hiệu được tin dùng hàng đầu với chất lượng tuyệt vời. Thùng 48 bịch sữa dinh dưỡng có đường Vinamilk A&D3 220ml đóng thùng tiết kiệm, dùng lâu dài', 'sua2.jpg', 40, 31000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(78, 'Thùng 48 hộp thức uống lúa mạch ít đường Mi', 'Sản phẩm sữa uống lúa mạch thơm ngon, giàu canxi và protein giúp cho cơ thể luôn phát triển toàn diện, sữa lúa mạch Milo được các bé cực yêu thích. Thùng 48 hộp thức uống lúa mạch ít đường Milo Active Go 180ml thơm ngon, đầy dinh dưỡng, đóng thùng tiết kiệm', 'sua3.jpg', 40, 325000, 0, 1, NULL, '2022-04-12 15:33:55', '2022-04-30 03:53:48'),
(79, 'Thùng 48 hộp thức uống dinh dưỡng socola lúa mạch', 'Sữa lúa mạch LiF Kun với hương vị thơm ngon, dễ uống, bổ sung thêm dinh dưỡng và năng lượng, hỗ trợ tăng chiều cao hiệu quả với canxi, vitamin D3, vitamin K2. Thùng 48 hộp thức uống dinh dưỡng socola lúa mạch LiF Kun 180ml đóng lốc tiện dùng, dễ bảo quản', 'sua4.jpg', 30, 318000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(80, '6 chai nước ngọt Coca Cola 600ml', 'Từ thương hiệu loại nước giải khát Coca Cola được nhiều người yêu thích với hương vị thơm ngon, sảng khoái. 6 chai nước ngọt Coca Cola 600ml với lượng gas lớn sẽ giúp bạn xua tan mọi cảm giác mệt mỏi, căng thẳng, đem lại cảm giác thoải mái sau khi hoạt động ngoài trời.', 'coca.jpg', 40, 58000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(81, 'Thùng 24 chai trà ô long Tea Plus không đường 455m', 'Từ lá Trà Ô long hảo hạng tạo nên hương vị thơm ngon, tươi mát đặc trưng của trà ô long. Đặc biệt, sản phẩm không chứa đường, phù hợp cho những người kiêng đường và muốn bảo vệ sức khỏe tốt hơn, cùng hoạt chất OTPP hạn chế hấp thu chất béo cho những ăn ngon miệng và nhẹ nhàng', 'tra1.jpg', 40, 150000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(82, 'Thùng 24 chai nước ngọt 7 Up vị chanh 390ml', 'Từ thương hiệu nước giải khát 7Up uy tín được ưa chuộng. Thùng 24 chai nước ngọt 7 Up hương chanh 390ml có vị ngọt vừa phải và hương vị gas the mát, giúp bạn xua tan nhanh chóng cơn khát, giảm cảm giác ngấy, kích thích vị giác giúp ăn ngon hơn, cung cấp năng lượng cho tinh thần tươi vui mỗi ngày', '7up.jpg', 40, 111000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(83, '6 lon nước ngọt Fanta vị soda kem 330ml', 'Sản phẩm nước ngọt có gas của thương hiệu Fanta nổi tiếng giúp giải khát sau khi hoạt động ngoài trời, giải tỏa căng thẳng, mệt mỏi khi học tập, làm việc. Nước ngọt Fanta hương trái cây lon 330ml thơm ngon vị trái cây độc đáo giúp xua tan cơn khát và kích thích vị giác cho cảm giác ngon miệng hơn', 'fanta.jpg', 100, 45000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(84, '24 chai nước ngọt Fanta hương cam 600ml', 'Là sản phẩm nước ngọt có gas của thương hiệu Fanta nổi tiếng giúp giải khát sau khi hoạt động ngoài trời, giải tỏa căng thẳng, mệt mỏi khi học tập, làm việc. 24 chai nước ngọt Fanta hương cam 600ml thơm ngon kích thích vị giác, chứa nhiều vitamin C sẽ cung cấp năng lượng cho cơ thể khỏe mạnh', 'fanta1.jpg', 40, 218000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(85, 'Thùng 24 lon nước ngọt Pepsi không calo 320ml', 'Là loại nước ngọt được nhiều người yêu thích đến từ thương hiệu nổi tiếng thế giới Pepsi với hương vị thơm ngon, sảng khoái. Nước ngọt Pepsi không calo 24 lon 320ml với lượng gas lớn sẽ giúp bạn xua tan mọi cảm giác mệt mỏi, căng thẳng, sản phẩm không calo lành mạnh, tốt cho sức khỏe', 'pepsi.jpg', 40, 220000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(86, 'Thùng 24 lon nước ngọt Pepsi không calo vị chanh 3', 'Sự kết hợp hài hòa của vị chanh thanh mát, giải nhiệt và mang lại cảm giác sảng khoái dài lâu. Nước ngọt Pepsi không calo vị chanh 24 lon 330ml cực kỳ thích hợp cho những người thích uống nước ngọt nhưng vẫn muốn giữ lối sống ăn thanh đạm, ít đường. Sản phẩm chất lượng từ nhà Pepsi', 'pepsi1.jpg', 30, 220000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(87, 'Nước giặt OMO Matic bền đẹp cửa trước lựu và tre t', 'Nước giặt với nhiều công nghệ giặt tẩy nên người sử dụng không cần ngâm quần áo lâu, nước giặt OMO các loại vết bẩn khô cứng sẽ được đánh bật chỉ trong 1 lần giặt nhanh chóng. Nước giặt OMO Matic bền đẹp cửa trước lựu và tre 1.9 lít giúp quần áo luôn bền đẹp như mới, hương thơm dễ chịu', 'omo.jpg', 100, 99000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(88, 'Bột giặt OMO hệ bọt thông minh 3kg', 'xoáy bay các vết bẩn cứng đầu sau 1 lần giặt cho quần áo trắng sạch tinh tươm, hương thơm tươi mới từ hạt lưu hương. Bột giặt OMO là thương hiệu bột giặt luôn được các chị em tin dùng hàng đầu vì an toàn cho da. Bột giặt OMO hệ bọt thông minh 3kg túi 3kg tiết kiệm, tiện dùng', 'omo1.jpg', 40, 110000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(89, 'Bột giặt OMO Comfort tinh dầu thơm nồng nàn 2.7kg', 'Bột giặt có khả năng xoáy bay vết bẩn cứng đầu chỉ sau 1 lần giặt cho quần áo trắng sạch tinh tươm. Bột giặt OMO kết hợp comfort tinh dầu thơm nồng nàn với chiết xuất từ hoa nhài và gỗ đàn hương lưu lại hương thơm bền lâu. Bột giặt OMO Comfort tinh dầu thơm nồng nàn 2.7kg - sự lựa chọn của gia đình.', 'omo2.jpg', 60, 110000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(90, 'Bột giặt nhiệt Aba sạch tinh tươm 6kg', 'Là dòng bột giặt nhiệt, với công thức Thermoactiva ưu việt, cô lập, giặt sạch mọi vết bẩn cứng đầu nhất trên quần áo. Bột giặt Aba chống bám tối ưu với thành phần dẫn chất cellulose giữ màu quần áo như mới. Bột giặt nhiệt Aba sạch tinh tươm 6kg gói lớn, tiết kiệm cho mọi nhà.', 'aba.jpg', 60, 210000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(91, 'Surf hương nước hoa duyên dáng 5.5kg', 'với công nghệ tinh chế từ Pháp thấm sâu vào từng sợi vải, ngát hương từ khi giặt đến khi mặc. Bột giặt Surf là thương hiệu bột giặt rất được ưa chuộng vì an toàn cho làn da khi sử dụng. Bột giặt Surf hương nước hoa duyên dáng 5.5kg túi lớn, tiết kiệm, dùng được lâu dài', 'surf.jpg', 60, 131000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(92, 'Nước rửa chén Sunlight matcha trà Nhật túi 2 lít', 'Giúp khử mùi tanh triệt để trên chén dĩa của bạn chỉ với 1 lần rửa, nước rửa chén Sunlight còn giúp diệt khuẩn hiệu quả, là thương hiệu nước rửa chén yêu thích của hàng triệu người nội trợ. Nước rửa chén Sunlight matcha trà Nhật túi 2 lít hương thơm dễ chịu, an toàn cho da tay', 'ruachen.jpg', 60, 52000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(93, 'Nước rửa chén Sunlight thiên nhiên muối khoáng và', 'Giúp khử mùi tanh triệt để trên chén dĩa của bạn chỉ với 1 lần rửa, nước rửa chén Sunlight còn giúp diệt khuẩn hiệu quả, là thương hiệu nước rửa chén yêu thích của hàng triệu người nội trợ. Nước rửa chén Sunlight thiên nhiên muối khoáng và lô hội túi 2 lít sạch nhanh dầu mỡ, an toàn cho da tay', 'ruachen1.jpg', 60, 52000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(94, 'Nước xả vải Comfort giữ màu và bền vải một lần xả', 'Là một thương hiệu nước xả vải rất được lòng các chị em nội trợ, nước xả Comfort giúp làm mềm vải hiệu quả, an toàn cho da và công thức xả đậm đặc tiết kiệm hơn rất nhiều. Nước xả vải Comfort hương nước hoa thiên nhiên bella túi 3.2 lít hương nước hoa thơm lừng giúp bạn thoải mái tự tin cả ngày', 'xa.jpg', 60, 206000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(95, 'Nước xả vải Downy Parfum Collection huyền bí túi 1', 'Với những thành phần từ thiên nhiên hoặc nguyên liệu thực vật, nước xả vải Downy mang lại sự tuyệt vời về hương thơm và sự mềm mại khi dùng, chỉ cần 1 lần xả là hương thơm bám chắc vào vải quần áo, thơm cả ngày. Nước xả vải Downy Parfum Collection huyền bí túi 1.4 lít hương thơm huyền bí dễ chịu', 'xa1.jpg', 60, 103000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(96, 'Gel tẩy bồn cầu và nhà tắm VIM than hoạt tính & hư', 'Các sản phẩm tẩy rửa nhà cửa của VIM được các chị em nội trợ cực kỳ ưa chuộng. Tẩy rửa bồn cầu nhà tắm VIM giúp diệt vi khuẩn hiệu quả, ngăn ngừa mảng bám, vết ố. Gel tẩy bồn cầu và nhà tắm VIM than hoạt tính & hương oải hương 880ml hương thơm dễ chịu cho nhà tắm', 'vim.jpg', 60, 38000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(97, 'Dầu gội đầu nam Clear men deep cleanse sạch sâu v', 'Dầu gội Clear thương hiệu Hà Lan, là dầu gội làm sạch gàu số 1 Việt Nam. Dầu gội sạch gàu Clear Men Deep Cleanse sạch sâu 631ml kết hợp carbon hoạt tính cùng tinh chất vỏ cam làm sạch sâu da đầu và tóc khỏi khói bụi, ô nhiễm, bã nhờn.', 'goi.jpg', 60, 123000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(98, 'Tắm gội Romano Classic 900g', 'Với sự kết hợp giữa những hương gỗ tự nhiên cùng công thức cải tiến trong sản phẩm tắm gội 2 trong 1 giúp làm sạch và nuôi dưỡng làn da mềm mịn, tắm gội Romano Classic 900g với dung tích lớn, là sản phẩm được nam giới tin dùng đến từ thương hiệu tắm gội Romano.', 'goi1.jpg', 60, 153000, 0, 1, NULL, '2022-04-12 15:33:56', NULL),
(99, 'Bánh mì tươi ổ sữa không nhân Kinh Đô gói 80g', 'Bánh mì tươi Kinh Đô mang đến những chiếc bánh mì tươi ngon được sản xuất trên công nghệ hiện đại, an toàn cho người dùng. Bánh mì tươi ổ sữa không nhân Kinh Đô 80g mang đến lớp bánh mềm mịn thơm vị sữa, mang đến nguồn năng lượng dồi dào cho ngày dài hoạt động.', 'banhmi.jpg', 2000, 9000, 0, 1, NULL, '2022-04-12 15:33:55', '2022-04-30 04:01:55'),
(100, 'Bánh mì chà bông phô mai Staff gói 60g', 'Bánh mì Staff là sản phẩm phù hợp cho các bữa ăn nhẹ, bữa ăn phụ, cung cấp nhiều dinh dưỡng. Bánh mì chà bông phô mai Staff gói 60g có công thức chế biến sốt bơ, ruốc thịt heo đặc biệt cùng với sốt phô mai được nghiên cứu độc quyền, tạo ra lớp nhân bơ ruốc thơm ngậy với bánh mì mềm thơm.', 'banhmi1.jpg', 1000, 5000, 0, 1, NULL, '2022-04-27 13:41:50', '2022-04-30 04:05:22'),
(101, 'Bánh mì sandwich cá hồi rong biển xốt mayonnaise c', 'Là sản phẩm bánh sandwich tươi quen thuộc đến từ thương hiệu bánh Otto, mang đến bữa ăn sáng vô cùng tiện lợi. Bánh mì sandwich cá hồi rong biển xốt mayonnaise cay Otto gói 76g là sự kết hợp giữa ruốc cá hồi, rong biển cùng với sốt mayonnaise, cung cấp năng lượng cho ngày dài hoạt động.', 'banhmi2.jpeg', 2000, 9300, 0, 1, NULL, '2022-04-27 13:47:14', '2022-04-30 04:48:05'),
(102, 'Bánh mì tươi nhân kem Otto gói 55g', 'Bánh mì tươi Otto mang đến những chiếc bánh mì tươi ngon được sản xuất trên công nghệ hiện đại, an toàn cho người dùng. Bánh mì tươi nhân kem socola Otto gói 55g với phần bánh mềm thơm và phần nhân socola béo ngọt vừa phải, mang đến nguồn năng lượng dồi dào cho ngày dài hoạt động.', 'banhmi3.jpg', 2000, 7600, 5, 1, NULL, '2022-04-27 13:49:08', '2022-04-30 05:41:42'),
(103, 'Xúc xích heo tiệt trùng C.P gói 100g', 'Xúc xích thơm ngon, đậm vị thịt heo, gia vị vừa phải ăn rất ngon miệng. Xúc xích heo tiệt trùng C.P gói 100g dinh dưỡng, có thể ăn với mì tôm hoặc những món ăn khác như xúc xích chiên rất ngon. C.P là thương hiệu xúc xích lớn tại Việt Nam được nhiều người tin dùng', 'xucxich.jpg', 5000, 12000, 0, 1, NULL, '2022-04-27 13:54:14', '2022-04-30 04:41:58'),
(104, 'Xúc xích bò tiệt trùng Gold C.P gói 100g', 'Xúc xích thơm ngon, đậm vị bò, gia vị vừa phải ăn rất ngon miệng. Xúc xích bò tiệt trùng C.P Gold gói 100g dinh dưỡng, có thể ăn với mì tôm hoặc những món ăn khác như xúc xích chiên rất ngon. C.P là thương hiệu xúc xích lớn tại Việt Nam được nhiều người tin dùng', 'xucxich1.jpg', 2000, 12000, 0, 1, NULL, '2022-04-27 13:58:56', '2022-04-30 05:02:43'),
(105, 'Mè đen sấy khô Việt San 150g', 'Mè đen Việt San 150g dùng để nấu xôi, chè và nhiều món ăn khác.Mè Việt San chất lượng, tiện lợi tốt cho sức khỏe, cung cấp nhiều dưỡng chất cho cơ thể, được nhiều người chọn mua. Hạt mè sạch được sấy khô nhưng vẫn đảm bảo hương vị thơm ngon.', 'meden.jpg', 1000, 16000, 0, 1, NULL, '2022-04-27 13:58:56', '2022-04-30 05:34:51'),
(106, 'Mít sấy Vinamit gói 250g', 'Mít sấy giòn giòn, thơm và giữ được độ ngọt tự nhiên của trái cây, ăn rất thích. Mít sấy Vinamit gói 250g vừa ăn vừa xem phim, đọc sách rất phù hợp hoặc thưởng trà. Trái cây sấy Vinamit chất lượng, vệ sinh và dinh dưỡng, là món ăn tiện lợi và thơm ngon', 'mitsay.jpg', 1000, 91500, 0, 1, NULL, '2022-04-27 13:58:56', '2022-04-30 05:35:30'),
(107, 'Bánh hạt Gouté hộp 316.8g', 'Bánh quy dành cho chế độ ăn uống healthy của Gouté chất lượng, được nhiều người tin dùng. Từ bánh quy mè truyền thống, bánh Gouté hạt dinh dưỡng đã bổ sung thêm 5 loại hạt: Yến mạch, mè trắng, mè đen, diêm mạch đỏ, hạt chia nhằm mang lại giá trị dinh dưỡng cao và tốt cho sức khỏe.', 'banhquy.jpg', 1000, 52000, 0, 1, NULL, '2022-04-27 14:06:31', '2022-04-30 05:37:10'),
(108, 'Bánh quy sữa Cosy Marie hộp 336g', 'Bánh quy giòn rụm, thơm ngon và chứa nhiều dưỡng chất cho cơ thể. Bánh quy sữa Cosy Marie hộp 336g tiện lợi, kích thích vị giác với sữa béo tạo nên sự ngon miệng khi ăn. Bánh quy Cosy là thương hiệu Việt lớn, chuyên sản xuất bánh kẹo chất lượng cao, an tâm cho người dùng', 'banhquy1.jpg', 300, 44800, 0, 1, NULL, '2022-04-27 14:06:31', '2022-04-30 05:38:07'),
(109, 'Thùng 24 ly mì trộn Sedaap vị mì xào 85g', 'Sợi mì vàng dai ngon hòa quyện trong nước sốt mì xào Sedaap cực đã cực đậm đà thấm đều trong từng sợi mì sóng sánh cùng hương thơm quyến rũ. 24 ly mì trộn Sedaap vị mì xào 85g dạng thùng giá tốt tiết kiệm, là lựa chọn cực hấn dẫn không thể bỏ qua cho những tín đồ mì Hàn Quốc', 'mitron1.jpg', 50, 356000, 0, 1, NULL, '2022-04-27 14:06:31', '2022-04-30 05:22:20'),
(110, 'Thùng 20 gói mì trộn tương đen Cay Koreno gói 78g', 'Sợi mì vàng dai ngon hòa quyện trong nước sốt mì trộn tương đen Koreno đậm đà thấm đều trong từng sợi cùng hương thơm lừng, cay nồng quyến rũ ngất ngây. Thùng 20 gói mì trộn tương đen Cay Koreno gói 78g tiện lợi, thơm ngon cực đã là một lựa ngọn hấp dẫn cho bữa ăn nhanh gọn, đơn giản và đủ chất.', 'mitron.jpg', 40, 155000, 0, 1, NULL, '2022-04-27 14:06:31', '2022-04-30 05:22:10'),
(111, 'Thùng 24 ly mì khoai tây Omachi sườn hầm ngũ quả 1', 'Sợi mì từ trứng và khoai tây vàng dai ngon hòa quyện trong nước súp Omachi vị sườn hầm ngũ quả đậm đà cùng cây thịt thật chất lượng tạo ra siêu phẩm mì với sự kết hợp hương vị hài hòa, độc đáo. Thùng 24 ly mì khoai tây Omachi sườn hầm ngũ quả ly 113g tiện lợi, thơm ngon hấp dẫn không thể chối từ', 'omachisuon.jpg', 100, 378000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(112, 'Thùng 30 gói mì Kokomi hải sản Kayakay gói 90g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp mì nấu hải sản Kokomi đậm đà cay cay cực đã cùng hương thơm lừng ngất ngây tạo ra siêu phẩm mì với sự kết hợp hương vị hài hòa, độc đáo. 30 gói mì Kokomi hải sản Kayakay 90g thơm ngon hấp dẫn không thể chối từ', 'kokomi.jpg', 100, 175000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(113, 'Thùng 30 gói mì Kokomi 90 tôm chua cay 90g', 'Sợi mì vàng dai ngon hòa quyện trong nước súp Kokomi vị tôm chua cay đậm đà thấm đẫm từng sợi cùng hương thơm lừng quyến rũ. 30 gói mì Kokomi Kokomi 90 tôm chua cay 90g tiện lợi, nhanh chóng, hấp dẫn cho bữa ăn nhanh gọn đơn giản nhưng vẫn đầy đủ dưỡng chất.', 'kokomi90.jpg', 70, 106000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(114, 'Thùng 24 ly mì khoai tây Cung Đình cua bể rau răm', 'Sợi mì từ khoai tây và trứng vàng dai ngon hòa quyện trong nước súp cua bể rau răm Cung Đình đậm đà cùng hương thơm lừng quyến rũ. 24 ly mì khoai tây Cung Đình cua bể rau răm 65g nhanh chóng, là lựa chọn hấp dẫn cho bữa ăn nhanh gọn đơn giản nhưng vẫn đầy đủ dưỡng chất', 'cungdinh.jpg', 60, 192000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(115, 'Thùng 30 gói hủ tiếu sườn heo Nhịp Sống 70g', 'Bữa ăn cực tiện lợi và thơm ngon. 30 gói hủ tiếu sườn heo Nhịp Sống 70g là sản phẩm hủ tiếu ăn liền của thương hiệu Nhịp sống với hương vị sườn heo đậm đà thấm đều trong từng sợi dai ngon cực đã cùng mùi hương hấp dẫn lôi cuốn không thể chối từ', 'hutieu.jpg', 30, 206000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(116, 'Thùng 30 gói hủ tiếu Nam Vang Cung Đình 78g', 'Bữa ăn cực tiện lợi và thơm ngon. 30 gói hủ tiếu Nam Vang Cung Đình 78g là sản phẩm hủ tiếu ăn liền của Cung Đình hương vị Nam Vang đặc trưng thấm đều trong từng sợi hủ tiếu dai ngon đậm đà cực đã cùng mùi hương hấp dẫn lôi cuốn không thể chối từ', 'namvang.jpg', 30, 206000, 0, 1, NULL, '2022-04-12 15:33:55', NULL),
(117, 'Thùng 30 gói cháo yến Yến Việt vị thịt bằm 50g', 'Là dòng sản phẩm cháo yến ăn liền tiện lợi từ thương hiệu Yến Việt. 30 gói cháo yến Yến Việt vị thịt bằm 50g có chứa tổ yến tự nhiên cùng rau thịt tươi sấy thăng hoa mang hương vị thịt bằm tươi ngon và dinh dưỡng là lựa chọn hoàn hảo cho bữa ăn nhanh đơn giản những vẫn đủ chất', 'chaoyen.jpg', 30, 270000, 0, 1, NULL, '2022-04-12 15:33:55', '0000-00-00 00:00:00'),
(118, '6 chai nước nho & nha đam Vfresh 350ml', 'Sản phẩm nước trái cây chất lượng thơm ngon từ thương hiệu Vfresh được làm từ những thành phần tự nhiên như nha đam, nước ép nho cô đặc... tạo nên hương vị thom ngon tự nhiên, giúp tăng cường sức đề kháng, cho gia đình bạn khỏe mạnh. 6 chai nước nho và nha đam Vfresh 350ml chất lượng và an toàn', 'nuocnhadam.jpg', 5000, 52000, 5, 1, NULL, '2022-04-30 05:27:15', NULL),
(119, 'Nước ép đào Vfresh 1 lít', 'Sản phẩm nước ép trái cây chất lượng thơm ngon từ thương hiệu Vfresh được làm từ nguyên liệu tự nhiên tươi ngon và đào tươi nguyên chất giữ nguyên được hương vị tự nhiên, thơm ngon vốn có. Sản phẩm giúp giải khát nhanh chóng, cung cấp chất dinh dưỡng, tốt cho sức khỏe.', 'vfresh.jpg', 7000, 37000, 8, 1, NULL, '2022-04-30 05:30:35', NULL),
(120, 'Thùng 12 chai nước khoáng thiên nhiên La Vie 700ml', 'Thùng 12 chai nước khoáng thiên nhiên La Vie 700ml từ nguồn nước khoáng thiên nhiên được sản xuất tại Việt Nam với quy trình sản xuất hiện đại, tiên tiến. Sản phẩm đóng chai tiện lợi, dễ sử dụng, bảo quản.', 'nuocsuoi.jpg', 3000, 98000, 0, 1, NULL, '2022-04-30 05:47:07', NULL),
(121, 'test', '', 'vfresh.jpg', 111, 1000000000, 100, 1, 'test', '0000-00-00 00:00:00', '2022-05-10 08:08:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trangthai_dh`
--

CREATE TABLE `trangthai_dh` (
  `TTDH_Ma` int(11) NOT NULL,
  `Ten` char(50) NOT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `trangthai_dh`
--

INSERT INTO `trangthai_dh` (`TTDH_Ma`, `Ten`, `MoTa`) VALUES
(1, 'Đang duyệt', 'Đơn hàng chờ xác nhận\r\n');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_dh`
--
ALTER TABLE `chitiet_dh`
  ADD PRIMARY KEY (`DH_Ma`,`SP_Ma`),
  ADD KEY `fk_ctdh_sp_ma` (`SP_Ma`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`DH_Ma`,`Email`),
  ADD KEY `fk_dh_ctdh_ma` (`TTDH_Ma`),
  ADD KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`Email`);

--
-- Chỉ mục cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`DM_Ma`);

--
-- Chỉ mục cho bảng `phanloai_sp`
--
ALTER TABLE `phanloai_sp`
  ADD PRIMARY KEY (`SP_Ma`,`DM_Ma`),
  ADD KEY `fk_dm_ma` (`DM_Ma`);

--
-- Chỉ mục cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  ADD PRIMARY KEY (`TaiKhoan`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`SP_Ma`);

--
-- Chỉ mục cho bảng `trangthai_dh`
--
ALTER TABLE `trangthai_dh`
  ADD PRIMARY KEY (`TTDH_Ma`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `DH_Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  MODIFY `DM_Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `SP_Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `trangthai_dh`
--
ALTER TABLE `trangthai_dh`
  MODIFY `TTDH_Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_dh`
--
ALTER TABLE `chitiet_dh`
  ADD CONSTRAINT `fk_ctdh_hd_ma` FOREIGN KEY (`DH_Ma`) REFERENCES `donhang` (`DH_Ma`),
  ADD CONSTRAINT `fk_ctdh_sp_ma` FOREIGN KEY (`SP_Ma`) REFERENCES `sanpham` (`SP_Ma`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `khachhang` (`Email`),
  ADD CONSTRAINT `fk_dh_ctdh_ma` FOREIGN KEY (`TTDH_Ma`) REFERENCES `trangthai_dh` (`TTDH_Ma`);

--
-- Các ràng buộc cho bảng `phanloai_sp`
--
ALTER TABLE `phanloai_sp`
  ADD CONSTRAINT `fk_dm_ma` FOREIGN KEY (`DM_Ma`) REFERENCES `loai_sp` (`DM_Ma`),
  ADD CONSTRAINT `fk_sp_ma` FOREIGN KEY (`SP_Ma`) REFERENCES `sanpham` (`SP_Ma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
