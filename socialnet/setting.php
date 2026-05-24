<?php include 'includes/db.php'; 
if(!isset($_SESSION['user'])) header("Location: signin.php");
include 'includes/navbar.php'; 
$un = $_SESSION['user']['username'];

// VÁ LỖI: Khởi tạo CSRF Token ngẫu nhiên nếu chưa có
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['save'])){
    // VÁ LỖI: Kiểm tra mã CSRF Token chống tấn công đổi MSSV ngầm
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Validation Failed!");
    }

    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $mssv = mysqli_real_escape_string($conn, $_POST['mssv']);
    
    mysqli_query($conn, "UPDATE account SET description='$desc', mssv='$mssv' WHERE username='$un'");
    echo "<div class='container'><div class='alert alert-success'>Profile Securely Updated!</div></div>";
}
$u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM account WHERE username='$un'")); ?>
<div class="container"><div class="card shadow-sm border-0 mx-auto" style="max-width: 550px;"><div class="card-body p-5">
    <h3 class="fw-bold mb-4">Edit Profile (Secure)</h3>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <label class="small fw-bold">STUDENT ID (MSSV)</label>
        <input name="mssv" class="form-control mb-4" value="<?php echo htmlspecialchars($u['mssv']); ?>">
        <label class="small fw-bold">BIO / DESCRIPTION</label>
        <textarea name="desc" class="form-control mb-4" rows="4"><?php echo htmlspecialchars($u['description']); ?></textarea>
        <button name="save" class="btn btn-primary w-100 fw-bold">Save All Changes</button>
    </form>
</div></div></div>
