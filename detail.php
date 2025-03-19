<?php
session_start();
include 'config.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV='$id'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Thông tin chi tiết sinh viên <i class="fas fa-info-circle"></i></h2>
            <div class="mb-3">
                <strong>Mã SV:</strong> <?php echo $row['MaSV']; ?>
            </div>
            <div class="mb-3">
                <strong>Họ tên:</strong> <?php echo $row['HoTen']; ?>
            </div>
            <div class="mb-3">
                <strong>Giới tính:</strong> <?php echo $row['GioiTinh']; ?>
            </div>
            <div class="mb-3">
                <strong>Ngày sinh:</strong> <?php echo $row['NgaySinh']; ?>
            </div>
            <div class="mb-3">
                <strong>Hình:</strong> 
                <?php if ($row['Hinh'] && file_exists($row['Hinh'])) { ?>
                    <img src="<?php echo $row['Hinh']; ?>" class="img-thumbnail" width="150" alt="Hình sinh viên">
                <?php } else { ?>
                    <span>Không có hình</span>
                <?php } ?>
            </div>
            <div class="mb-3">
                <strong>Mã ngành:</strong> <?php echo $row['MaNganh']; ?>
            </div>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>