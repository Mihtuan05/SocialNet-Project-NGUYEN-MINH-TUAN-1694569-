<?php include 'includes/db.php';
include 'includes/navbar.php';
// Lấy thông tin của chính người đang đăng nhập để hiển thị MSSV
$me_un = isset($_SESSION['user']) ? $_SESSION['user']['username'] : '';
$u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE username='$me_un'"));
?>
<div class="container">
    <div class="card shadow border-0 rounded-4 p-5 bg-light">
        <h1 class="fw-bold text-dark mb-4 border-bottom pb-3">Developer Information</h1>
        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <div class="p-3">
                    <label class="text-muted small fw-bold d-block mb-1">STUDENT NAME</label>
                    <h4 class="fw-bold">Nguyễn Minh Tuấn</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3">
                    <label class="text-muted small fw-bold d-block mb-1">STUDENT ID</label>
                    <h4 class="fw-bold text-primary"><?php echo $u['mssv'] ?: "[Update in Settings]"; ?></h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="p-3">
                    <label class="text-muted small fw-bold d-block mb-1">PROJECT SCOPE</label>
                    <p class="lead">Web Application Mock Project - HUST/Troy University Edition. Built with LEMP Stack and Bootstrap 5.</p>
                </div>
            </div>
        </div>
    </div>
</div>
