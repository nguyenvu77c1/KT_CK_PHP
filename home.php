<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Hệ thống quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
            width: 100%;
            max-width: 600px;
        }
        .card h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background: #4a90e2;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #357abd;
            transform: scale(1.05);
        }
        .btn-success {
            background: #28a745;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background: #218838;
            transform: scale(1.05);
        }
        .animated-text {
            animation: fadeIn 2s infinite alternate;
        }
        @keyframes fadeIn {
            from { opacity: 0.5; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Chào mừng đến với <span class="animated-text">Hệ thống Quản lý Sinh viên</span> <i class="fas fa-graduation-cap"></i></h1>
        <p class="lead">Hệ thống hỗ trợ quản lý sinh viên và đăng ký học phần một cách hiện đại.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="login.php" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
            <a href="register.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Đăng ký</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>