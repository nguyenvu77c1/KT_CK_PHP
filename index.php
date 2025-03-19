<?php
session_start();
include 'config.php';
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra quyền: chỉ user có MaSV = 999999999 là admin
$isAdmin = ($_SESSION['MaSV'] === '999999999');

$result = mysqli_query($conn, "SELECT * FROM SinhVien");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2.5rem;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 20px;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }
        .table {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #2a5298;
            color: #fff;
        }
        .table td {
            vertical-align: middle;
        }
        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: #4a90e2;
            border: none;
        }
        .btn-primary:hover {
            background: #357abd;
            transform: scale(1.05);
        }
        .btn-danger {
            background: #e74c3c;
            border: none;
        }
        .btn-danger:hover {
            background: #c0392b;
            transform: scale(1.05);
        }
        .btn-info {
            background: #3498db;
            border: none;
        }
        .btn-info:hover {
            background: #2980b9;
            transform: scale(1.05);
        }
        .img-thumbnail {
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            max-width: 50px;
            height: auto;
        }
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }
            .btn {
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Danh sách sinh viên <i class="fas fa-users"></i></h1>
            <a href="logout.php" class="btn btn-danger mt-2"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </div>
        <div class="card">
            <?php if ($isAdmin) { ?>
                <a href="create.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm sinh viên</a>
            <?php } ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Hình</th>
                        <th>Mã ngành</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['MaSV']; ?></td>
                        <td><?php echo $row['HoTen']; ?></td>
                        <td><?php echo $row['GioiTinh']; ?></td>
                        <td><?php echo $row['NgaySinh']; ?></td>
                        <td>
                            <?php if ($row['Hinh'] && file_exists($row['Hinh'])) { ?>
                                <img src="<?php echo $row['Hinh']; ?>" class="img-thumbnail" alt="Hình sinh viên">
                            <?php } else { ?>
                                <span>Không có hình</span>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['MaNganh']; ?></td>
                        <td>
                            <?php if ($isAdmin) { ?>
                                <a href="edit.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="delete.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sinh viên này?')"><i class="fas fa-trash"></i> Xóa</a>
                            <?php } ?>
                            <a href="detail.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Chi tiết</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>