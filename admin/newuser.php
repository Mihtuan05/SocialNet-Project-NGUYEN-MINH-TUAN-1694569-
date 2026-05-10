<?php include '../socialnet/includes/db.php'; 
if(isset($_POST['add'])){
    $un = mysqli_real_escape_string($conn, $_POST['un']);
    $fn = mysqli_real_escape_string($conn, $_POST['fn']);
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $res = mysqli_query($conn, "INSERT INTO account (username, fullname, password) VALUES ('$un', '$fn', '$pw')");
    if($res) $msg = "User $un created! Go to Sign in.";
} ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5" style="max-width: 450px;">
    <div class="card shadow border-0"><div class="card-header bg-danger text-white fw-bold text-center">ADMIN - CREATE ACCOUNT</div>
    <div class="card-body p-4"><?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
        <form method="POST">
            <input name="un" class="form-control mb-3" placeholder="Username" required>
            <input name="fn" class="form-control mb-3" placeholder="Full Name" required>
            <input type="password" name="pw" class="form-control mb-3" placeholder="Password" required>
            <button name="add" class="btn btn-danger w-100 fw-bold">Sign Up User</button>
        </form>
        <a href="/socialnet/signin.php" class="d-block text-center mt-3 small">Back to Sign In</a>
    </div></div>
</div>
