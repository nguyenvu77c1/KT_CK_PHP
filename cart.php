<?php
session_start();
include 'config.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['remove'])) {
    $maHP = $_GET['remove'];
    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$maHP]);
    header("Location: cart.php");
}

if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng học phần</title>
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
        .table th {
            background: #2a5298;
        }
        .btn-primary {
            background: #4a90e2;
            border: none;
        }
        .btn-primary:hover { background: #357abd; }
        .btn-danger {
            background: #e74c3c;
            border: none;
        }
        .btn-danger:hover { background: #c0392b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Giỏ hàng học phần <i class="fas fa-shopping-cart"></i></h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên HP</th>
                        <th>Số tín chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        $cart = implode("','", $_SESSION['cart']);
                        $result = mysqli_query($conn, "SELECT * FROM HocPhan WHERE MaHP IN ('$cart')");
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['MaHP']; ?></td>
                            <td><?php echo $row['TenHP']; ?></td>
                            <td><?php echo $row['SoTinChi']; ?></td>
                            <td><a href="cart.php?remove=<?php echo $row['MaHP']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</a></td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">Giỏ hàng trống</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="cart.php?clear=1" class="btn btn-danger mt-3"><i class="fas fa-trash-alt"></i> Xóa hết</a>
            <a href="save.php" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Lưu đăng ký</a>
            <a href="hocphan.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>