<?php
session_start();
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maSV = $_POST['MaSV'];
    $result = mysqli_query($conn, "SELECT * FROM SinhVien WHERE MaSV='$maSV'");
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['MaSV'] = $maSV;
        header("Location: index.php");
    } else {
        $error = "Mã sinh viên không tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
            max-width: 400px;
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
        .alert { background: rgba(255, 255, 255, 0.1); color: #ff3333; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Đăng nhập <i class="fas fa-sign-in-alt"></i></h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger' role='alert'>$error</div>"; } ?>
        <form method="POST">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
        </form>
        <p class="mt-3 text-center">Chưa có tài khoản? <a href="register.php" class="text-info">Đăng ký ngay</a></p>
        <p class="mt-2 text-center"><a href="home.php" class="text-info">Trở về trang chủ</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>