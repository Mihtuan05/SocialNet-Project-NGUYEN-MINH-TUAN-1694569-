<?php include 'includes/db.php';
if(isset($_POST['login'])){
    // VÁ LỖI: Sử dụng Prepared Statements thay vì nối chuỗi
    $stmt = mysqli_prepare($conn, "SELECT * FROM account WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $_POST['un']);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $u = mysqli_fetch_assoc($res);
    
    // Sử dụng password_verify để so khớp mật khẩu đã hash bcrypt
    if($u && password_verify($_POST['pw'], $u['password'])){
        $_SESSION['user'] = $u; 
        header("Location: index.php"); 
        exit();
    } else { 
        $err = "Wrong username or password!"; 
    }
} ?>
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow border-0" style="width: 380px;"><div class="card-body p-5 text-center">
        <h2 class="fw-bold mb-4">Sign In (Secure Version)</h2>
        <?php if(isset($err)) echo "<div class='alert alert-danger'>$err</div>"; ?>
        <form method="POST">
            <input name="un" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pw" class="form-control mb-3" placeholder="Password" required>
            <button name="login" class="btn btn-primary w-100 fw-bold">Sign In</button>
        </form>
    </div></div>
</div>
