<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maSV = $_POST['MaSV'];
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];

    // Xử lý upload file
    $hinh = '';
    if ($_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
        $targetDir = './Content/images/';
        $hinh = $targetDir . basename($_FILES['Hinh']['name']);
        if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $hinh)) {
            // Upload thành công, tiếp tục lưu vào database
            $check = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV='$maSV'");
            if (mysqli_num_rows($check) > 0) {
                $error = "Mã sinh viên đã tồn tại!";
            } else {
                $sql = "INSERT INTO SinhVien(MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                        VALUES('$maSV', '$hoTen', '$gioiTinh', '$ngaySinh', '$hinh', '$maNganh')";
                if (mysqli_query($conn, $sql)) {
                    $success = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
                } else {
                    $error = "Lỗi: " . mysqli_error($conn);
                }
            }
        } else {
            $error = "Lỗi khi di chuyển file ảnh! Kiểm tra quyền thư mục Content/images/";
        }
    } else {
        $error = "Lỗi upload file: " . $_FILES['Hinh']['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 100%;
            max-width: 500px;
        }
        .card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label { color: #fff; }
        .btn-primary {
            background: #4a90e2;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #357abd;
            transform: scale(1.05);
        }
        .alert { background: rgba(255, 255, 255, 0.1); }
        .alert-success { color: #33ff33; }
        .alert-danger { color: #ff3333; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Đăng ký tài khoản <i class="fas fa-user-plus"></i></h2>
        <?php if (isset($success)) { echo "<div class='alert alert-success' role='alert'>$success</div>"; } ?>
        <?php if (isset($error)) { echo "<div class='alert alert-danger' role='alert'>$error</div>"; } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ tên</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới tính</label>
                <input type="text" name="GioiTinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày sinh</label>
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình</label>
                <input type="file" name="Hinh" class="form-control">
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã ngành</label>
                <input type="text" name="MaNganh" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i> Đăng ký</button>
        </form>
        <p class="mt-3 text-center">Đã có tài khoản? <a href="login.php" class="text-info">Đăng nhập ngay</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>