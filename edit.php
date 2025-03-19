<?php
session_start();
include 'config.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra quyền: chỉ user có MaSV = 999999999 được truy cập
if ($_SESSION['MaSV'] !== '999999999') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV='$id'");
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];
    $hinh = $row['Hinh'];

    if ($_FILES['Hinh']['name']) {
        $targetDir = './Content/images/';
        $hinh = $targetDir . basename($_FILES['Hinh']['name']);
        if ($_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $hinh)) {
                $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', Hinh='$hinh', MaNganh='$maNganh' WHERE MaSV='$id'";
                if (mysqli_query($conn, $sql)) {
                    header("Location: index.php");
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            } else {
                echo "Lỗi khi di chuyển file ảnh!";
            }
        } else {
            echo "Lỗi upload file: " . $_FILES['Hinh']['error'];
        }
    } else {
        $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', MaNganh='$maNganh' WHERE MaSV='$id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>
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
        .form-label { color: #fff; }
        .btn-primary {
            background: #4a90e2;
            border: none;
        }
        .btn-primary:hover { background: #357abd; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Sửa thông tin sinh viên <i class="fas fa-edit"></i></h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="MaSV" class="form-label">Mã SV</label>
                    <input type="text" name="MaSV" value="<?php echo $row['MaSV']; ?>" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ tên</label>
                    <input type="text" name="HoTen" value="<?php echo $row['HoTen']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="GioiTinh" class="form-label">Giới tính</label>
                    <input type="text" name="GioiTinh" value="<?php echo $row['GioiTinh']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="NgaySinh" class="form-label">Ngày sinh</label>
                    <input type="date" name="NgaySinh" value="<?php echo $row['NgaySinh']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Hinh" class="form-label">Hình</label>
                    <input type="file" name="Hinh" class="form-control">
                    <?php if ($row['Hinh'] && file_exists($row['Hinh'])) { echo "<img src='{$row['Hinh']}' class='img-thumbnail mt-2' width='100' alt='Hình hiện tại'>"; } ?>
                </div>
                <div class="mb-3">
                    <label for="MaNganh" class="form-label">Mã ngành</label>
                    <input type="text" name="MaNganh" value="<?php echo $row['MaNganh']; ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>